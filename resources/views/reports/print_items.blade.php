<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekapitulasi Inventaris Sarpras - {{ date('d-m-Y') }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            color: #111;
            margin: 0;
            padding: 20px 40px;
        }
        .kop-surat {
            border-bottom: 3px double #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .kop-text {
            text-align: center;
            flex: 1;
        }
        .kop-text h2 {
            margin: 0;
            font-size: 14pt;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .kop-text h1 {
            margin: 4px 0;
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        .kop-text p {
            margin: 2px 0;
            font-size: 9pt;
            color: #333;
        }
        .judul-laporan {
            text-align: center;
            margin-bottom: 20px;
        }
        .judul-laporan h3 {
            margin: 0;
            font-size: 13pt;
            text-decoration: underline;
            text-transform: uppercase;
        }
        .judul-laporan p {
            margin: 4px 0 0;
            font-size: 9.5pt;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 9.5pt;
        }
        th, td {
            border: 1px solid #333;
            padding: 6px 8px;
        }
        th {
            background-color: #f1f5f9;
            font-weight: bold;
            text-align: left;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-mono { font-family: "Courier New", Courier, monospace; }
        .ttd-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            page-break-inside: avoid;
        }
        .ttd-box {
            width: 250px;
            text-align: center;
        }
        .ttd-space {
            height: 70px;
        }
        .no-print {
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            padding: 12px 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 6px;
        }
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <div>
            <strong>Mode Pratinjau Cetak Laporan Resmi</strong>
            <span style="font-size: 10pt; color: #64748b; margin-left: 10px;">Format Kop Resmi & Lembar Pengesahan Sarpras</span>
        </div>
        <div>
            <button onclick="window.print()" style="background: #0f172a; color: white; border: none; padding: 7px 16px; border-radius: 4px; font-weight: bold; cursor: pointer;">
                Cetak Dokumen / Simpan PDF
            </button>
            <button onclick="window.close()" style="background: #e2e8f0; color: #334155; border: none; padding: 7px 14px; border-radius: 4px; margin-left: 6px; cursor: pointer;">
                Tutup
            </button>
        </div>
    </div>

    <!-- Kop Surat Resmi -->
    <div class="kop-surat">
        <img src="{{ asset('images/logo.png') }}" alt="Logo SMKN 1 Ketapang" style="width: 72px; height: 72px; object-fit: contain; border-radius: 10px;">
        <div class="kop-text">
            <h2>PEMERINTAH PROVINSI KALIMANTAN BARAT</h2>
            <h2>DINAS PENDIDIKAN DAN KEBUDAYAAN</h2>
            <h1>SMK NEGERI 1 KETAPANG</h1>
            <p>Jalan Wolter Monginsidi No. 40, Ketapang &bull; Website: smkn1ketapang.sch.id &bull; Email: info@smkn1ketapang.sch.id</p>
        </div>
        <div style="width: 72px;"></div>
    </div>

    <!-- Judul Dokumen -->
    <div class="judul-laporan">
        <h3>REKAPITULASI DATA INVENTARIS SARANA & PRASARANA</h3>
        <p>Dicetak pada tanggal: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</p>
    </div>

    <!-- Tabel Data Barang -->
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 30px;">No</th>
                <th style="width: 85px;">Kode Barang</th>
                <th>Nama Sarpras / Aset</th>
                <th style="width: 130px;">Kategori</th>
                <th style="width: 120px;">Ruang / Penempatan</th>
                <th class="text-center" style="width: 45px;">Stok</th>
                <th class="text-center" style="width: 75px;">Kondisi</th>
                <th style="width: 90px;">Sumber Dana</th>
                <th class="text-center" style="width: 50px;">Tahun</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="font-mono font-bold">{{ $item->code }}</td>
                    <td>
                        <strong>{{ $item->name }}</strong>
                        @if($item->description)
                            <div style="font-size: 8pt; color: #555; margin-top: 2px;">{{ $item->description }}</div>
                        @endif
                    </td>
                    <td>{{ $item->category->name ?? '-' }}</td>
                    <td>{{ $item->location ?? '-' }}</td>
                    <td class="text-center font-mono"><strong>{{ $item->stock }}</strong></td>
                    <td class="text-center">{{ ucfirst($item->condition) }}</td>
                    <td>{{ $item->source_fund ?? '-' }}</td>
                    <td class="text-center font-mono">{{ $item->procurement_year ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center" style="padding: 20px;">Tidak ada data barang yang terdata.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr style="background: #f8fafc; font-weight: bold;">
                <td colspan="5" class="text-right">TOTAL UNIT FISIK KESELURUHAN:</td>
                <td class="text-center font-mono">{{ $data->sum('stock') }} Unit</td>
                <td colspan="3">({{ $data->count() }} Jenis Item)</td>
            </tr>
        </tfoot>
    </table>

    <!-- Tanda Tangan Pengesahan -->
    <div class="ttd-section">
        <div class="ttd-box">
            <p style="margin: 0;">Mengetahui,</p>
            <p style="margin: 2px 0 0; font-weight: bold;">Kepala Sekolah</p>
            <div class="ttd-space"></div>
            <p style="margin: 0; font-weight: bold; text-decoration: underline;">Dr. H. Bambang Sudarsono, M.Pd.</p>
            <p style="margin: 2px 0 0; font-size: 8.5pt;">NIP. 19740512 200003 1 002</p>
        </div>

        <div class="ttd-box">
            <p style="margin: 0;">Kota, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 2px 0 0; font-weight: bold;">Pengelola Sarana & Prasarana</p>
            <div class="ttd-space"></div>
            <p style="margin: 0; font-weight: bold; text-decoration: underline;">{{ Auth::user()->name }}</p>
            <p style="margin: 2px 0 0; font-size: 8.5pt;">NIP. 19880921 201201 1 008</p>
        </div>
    </div>
</body>
</html>
