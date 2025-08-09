<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Dibatalkan</title>
    <style>
        .header { 
            background-color: #F44336; 
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pengajuan Anda Dibatalkan</h2>
        </div>
        
        <div class="content">
            <p>Halo {{ $service->name }},</p>
            
            <p>Mohon maaf, pengajuan yang anda minta dengan berat hati kami batalkan</p>

            @if(!empty($cancelReason))
                <p><strong>Alasan Pembatalan:</strong></p>
                <p>{{ $cancelReason }}</p>
            @elseif(!empty($service->note))
                <p><strong>Catatan:</strong></p>
                <p>{{ $service->note }}</p>
            @endif

            <p><strong>Email Pengirim:</strong> {{ $service->email }}</p>
            <p><strong>NIM:</strong> {{ $service->nim }}</p>
            <p><strong>Tipe Pengajuan:</strong> {{ $service->type }}</p>
            <p><strong>Nomor Telepon:</strong> {{ $service->phone }}</p>
            <p><strong>ID Line:</strong> {{ $service->line }}</p>
            <p><strong>Organisasi:</strong> {{ $service->organization }}</p>
            <p><strong>Judul Acara:</strong> {{ $service->title }}</p>
            <p><strong>Nama Acara:</strong> {{ $service->event_name }}</p>
            <p><strong>Deskripsi:</strong> {{ $service->description }}</p>
            <p><strong>Tanggal Acara:</strong> {{ $service->date }}</p>
            <p><strong>Waktu Mulai:</strong> {{ $service->start_time }}</p>
            <p><strong>Waktu Akhir:</strong> {{ $service->end_time }}</p>
            <p><strong>lokasi:</strong> {{ $service->location }}</p>
            <p><strong>catatan:</strong> {{ $service->note }}</p>
            <p><strong>Nama Acara:</strong> {{ $service->event_name }}</p>
            <p><strong>Tanggal Acara:</strong> {{ $service->date }}</p>

            <p><br>Apabila ada hal yang ingin disampaikan atau ditanyakan silahkan hubungi kami melalui:</p>
            <p>ID Line: @617rkppn</p>
            <p>Instagram: @umnmedicalcenter</p>
            <p>Tiktok: @umnmedicalcenter</p>
            <p>Hormat kami, UMN Medical Center</p>
            <p>terima kasih</p>

        </div>
    </div>
</body>
</html>