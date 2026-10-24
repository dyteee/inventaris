<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Sirkulasi Peminjaman Sarpras - {{ date('d-m-Y') }}</title>
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
            <strong>Mode Pratinjau Cetak Laporan Sirkulasi</strong>
            <span style="font-size: 10pt; color: #64748b; margin-left: 10px;">Format Laporan Resmi Peminjaman & Pengembalian Sarpras</span>
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
        <h3>BUKU CATATAN SIRKULASI PEMINJAMAN SARANA & PRASARANA</h3>
        <p>
            Dicetak pada tanggal: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB
            @if($startDate && $endDate)
                &bull; Periode: {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d M Y') }} s.d. {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d M Y') }}
            @endif
        </p>
    </div>

    <!-- Tabel Data Transaksi -->
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 30px;">No</th>
                <th style="width: 80px;">ID Transaksi</th>
                <th>Nama Peminjam</th>
                <th>Barang Yang Dipinjam</th>
                <th class="text-center" style="width: 50px;">Jumlah</th>
                <th style="width: 100px;">Tgl Pinjam</th>
                <th style="width: 100px;">Batas Kembali</th>
                <th class="text-center" style="width: 85px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $loan)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="font-mono">#TRX-{{ $loan->id }}</td>
                    <td>
                        <strong>{{ $loan->user->name ?? '-' }}</strong>
                    </td>
                    <td>
                        <strong>{{ $loan->item->name ?? '-' }}</strong>
                        <div style="font-size: 8pt; color: #555; font-family: monospace;">Kode: {{ $loan->item->code ?? '-' }}</div>
                    </td>
                    <td class="text-center font-mono"><strong>{{ $loan->quantity }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($loan->loan_date)->translatedFormat('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($loan->due_date)->translatedFormat('d/m/Y') }}</td>
                    <td class="text-center">
                        <strong>{{ ucfirst($loan->status) }}</strong>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 20px;">Tidak ada catatan transaksi peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr style="background: #f8fafc; font-weight: bold;">
                <td colspan="4" class="text-right">TOTAL BARANG DIPINJAM:</td>
                <td class="text-center font-mono">{{ $data->sum('quantity') }} Unit</td>
                <td colspan="3">({{ $data->count() }} Kali Transaksi)</td>
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
            <p style="margin: 2px 0 0; font-weight: bold;">Petugas Pelayanan Sarpras</p>
            <div class="ttd-space"></div>
            <p style="margin: 0; font-weight: bold; text-decoration: underline;">{{ Auth::user()->name }}</p>
            <p style="margin: 2px 0 0; font-size: 8.5pt;">NIP. 19880921 201201 1 008</p>
        </div>
    </div>
</body>
</html>
