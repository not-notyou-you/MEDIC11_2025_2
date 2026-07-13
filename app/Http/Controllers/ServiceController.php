<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ServicePendingNotification;
use App\Mail\ServiceOnProgressNotification;
use App\Mail\ServiceCompletedNotification;
use App\Mail\ServiceCanceledNotification;
use App\Mail\NewServiceNotification;
use App\Exports\ServicesExport;
use App\Imports\ServicesImport;
use Maatwebsite\Excel\Facades\Excel;

class ServiceController extends Controller
{
    public function index()
    {
        return view('pages.Service.index', [
            'title' => 'Service',
        ]);
    }

    public function create()
    {
        return view('pages.Service.create', [
            'title' => 'Service',
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string',
            'email'         => 'required|email',
            'nim'           => 'required|string',
            'type'          => 'required|string',
            'phone'         => 'required|string',
            'line'          => 'required|string',
            'organization'  => 'required|string',
            'title'         => 'required|string',
            'event_name'    => 'required|string',
            'description'   => 'required|string',
            'date'          => 'required|date|after:today',
            'start_time'    => 'required',
            'end_time'      => 'required|after:start_time',
            'location'      => 'required|string',
            'note'          => 'nullable|string',
            'person'        => $request->type === 'Pengajuan Jasa' ? 'required|integer|min:0' : 'nullable',
            'medical_equipment' => $request->type === 'Alat Kesehatan' ? 'nullable|array' : 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['status'] = Service::STATUS_PENDING;
        
        if ($request->type === 'Alat Kesehatan' && $request->has('medical_equipment')) {
            $data['medical_equipment'] = $request->medical_equipment;
        } else {
            $data['medical_equipment'] = null;
        }

        $service = Service::create($data);

        // 1. Send notification to applicant
        try {
            Mail::to($service->email)->send(new ServicePendingNotification($service));
        } catch (\Exception $e) {
            Log::error('Gagal mengirim notifikasi pending ke pengaju: ' . $service->email, [
                'error' => $e->getMessage(),
                'service_id' => $service->id
            ]);
        }

        // 2. Send notifications to ALL USERS (both admin and regular users)
        $this->notifyAllUsers($service);

        return redirect()->route('service.index')
            ->with('status', 'Pengajuan telah diterima, harap segera konfirmasi ke LINE kami. Terima kasih.');
    }

    /**
     * Notify all users about the new service request
     */
    protected function notifyAllUsers(Service $service)
    {
        // Menggunakan constant dari model User
        $admins = User::where('is_admin', '>=', User::ROLE_ADMIN)->get();
        
        foreach ($admins as $admin) {
            try {
                // Skip applicant to avoid duplicate notification
                if ($admin->email === $service->email) continue;
                
                Mail::to($admin->email)->send(new NewServiceNotification($service));
                Log::info('Notifikasi berhasil dikirim ke admin: ' . $admin->email);
            } catch (\Exception $e) {
                Log::error('Gagal mengirim notifikasi ke admin: ' . $admin->email, [
                    'error' => $e->getMessage(),
                    'service_id' => $service->id
                ]);
            }
        }
    }

    public function show()
    {
        return view('pages.Service.show', [
            'title'         => 'Services',
            'notification'  => Service::where('status', 'Pending')->get(),
            'pendings'      => Service::where('status', 'Pending')->orderByDesc('updated_at')->paginate(10),
            'onprogresses'  => Service::where('status', 'On Progress')->orderByDesc('updated_at')->paginate(10),
            'completeds'    => Service::where('status', 'Completed')->orderByDesc('updated_at')->paginate(10),
            'canceleds'     => Service::where('status', 'Canceled')->orderByDesc('updated_at')->paginate(10),
        ]);
    }

    public function edit(string $id)
    {
        $service = Service::findOrFail($id);

        return view('pages.Service.edit', [
            'service'       => $service,
            'title'         => $service->event_name,
            'notification'  => Service::where('status', 'Pending')->get(),
            'pendings'      => Service::where('status', 'Pending')->get(),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);
    
        $validated = $request->validate([
            'status' => 'required|in:Pending,On Progress,Completed,Canceled',
        ]);
    
        $service->status = $request->status;
        $service->save();
    
        return redirect()->route('service.show')
            ->with('status', $service->event_name . ' telah diperbarui.');
    }
    
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('service.show')
            ->with('status', 'Service ' . $service->event_name . ' has been deleted.');
    }

    public function confirm()
    {
        return view('pages.Service.confirm', [
            'title' => 'Service',
        ]);
    }

    public function sendEmail(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        $validStatuses = [Service::STATUS_PENDING, Service::STATUS_ON_PROGRESS, 
                         Service::STATUS_COMPLETED, Service::STATUS_CANCELED];
        
        if (!in_array($service->status, $validStatuses)) {
            Log::error('Invalid service status encountered', [
                'service_id' => $service->id,
                'current_status' => $service->status
            ]);
            return back()->with('email_error', 'Status layanan tidak valid untuk mengirim notifikasi');
        }

        try {
            $cancelReason = $request->input('cancel_reason', null);

            switch ($service->status) {
                case Service::STATUS_PENDING:
                    Mail::to($service->email)->send(new ServicePendingNotification($service));
                    break;
                case Service::STATUS_ON_PROGRESS:
                    Mail::to($service->email)->send(new ServiceOnProgressNotification($service));
                    break;
                case Service::STATUS_COMPLETED:
                    Mail::to($service->email)->send(new ServiceCompletedNotification($service));
                    break;
                case Service::STATUS_CANCELED:
                    Mail::to($service->email)->send(new ServiceCanceledNotification($service, $cancelReason));
                    break;
                default:
                    throw new \Exception('Status tidak valid: ' . $service->status);
            }

            return back()->with('email_status', 'Email notifikasi telah berhasil dikirim ke ' . $service->email);
        } catch (\Exception $e) {
            Log::error('Email sending failed', [
                'error' => $e->getMessage(),
                'service_id' => $service->id,
                'status' => $service->status
            ]);
            return back()->with('email_error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }
    
    public function export() 
    {
        return Excel::download(new ServicesExport, 'services.xlsx');
    }

    public function clear()
    {
        Service::truncate();
        return back()->with('status', 'All services have been cleared.');
    }

    public function import(Request $request) 
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new ServicesImport, $request->file('file'));
            return back()->with('status', 'Services imported successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error importing services: '. $e->getMessage());
        }
    }

    public function surat($id)
    {
        $service = Service::findOrFail($id);
        
        return view('pages.Service.surat', [
            'service' => $service,
            'title' => 'Surat Pengajuan'
        ]);
    }
}