<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\BlastEmail;
use App\Models\EmailQueue;
use App\Models\Service; // TAMBAHKAN INI

class EmailBlastController extends Controller
{
    // Fungsi untuk mendapatkan notifikasi (sama seperti controller lain)
    private function getNotifications()
    {
        return [
            'notification' => Service::where('status', 'Pending')->get(),
            'pendings' => Service::where('status', 'Pending')->get()
        ];
    }
    
    public function index()
    {
        // KIRIM SEMUA DATA YANG DIPERLUKAN, termasuk $title
        return view('pages.email-blast', array_merge([
            'title' => 'Email Blast' // VARIABEL TITLE DI SINI
        ], $this->getNotifications()));
    }

    public function sendBlast(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv',
            'email_content' => 'required|string',
            'email_subject' => 'required|string'
        ]);

        try {
            $file = $request->file('excel_file');
            $data = Excel::toArray([], $file);
            
            if (empty($data) || count($data[0]) < 2) {
                return back()->with('error', 'File Excel harus memiliki minimal 2 baris (header dan data)');
            }

            $rows = $data[0];
            $headers = array_map('strtolower', array_map('trim', array_shift($rows)));

            if ($headers[0] !== 'email') {
                return back()->with('error', 'Kolom pertama harus berisi email');
            }

            $emailCount = 0;
            $errorEmails = [];

            foreach ($rows as $rowIndex => $row) {
                $email = trim($row[0]);
                
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $variables = [];
                    
                    foreach ($headers as $index => $header) {
                        if ($index > 0 && isset($row[$index])) {
                            $variables[$header] = $row[$index] ?? '';
                        }
                    }

                    EmailQueue::create([
                        'email' => $email,
                        'email_content' => $request->email_content,
                        'email_subject' => $request->email_subject,
                        'variables' => $variables
                    ]);

                    $emailCount++;
                } else {
                    $errorEmails[] = "Baris " . ($rowIndex + 2) . ": $email";
                }
            }

            $message = "Berhasil mengqueue $emailCount email.";
            if (!empty($errorEmails)) {
                $message .= " Email tidak valid: " . implode(', ', array_slice($errorEmails, 0, 5)) . (count($errorEmails) > 5 ? " ... dan " . (count($errorEmails) - 5) . " lainnya" : "");
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Error in sendBlast: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function processQueue()
    {
        $pendingEmails = EmailQueue::where('is_sent', false)->limit(50)->get();
        
        if ($pendingEmails->count() === 0) {
            return back()->with('info', 'Tidak ada email yang pending.');
        }

        $successCount = 0;
        $failCount = 0;

        foreach ($pendingEmails as $emailQueue) {
            try {
                Mail::to($emailQueue->email)->send(
                    new BlastEmail($emailQueue->email_content, $emailQueue->variables, $emailQueue->email_subject)
                );

                $emailQueue->update([
                    'is_sent' => true,
                    'sent_at' => now()
                ]);

                $successCount++;

                usleep(100000);

            } catch (\Exception $e) {
                Log::error('Gagal mengirim email ke ' . $emailQueue->email . ': ' . $e->getMessage());
                $failCount++;
            }
        }

        $message = "Pengiriman selesai! Berhasil: $successCount, Gagal: $failCount";
        return back()->with('success', $message);
    }

    public function queueStatus()
    {
        $total = EmailQueue::count();
        $sent = EmailQueue::where('is_sent', true)->count();
        $pending = EmailQueue::where('is_sent', false)->count();

        return response()->json([
            'total' => $total,
            'sent' => $sent,
            'pending' => $pending
        ]);
    }

    public function clearQueue()
    {
        try {
            $deleted = EmailQueue::where('is_sent', false)->delete();
            return back()->with('success', "Berhasil menghapus $deleted email dari queue.");
        } catch (\Exception $e) {
            Log::error('Error clearing queue: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus queue: ' . $e->getMessage());
        }
    }
}