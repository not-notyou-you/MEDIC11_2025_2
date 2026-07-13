<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pengajuan Jasa Medis</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 80%;
        margin: auto;
        padding: 20px;
        border: 1px solid black;
        background-color: #fef9ef;
    }
    .header, .footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid black;
        padding-bottom: 10px;
        margin-bottom: 25px; /* sedikit lebih besar */
    }
    .footer {
        border-top: 2px solid black;
        border-bottom: none;
        padding-top: 15px;
        margin-top: 35px;
    }
    .logo {
        height: 120px;
        width: 160px;
        object-fit: contain;
    }
    .title {
        text-align: center;
        font-weight: bold;
        line-height: 1.6; /* lebih lega */
    }
    .form-group {
        margin-bottom: 12px; /* lebih besar */
        line-height: 1.6; /* supaya teks dalam satu baris lebih renggang */
    }
    .form-group label {
        display: inline-block;
        width: 250px;
    }
    p {
        line-height: 1.6;
        margin-bottom: 12px;
    }
    ul {
        padding-left: 20px;
        line-height: 1.6;
        margin-bottom: 20px;
    }
    .signature-section {
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
    }
    .signature {
        text-align: center;
        width: 45%;
        line-height: 1.6;
    }
    .signature-space {
        height: 100px; /* ruang kosong tanda tangan */
    }
    .signature-line {
        margin-top: 10px;
        border-top: 1px solid black;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }
    .contact-info {
        display: flex;
        justify-content: center;
        gap: 25px; /* jarak antar item contact lebih lebar */
        font-size: 14px;
        line-height: 1.6;
    }
    .contact-info img {
        width: 18px;
        height: 18px;
        object-fit: contain;
        vertical-align: middle;
    }
</style>
</head>
<body>
<div class="container">
    <!-- HEADER -->
    <div class="header">
        <img src="{{ asset('assets/logo/MedicGreen_highres.webp') }}" alt="Medical Center" class="logo">
        <div class="title">
            FORMULIR PENGAJUAN JASA MEDIC<br>
            UMN MEDICAL CENTER
        </div>
        <img src="{{ asset('assets/logo/UMN.webp') }}" alt="UMN" class="logo">
    </div>

    <!-- FORM -->
    <div class="form">
        <div class="form-group"><label>Nama Pengaju / NIM</label>: ________________________</div>
        <div class="form-group"><label>Nomor Telepon</label>: ________________________ ID LINE : ________________________</div>
        <div class="form-group"><label>Nama Organisasi & Jabatan</label>: ________________________</div>
        <div class="form-group"><label>Nama Acara</label>: ________________________</div>
        <div class="form-group"><label>Hari / Tanggal Pelaksanaan</label>: ________________________</div>
        <div class="form-group"><label>Waktu, Tempat Pelaksanaan</label>: ________________________</div>
        <div class="form-group"><label>Hari / Tanggal Pengembalian</label>: ________________________</div>
        <div class="form-group"><label>Deskripsi Acara</label>: ________________________</div>
        <div class="form-group"><label>Keterangan</label>: ________________________</div>
    </div>

    <p><b>Dengan ini menyetujui bahwa:</b></p>
    <ul>
        <li>Wajib mengadakan <i>technical meeting</i> antara pengaju dan perwakilan dari Medic minimal H-2 sebelum acara berlangsung.</li>
        <li>Wajib memperlakukan anggota UMN Medical Center yang bertugas dengan baik sesuai aturan norma yang berlaku.</li>
        <li>Jika ditemukan perlakuan yang tidak baik terhadap anggota Medic, maka pihak UMN Medical Center berhak memberikan sanksi dengan menarik anggota dari pengajuan jasa dan bahkan <i>mem-blacklist</i> pihak pengaju.</li>
        <li>Pihak UMN Medical Center berhak menolak pengajuan jasa medis jika pengajuan tersebut tidak sesuai prosedur atau di luar kemampuan anggota Medic.</li>
    </ul>

    <!-- SIGNATURE -->
    <div style="text-align: right; margin-top: 20px;">
        Tangerang, __________
    </div>

    <div class="signature-section">
        <div class="signature">
            Pengaju Alat Kesehatan
            <div class="signature-space"></div>
            (tanda tangan)
            <div class="signature-line"></div>
            (nama)
        </div>
        <div class="signature">
            BPH UMN Medical Center
            <div class="signature-space"></div>
            (tanda tangan)
            <div class="signature-line"></div>
            (nama)
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <div class="contact-info">
            <span><img src="{{ asset('assets/logo/mail.webp') }}"> umnmedicalcenter@umn.ac.id</span>
            <span><img src="{{ asset('assets/logo/line.webp') }}"> @617rpkn</span>
            <span><img src="{{ asset('assets/logo/phone.webp') }}"> 7000</span>
            <span><img src="{{ asset('assets/logo/instagram.webp') }}"> @umnmedicalcenter</span>
        </div>
    </div>
</div>
</body>
</html>
