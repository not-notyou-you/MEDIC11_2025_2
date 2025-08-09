<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Pengajuan Layanan Baru</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #800020; color: white; padding: 10px; text-align: center; }
        .content { padding: 20px; background-color: #f9f9f9; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #800020; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Notifikasi Pengajuan Layanan Baru</h2>
        </div>
        
        <div class="content">
            <p>Hallo,</p>
            <p>Terdapat pengajuan layanan baru dengan detail sebagai berikut:</p>
            
            <p><strong>Nama Pengaju:</strong> {{ $service->name }}</p>
            <p><strong>Email Pengaju:</strong> {{ $service->email }}</p>
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
            <p><strong>Lokasi:</strong> {{ $service->location }}</p>
            <p><strong>Catatan:</strong> {{ $service->note }}</p>
            
            @if ($service->type === 'Pengajuan Jasa')
                <p><strong>Jumlah Orang:</strong> {{ $service->person }}</p>
            @elseif ($service->type === 'Alat Kesehatan')
                <p><strong>Alat Kesehatan:</strong> {{ implode(', ', json_decode($service->medical_equipment) ?? []) }}</p>
            @endif

            <p>Silakan segera respon pengajuan ini:</p>
            <a href="{{ route('service.show') }}" class="btn">Buka Dashboard Admin</a>
            
            <p>=================================================================================</p>
            <p>ID Line: @617rkppn</p>
            <p>Instagram: @umnmedicalcenter</p>
            <p>Tiktok: @umnmedicalcenter</p>
        </div>
    </div>
</body>
</html>