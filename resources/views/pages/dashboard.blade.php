@extends('layouts.dashboard_template')

@section('content')

<div class="min-h-screen bg-[#effaf5] p-6">
    <!-- Header Dashboard -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6 mb-6">
        <h1 class="text-2xl font-semibold text-[#144034] text-center mb-2">
            <span id="greeting"></span> <span class="font-semibold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name ?? '' }}</span>!
        </h1>
        <p class="text-center text-lg text-[#144034]">{!! $quote !!}</p>
    </div>
    
    <!-- Tabel Pengajuan -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6">
        @if ($pengajuans->isEmpty())
        <div class="min-h-96 flex items-center justify-center">
            <p class="text-xl font-semibold text-center text-[#144034]">No Submission</p>
        </div>
        @else
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-[#144034]">Daftar Pengajuan Terbaru</h2>
            <a href="{{ route('service.show') }}" 
               class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300">
                Manage Submissions <i class="ri-external-link-line"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[540px]">
                <thead>
                    <tr class="bg-[#048C6A]/10">
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left rounded-tl-md rounded-bl-md border-r border-[#048C6A]/20">
                            No.</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r border-[#048C6A]/20">
                            Event Name</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r border-[#048C6A]/20">
                            Organization</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r border-[#048C6A]/20">
                            Event Date</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r border-[#048C6A]/20">
                            Type</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r border-[#048C6A]/20">
                            Submitted At</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left rounded-tr-md rounded-br-md">
                            Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuans as $pengajuan)
                    <tr class="hover:bg-[#e0f2e9]">
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            <span class="text-[13px] font-semibold text-[#144034]">{{ $loop->iteration }}</span>
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20 hover:underline">
                            <a href="{{ route('service.edit', $pengajuan->id) }}"
                                class="text-[#144034] text-sm font-semibold">
                                {{ $pengajuan->event_name }}
                            </a>
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            <span class="text-[13px] font-semibold text-[#144034]">{{ $pengajuan->organization }}</span>
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            <span class="text-[13px] font-semibold text-[#144034]">{{ $pengajuan->formatted_date }}</span>
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            <span class="text-[13px] font-semibold text-[#144034]">{{ $pengajuan->type }}</span>
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            <span class="text-[13px] font-semibold text-[#144034]">{{ $pengajuan->formatted_created_at }}</span>
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            @if ($pengajuan->status === 'Completed')
                            <span class="w-20 text-center p-1 rounded bg-emerald-500/10 text-emerald-500 font-semibold text-[12px] leading-none">
                                {{ $pengajuan->status }}
                            </span>
                            @elseif ($pengajuan->status === 'On Progress')
                            <span class="w-20 text-center p-1 rounded bg-blue-500/10 text-blue-500 font-semibold text-[12px] leading-none">
                                {{ $pengajuan->status }}
                            </span>
                            @elseif ($pengajuan->status === 'Pending')
                            <span class="w-20 text-center p-1 rounded bg-yellow-500/10 text-yellow-500 font-semibold text-[12px] leading-none">
                                {{ $pengajuan->status }}
                            </span>
                            @else
                            <span class="w-20 text-center p-1 rounded bg-red-500/10 text-red-500 font-semibold text-[12px] leading-none">
                                {{ $pengajuan->status }}
                            </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

<script>
    // Script untuk greeting berdasarkan waktu
    const hour = new Date().getHours();
    const greeting = document.getElementById('greeting');
    
    if (hour < 12) {
        greeting.textContent = 'Selamat Pagi,';
    } else if (hour < 18) {
        greeting.textContent = 'Selamat Siang,';
    } else {
        greeting.textContent = 'Selamat Malam,';
    }
</script>

@endsection