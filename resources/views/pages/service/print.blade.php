<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Surat Permohonan Layanan - {{ $service->event_name }}</title>
    <style>
        @page {
            size: A4;
            margin: 2cm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.6;
            color: #000;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px double #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 16pt;
        }
        .header p {
            margin: 2px 0;
            font-size: 12pt;
        }
        .content {
            margin: 30px 0;
        }
        .section {
            margin-bottom: 15px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 5px;
            text-decoration: underline;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        .signature {
            margin-top: 70px;
            text-align: center;
            width: 50%;
            float: right;
        }
        .signature p {
            margin: 50px 0 0;
            border-top: 1px solid #000;
            display: inline-block;
            padding-top: 5px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            height: 80px;
        }
        .medical-equipment {
            margin-top: 10px;
            padding-left: 20px;
        }
        .medical-equipment li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="{{ public_path('images/logo-umn.png') }}" alt="Logo UMN">
        </div>
        <h1>UNIVERSITAS MULTIMEDIA NUSANTARA</h1>
        <p>Medical Center</p>
        <p>Jl. Scientia Boulevard, Gading Serpong, Tangerang, Banten 15811</p>
        <p>Telp: (021) 5422 0808 | Email: medicalcenter@umn.ac.id</p>
    </div>

    <div class="content">
        <div class="section">
            <div class="section-title">SURAT PERMOHONAN LAYANAN</div>
            <p>Nomor: UMN-MC/{{ date('Y') }}/{{ $service->id }}</p>
        </div>

        <div class="section">
            <p>Yang bertanda tangan di bawah ini:</p>
            
            <table class="table">
                <tr>
                    <th width="30%">Nama</th>
                    <td>{{ $service->name }}</td>
                </tr>
                <tr>
                    <th>NIM</th>
                    <td>{{ $service->nim }}</td>
                </tr>
                <tr>
                    <th>Organisasi</th>
                    <td>{{ $service->organization }}</td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td>{{ $service->title }}</td>
                </tr>
                <tr>
                    <th>Kontak</th>
                    <td>
                        Telp: {{ $service->phone }}<br>
                        LINE: {{ $service->line }}<br>
                        Email: {{ $service->email }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <p>Dengan ini mengajukan permohonan layanan sebagai berikut:</p>
            
            <table class="table">
                <tr>
                    <th width="30%">Jenis Layanan</th>
                    <td>{{ $service->type }}</td>
                </tr>
                <tr>
                    <th>Nama Acara</th>
                    <td>{{ $service->event_name }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $service->description }}</td>
                </tr>
                <tr>
                    <th>Tanggal & Waktu</th>
                    <td>
                        {{ \Carbon\Carbon::parse($service->date)->format('d F Y') }}<br>
                        {{ \Carbon\Carbon::parse($service->start_time)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($service->end_time)->format('H:i') }} WIB
                    </td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td>{{ $service->location }}</td>
                </tr>
                @if($service->type === 'Pengajuan Jasa')
                <tr>
                    <th>Jumlah Orang</th>
                    <td>{{ $service->person }} orang</td>
                </tr>
                @else
                <tr>
                    <th>Alat Kesehatan</th>
                    <td>
                        <ul class="medical-equipment">
                            @foreach($service->medical_equipment ?? [] as $equipment)
                                <li>{{ ucfirst($equipment) }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                @endif
                @if($service->note)
                <tr>
                    <th>Catatan</th>
                    <td>{{ $service->note }}</td>
                </tr>
                @endif
                <tr>
                    <th>Status</th>
                    <td>{{ $service->status }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <td>{{ \Carbon\Carbon::parse($service->created_at)->format('d F Y H:i') }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <p>Demikian permohonan ini kami buat dengan sebenarnya. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.</p>
        </div>
    </div>

    <div class="footer">
        <div class="signature">
            <p>Hormat kami,</p>
            <p>{{ $service->name }}</p>
            <p>{{ $service->organization }}</p>
        </div>
    </div>

    <div class="footer" style="margin-top: 100px;">
        <div class="signature">
            <p>Mengetahui,</p>
            <p>Koordinator Medical Center</p>
            <p>Universitas Multimedia Nusantara</p>
        </div>
    </div>
</body>
</html>