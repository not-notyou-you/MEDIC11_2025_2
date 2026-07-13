<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pengajuan Alat Kesehatan & Obat-Obatan</title>
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
        background-color: #e6f0ff;
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
            FORMULIR PENGAJUAN <br>
            ALAT KESEHATAN & OBAT-OBATAN <br>
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
        <li>Alat kesehatan yang dipinjam WAJIB dijaga dan dikembalikan dengan keadaan serupa. Apabila hilang atau rusak, pihak pengaju bersedia mengganti dengan barang yang sama.</li>
        <li>Apabila pihak pengaju melakukan kesalahan lebih dari dua kali, maka pihak UMN Medical Center berhak <i>mem-blacklist</i> selama 1 tahun pihak pengaju yang merusak alat kesehatan / obat-obatan yang dipinjam.</li>
        <li>Apabila pihak pengaju terlambat mengembalikan alat kesehatan maupun obat-obatan, harap menginformasikan hal tersebut kepada pihak UMN Medical Center.</li>
        <li>Apabila pihak pengaju mengalami kesulitan dalam menggunakan alat-alat kesehatan atau obat-obatan, harap menanyakan pada pihak UMN Medical Center.</li>
        <li>Pihak UMN Medical Center berhak menolak pengajuan peminjaman apabila tidak sesuai prosedur atau di luar kemampuan pihak Medic.</li>
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
