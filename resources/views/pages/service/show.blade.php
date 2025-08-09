@extends('layouts.dashboard_template')

@section('content')

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
                                    <tr class="hover:bg-[#e0f2e9]">
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
                                            <span class="text-[13px] font-semibold text-[#144034]">{{ $item->formatted_date }}</span>
                                        </td>
                                        <td class="py-2 px-4 border-b-2 border-[#ffffff]">
                                            <span class="text-[13px] font-semibold text-[#144034]">{{ $item->type == 'Alat kesehatan' ? 'Alkes' : 'Medis' }}</span>
                                        </td>
                                        <td class="py-2 px-4 border-b-2 border-[#ffffff]">
                                            <span class="text-[13px] font-semibold text-[#144034]">{{ $item->formatted_created_at }}</span>
                                        </td>
                                        <td class="py-2 px-4 border-b-2 border-[#ffffff]">
                                            <span class="text-[13px] font-semibold text-[#144034]">{{ $item->email }}</span>
                                        </td>
                                        <td class="py-2 px-4 border-b-2 border-[#ffffff]">
                                            <span class="w-20 text-center p-1 rounded bg-{{ $panel['status_color'] }}-500/10 text-{{ $panel['status_color'] }}-500 font-semibold text-[12px] leading-none">
                                                {{ $item->status }}
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

@endsection

@push('scripts')
<script>
    document.getElementById('file-upload').addEventListener('change', function(e) {
        const fileName = e.target.files.length ? e.target.files[0].name : 'No file chosen';
        document.getElementById('file-name').textContent = fileName;
    });
</script>
@endpush