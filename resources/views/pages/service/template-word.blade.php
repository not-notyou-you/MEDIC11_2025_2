<!DOCTYPE html>
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word">
<head>
    <meta charset="UTF-8">
    <title>Permintaan Layanan - {{ $service->event_name }}</title>
    <style>
        /* Styles for Word document */
        @page {
            size: 21cm 29.7cm;
            margin: 2cm;
            mso-header-margin: 1.5cm;
            mso-footer-margin: 1.5cm;
        }
        
        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.5;
        }
        
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 20pt;
        }
        
        .header p {
            margin: 5px 0;
            font-size: 12pt;
        }
        
        .content {
            margin-bottom: 50px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        
        .signature-area {
            margin-top: 100px;
        }
        
        .signature-box {
            float: right;
            width: 300px;
            text-align: center;
        }
        
        .signature-line {
            border-bottom: 1px solid #000;
            height: 40px;
            margin-bottom: 5px;
        }
        
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10pt;
            border-top: 1px solid #000;
            padding-top: 5px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>FORMULIR PERMINTAAN LAYANAN</h1>
        <p>UMN MEDICAL CENTER</p>
        <p>Jl. Scientia Boulevard, Curug Sangereng, Kec. Klp. Dua, Kab. Tangerang, Banten 15810</p>
    </div>

    <!-- Content -->
    <div class="content">
        <table>
            <tr>
                <th colspan="2">Data Pemohon</th>
            </tr>
            <tr>
                <td width="30%">Nama Lengkap</td>
                <td>{{ $service->name }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $service->email }}</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>{{ $service->nim }}</td>
            </tr>
            <tr>
                <td>No. Telepon</td>
                <td>{{ $service->phone }}</td>
            </tr>
            <tr>
                <td>ID LINE</td>
                <td>{{ $service->line }}</td>
            </tr>
            <tr>
                <td>Organisasi</td>
                <td>{{ $service->organization }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>{{ $service->title }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="2">Detail Permintaan Layanan</th>
            </tr>
            <tr>
                <td width="30%">Jenis Layanan</td>
                <td>{{ $service->type }}</td>
            </tr>
            <tr>
                <td>Nama Kegiatan</td>
                <td>{{ $service->event_name }}</td>
            </tr>
            <tr>
                <td>Deskripsi Kegiatan</td>
                <td>{{ $service->description }}</td>
            </tr>
            <tr>
                <td>Tanggal Pengajuan</td>
                <td>{{ $service->created_at->format('d F Y H:i') }}</td>
            </tr>
            <tr>
                <td>Tanggal Pelaksanaan</td>
                <td>{{ \Carbon\Carbon::parse($service->date)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td>Waktu Pelaksanaan</td>
                <td>{{ $service->start_time }} - {{ $service->end_time }}</td>
            </tr>
            <tr>
                <td>Lokasi Kegiatan</td>
                <td>{{ $service->location }}</td>
            </tr>
            @if($service->type == 'Pengajuan Jasa')
            <tr>
                <td>Jumlah Personil</td>
                <td>{{ $service->person }} orang</td>
            </tr>
            @endif
        </table>

        @if($service->type == 'Alat Kesehatan' && !empty($service->medical_equipment))
        <table>
            <tr>
                <th>Alat Kesehatan yang Dipinjam</th>
            </tr>
            @foreach($service->medical_equipment as $equipment)
            <tr>
                <td>{{ ucwords($equipment) }}</td>
            </tr>
            @endforeach
        </table>
        @endif

        @if(!empty($service->note))
        <table>
            <tr>
                <th>Catatan Tambahan</th>
            </tr>
            <tr>
                <td>{{ $service->note }}</td>
            </tr>
        </table>
        @endif
    </div>

    <!-- Signature Area -->
    <div class="signature-area">
        <div class="signature-box">
            <p>Tangerang Selatan, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
            <p>Pemohon,</p>
            <div class="signature-line"></div>
            <p><strong>({{ $service->name }})</strong></p>
            <p>NIM: {{ $service->nim }}</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Dokumen ini dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y H:i:s') }}</p>
    </div>
</body>
</html>