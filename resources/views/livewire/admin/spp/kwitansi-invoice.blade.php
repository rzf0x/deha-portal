<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Pembayaran</title>
    <style>
        /* Reset and Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 10rem auto 0;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .details-table th,
        .details-table td {
            padding: 10px;
            border: 1px solid #e0e0e0;
            text-align: left;
        }

        .details-table th {
            background-color: #f8f9fa80;
            color: #333;
        }

        .details-table td {
            background-color: #ffffff80;
        }

        .details-table tr:nth-child(even) td {
            background-color: #f9f9f980;
        }

        .total-section {
            margin-top: 20px;
            text-align: right;
            font-size: 16px;
            font-weight: bold;
        }

        .installments {
            margin-top: 30px;
        }

        .container h2 {
            font-size: 18px;
            color: #444;
            margin-bottom: 10px;
        }

        .installments-table {
            width: 100%;
            border-collapse: collapse;
        }

        .installments-table th,
        .installments-table td {
            padding: 10px;
            border: 1px solid #e0e0e080;
            text-align: left;
        }

        .installments-table th {
            background-color: #f8f9fa80;
            color: #333;
        }

        .installments-table td {
            background-color: #ffffff80;
        }

        .installments-table tr:nth-child(even) td {
            background-color: #f9f9f980;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>

<body>
    <div
        style="position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            z-index: -1;
            background-image: url('{{ public_path('kwitansi/Invoice ' . ($pembayaran->status === 'lunas' ? 'Sudah' : 'Belum') . ' Lunas DH.jpg') }}');">

    </div>
    <div class="container">
        <h2>Kwitansi</h2>
        <table class="details-table">
            <tr>
                <th>Nomor Kwitansi</th>
                <td>{{ $pembayaran->id }}</td>
            </tr>
            <tr>
                <th>Nama Santri</th>
                <td>{{ $pembayaran->santri->nama }}</td>
            </tr>
            <tr>
                <th>NISN</th>
                <td>{{ $pembayaran->santri->nisn }}</td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td>{{ $pembayaran->santri->kelas?->nama }}</td>
            </tr>
            <tr>
                <th>Semester</th>
                <td>{{ $pembayaran->santri->semester?->nama }}</td>
            </tr>
            <tr>
                <th>Angkatan</th>
                <td>{{ $pembayaran->santri->angkatan?->tahun }}</td>
            </tr>
            <tr>
                <th>Tipe Pembayaran</th>
                <td>{{ $pembayaran->pembayaranTipe?->nama }}</td>
            </tr>
            <tr>
                <th>Bulan Pembayaran</th>
                <td>{{ $pembayaran->pembayaranTimeline?->nama_bulan }}</td>
            </tr>
            <tr>
                <th>Nominal Pembayaran</th>
                <td>Rp. {{ number_format($pembayaran->nominal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Metode Pembayaran</th>
                <td>{{ ucfirst($pembayaran->metode_pembayaran) }}</td>
            </tr>
            <tr>
                <th>Status Pembayaran</th>
                <td>{{ ucfirst($pembayaran->status) }}</td>
            </tr>
            <tr>
                <th>Tanggal Pembayaran</th>
                <td>{{ \Carbon\Carbon::parse($pembayaran->updated_at)->format('d M Y H:i') }}</td>
            </tr>
        </table>

        @if ($pembayaran->status == 'cicilan')
            <div class="installments">
                <h2>Rincian Cicilan</h2>
                <table class="installments-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nominal</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalCicilan = 0; @endphp
                        @foreach ($pembayaran->cicilans as $cicilan)
                            @php $totalCicilan += $cicilan->nominal; @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>Rp. {{ number_format($cicilan->nominal, 0, ',', '.') }}</td>
                                <td>{{ $cicilan->keterangan }}</td>
                                <td>{{ \Carbon\Carbon::parse($cicilan->created_at)->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">Total</th>
                            <th>Rp. {{ number_format($totalCicilan, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @endif

        <div class="footer">
            <p>Terima kasih atas pembayaran Anda.</p>
        </div>
    </div>
</body>

</html>
