@extends('layouts.dashboard_template')

@section('content')

@php
    use Carbon\Carbon;
@endphp

<style>
    .table-row-warning {
        background-color: rgba(251, 113, 133, 0.15) !important; /* Warna merah muda dengan opacity */
        border-left: 4px solid #fb7185 !important;
    }
    .table-row-warning:hover {
        background-color: rgba(251, 113, 133, 0.25) !important; /* Warna saat hover */
    }
    /* Pastikan teks tetap terbaca */
    .table-row-warning td {
        color: #144034 !important;
    }
    
    /* Tambahkan border kiri untuk emphasis lebih */
    .table-row-warning td:first-child {
        border-left: 4px solid #fb7185 !important;
    }
    
    /* Warna khusus untuk tanggal lewat (lebih gelap) */
    .table-row-past {
        background-color: rgba(251, 113, 133, 0.25) !important;
        border-left: 4px solid #dc2626 !important;
    }
    .table-row-past:hover {
        background-color: rgba(251, 113, 133, 0.35) !important;
    }
    .table-row-past td:first-child {
        border-left: 4px solid #dc2626 !important;
    }
</style>

<div class="rounded-md border bg-[#effaf5] border-gray-100 m-6 px-0 sm:p-6 shadow-md shadow-black/5">

    @if (session()->has('status'))
    @include('components.status', ['status' => session('status')])
    @endif

    <div class="mx-auto min-h-[400px]">
        <div class="relative right-0 p-6">
            <ul class="w-2/3 mx-auto relative flex flex-wrap p-1 list-none rounded-xl bg-[#048C6A]" data-tabs="tabs" role="list">
                @foreach([
                    ['id' => 'pendings', 'label' => 'Pendings'],
                    ['id' => 'on_progress', 'label' => 'On_Progress'],
                    ['id' => 'complete', 'label' => 'Completed'],
                    ['id' => 'cancel', 'label' => 'Canceled']
                ] as $tab)
                <li class="z-30 flex-auto text-center">
                    <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer font-semibold {{ request('status') === $tab['id'] || (request('status') === null && $loop->first) ? 'bg-[#ffffff] shadow text-[#144034]' : 'bg-inherit text-[#effaf5]' }}"
                        href="{{ request()->fullUrlWithQuery(['status' => $tab['id'], 'page' => 1]) }}"
                        role="tab" 
                        aria-selected="{{ request('status') === $tab['id'] || (request('status') === null && $loop->first) ? 'true' : 'false' }}" 
                        aria-controls="{{ $tab['id'] }}">
                        <span class="ml-1">{{ $tab['label'] }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
            
            <div data-tab-content="" class="p-5">
                @foreach([
                    ['id' => 'pendings', 'data' => $pendings, 'status_color' => 'yellow'],
                    ['id' => 'on_progress', 'data' => $onprogresses, 'status_color' => 'blue'],
                    ['id' => 'complete', 'data' => $completeds, 'status_color' => 'emerald'],
                    ['id' => 'cancel', 'data' => $canceleds, 'status_color' => 'red']
                ] as $panel)
                <div class="{{ (request('status') === $panel['id'] || (request('status') === null && $loop->first)) ? 'block opacity-100' : 'hidden opacity-0' }}" 
                     id="{{ $panel['id'] }}" 
                     role="tabpanel">
                    @if ($panel['data']->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-[540px]">
                                <thead>
                                    <tr class="bg-[#ffffff]">
                                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left rounded-tl-md rounded-bl-md border-r-2 border-[#ffffff]">No.</th>
                                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r-2 border-[#ffffff]">Event Name</th>
                                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r-2 border-[#ffffff]">Organization</th>
                                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r-2 border-[#ffffff]">Event Date</th>
                                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r-2 border-[#ffffff]">Type</th>
                                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r-2 border-[#ffffff]">Submitted At</th>
                                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r-2 border-[#ffffff]">Email</th>
                                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left rounded-tr-md rounded-br-md">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($panel['data'] as $item)
                                    @php
                                        // Gunakan field yang benar: 'date' bukan 'event_date'
                                        $eventDate = Carbon::parse($item->date)->startOfDay();
                                        $today = Carbon::now()->startOfDay();
                                        
                                        // Hitung perbedaan hari
                                        $daysDifference = $today->diffInDays($eventDate, false);
                                        
                                        // Format teks untuk hari
                                        $dayText = '';
                                        $isPast = false;
                                        
                                        if ($daysDifference > 0) {
                                            // Jika hari di masa depan, bulatkan ke atas
                                            $daysRounded = ceil($daysDifference);
                                            $dayText = "Sisa $daysRounded hari";
                                        } elseif ($daysDifference == 0) {
                                            $dayText = "Hari ini";
                                        } else {
                                            // Jika sudah lewat
                                            $dayText = "Sudah lewat";
                                            $isPast = true;
                                        }
                                        
                                        // Normalisasi status untuk perbandingan
                                        $normalizedStatus = strtolower(trim($item->status));
                                        
                                        // Hitung untuk kondisi warning
                                        $isWarningRow = false;
                                        $warningClass = '';
                                        
                                        // Untuk tanggal yang sudah lewat: semua status Pending/On Progress harus warning
                                        if ($isPast) {
                                            if (in_array($normalizedStatus, ['pending', 'on progress'])) {
                                                $isWarningRow = true;
                                                $warningClass = 'table-row-past';
                                            }
                                        } 
                                        // Untuk tanggal mendatang: kondisi normal
                                        else {
                                            if ($normalizedStatus == 'pending' && $daysDifference <= 5) {
                                                $isWarningRow = true;
                                                $warningClass = 'table-row-warning';
                                            } elseif ($normalizedStatus == 'on progress' && $daysDifference <= 1) {
                                                $isWarningRow = true;
                                                $warningClass = 'table-row-warning';
                                            }
                                        }
                                        
                                        // Debug: Tampilkan data untuk troubleshooting
                                        // {{-- 
                                        // echo "ID: {$item->id}, Date: {$item->date}, Status: {$item->status}, ";
                                        // echo "Days: {$daysDifference}, Past: " . ($isPast ? 'Yes' : 'No') . ", ";
                                        // echo "Warning: " . ($isWarningRow ? 'Yes' : 'No') . "<br>";
                                        // --}}
                                    @endphp
                                    <tr class="hover:bg-[#e0f2e9] {{ $warningClass }}">
                                        <td class="py-2 px-4 border-b-2 border-[#ffffff]">
                                            <span class="text-[13px] font-semibold text-[#144034]">{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="py-2 px-4 border-b-2 border-[#ffffff] hover:underline">
                                            <a href="{{ route('service.edit', $item->id) }}" class="text-[#144034] text-sm font-semibold">{{ $item->event_name }}</a>
                                        </td>
                                        <td class="py-2 px-4 border-b-2 border-[#ffffff]">
                                            <span class="text-[13px] font-semibold text-[#144034]">{{ $item->organization }}</span>
                                        </td>
                                        <td class="py-2 px-4 border-b-2 border-[#ffffff]">
                                            <span class="text-[13px] font-semibold text-[#144034]">
                                                {{ Carbon::parse($item->date)->format('d M Y') }}
                                            </span>
                                            @if($isWarningRow)
                                                <br>
                                                <span class="text-[11px] text-red-500 font-semibold italic">{{ $dayText }}</span>
                                            @endif
                                        </td>
                                        <td class="py-2 px-4 border-b-2 border-[#ffffff]">
                                            <span class="text-[13px] font-semibold text-[#144034]">{{ $item->type == 'Alat Kesehatan' ? 'Alkes' : 'Medis' }}</span>
                                        </td>
                                        <td class="py-2 px-4 border-b-2 border-[#ffffff]">
                                            <span class="text-[13px] font-semibold text-[#144034]">
                                                {{ Carbon::parse($item->created_at)->format('d M Y H:i') }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-4 border-b-2 border-[#ffffff]">
                                            <span class="text-[13px] font-semibold text-[#144034]">{{ $item->email }}</span>
                                        </td>
                                        <td class="py-2 px-4 border-b-2 border-[#ffffff]">
                                            <span class="w-20 text-center p-1 rounded bg-{{ $panel['status_color'] }}-500/10 text-{{ $panel['status_color'] }}-500 font-semibold text-[12px] leading-none">
                                                {{ $item->status }}
                                                @if($isWarningRow)
                                                    <br>
                                                    <span class="text-[10px] text-red-500 font-semibold">
                                                        @if($isPast)
                                                            ⚠️ Terlewat!
                                                        @else
                                                            ⚠️ Deadline!
                                                        @endif
                                                    </span>
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-10">
                            {{ $panel['data']->appends(request()->query())->links('vendor.pagination.tailwind', ['active_color' => '#048C6A']) }}
                        </div>
                    @elseif ($panel['data']->isEmpty() && !$panel['data']->onFirstPage())
                        <div class="min-h-96 flex items-center justify-center">
                            <p class="text-xl font-semibold text-center text-[#144034]">Data "{{ $panel['id'] }}" on page {{ $panel['data']->currentPage() }} is empty.</p>
                        </div>
                    @else
                        <div class="min-h-96 flex items-center justify-center">
                            <p class="text-xl font-semibold text-center text-[#144034]">No submission</p>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- Tombol Download, Clear, dan Upload --}}
@if(auth()->check() && auth()->user()->is_admin)
    <div class="px-6 pb-6">
        <div class="flex flex-wrap gap-4 items-center">
            {{-- Download Button --}}
            <a href="{{ route('services.export') }}" 
               class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A]">
                Download Excel
            </a>

            {{-- Clear Button --}}
            <form action="{{ route('services.clear') }}" method="POST" class="m-0">
                @csrf
                @method('DELETE')
                <button type="submit" 
                    onclick="return confirm('Are you sure you want to clear all services?')"
                    class="border-2 border-red-500 text-red-500 font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-red-500 hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-red-500">
                    Clear All
                </button>
            </form>

            {{-- Upload Form --}}
            <form action="{{ route('services.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-wrap gap-4 items-center m-0">
                @csrf
                <label class="relative cursor-pointer">
                    <input type="file" name="file" accept=".xlsx,.xls" required
                        class="hidden" id="file-upload">
                    <span class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A] cursor-pointer inline-block">
                        Choose Excel File
                    </span>
                </label>
                <button type="submit" 
                    class="border-2 border-[#048C6A] bg-[#048C6A] text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#037a5a] hover:border-[#037a5a] transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A]">
                    Upload Excel
                </button>
                <span class="text-sm text-gray-600" id="file-name">No file chosen</span>
            </form>
        </div>
    </div>
@endif

@endsection

@push('scripts')
<script>
    document.getElementById('file-upload').addEventListener('change', function(e) {
        const fileName = e.target.files.length ? e.target.files[0].name : 'No file chosen';
        document.getElementById('file-name').textContent = fileName;
    });
</script>
@endpush