<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Sudah Diterima</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #4CAF50; color: white; padding: 10px; text-align: center; }
        .content { padding: 20px; background-color: #f9f9f9; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pengajuan Sudah Telah Selesai</h2>
        </div>
        
        <div class="content">
            <p>Hallo {{ $service->name }},</p>
            
            <p>Terima kasih telah melakukan pengajuan kepada kami</p>
            <p>Pengajuan telah selesai sesuai dengan yang di harapkan</p>

            <p>Pengajuan layanan Anda dengan detail :</p>
            
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
            
            <p>Berikut yang dapat kami sampaikan, untuk informasi lebih lanjut dapat menghubungi kami melalui:</p>
            <p>ID Line: @617rkppn</p>
            <p>Instagram: @umnmedicalcenter</p>
            <p>Tiktok: @umnmedicalcenter</p>
            
            <p><br>terima kasih</p>
        </div>
    </div>
</body>
</html>
