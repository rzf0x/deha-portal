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
            margin: 9rem auto 0;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            font-size: 18px;
            color: #444;
            margin-bottom: 10px;
        }

        div {
            margin-bottom: 20px;
            /* Jarak antar div */
        }

        p {
            padding: 5px 0;
            /* Jarak dalam paragraf */
        }

        .details-table {
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .details-table th,
        .details-table td {
            padding: 5px 0;
            text-align: left;
        }

        .details-table.detail-pembayaran {
            width: 100% !important;
        }

        .details-table.detail-pembayaran th {
            width: initial;
        }

        .details-table.detail-pembayaran td {
            padding-right: 3rem;
            text-align: right;
        }

        .details-table th {
            width: 15rem;
            color: #333;
        }

        .details-table tr.total {
            border-top: 2px solid #333;
        }

        .details-table td.total {
            font-weight: 800;
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
        <h1 style="font-size:1.5rem; text-align: center; margin-bottom: 2rem;">Surat Bukti Pembayaran SPP Bulanan</h1>
        <h2>Biodata</h2>
        <div>
            <p><strong>Nama Santri:</strong> {{ $pembayaran->santri->nama }}</p>
            <p>
                <strong>Tempat & Tanggal Lahir:</strong>
                {{ $pembayaran->santri->tempat_lahir }},
                {{ \Carbon\Carbon::parse($pembayaran->santri->tanggal_lahir)->format('d M Y') }}
            </p>
            <p><strong>Kelas:</strong> {{ $pembayaran->santri->kelas?->nama }}</p>
            <p><strong>Jenjang:</strong> {{ $pembayaran->santri->kelas?->jenjang?->nama }}</p>
            <p><strong>Kamar:</strong> {{ $pembayaran->santri->Kamar?->nama }}</p>
        </div>

        <h2>List Pembayaran</h2>
        <div>
            <p><strong>Bulan Pembayaran:</strong> {{ $pembayaran->pembayaranTimeline?->nama_bulan }}</p>
            <p><strong>Status Pembayaran:</strong> {{ ucfirst($pembayaran->status) }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $pembayaran->metode_pembayaran }}</p>
            <p><strong>Nominal Pembayaran:</strong> Rp.
                {{ number_format($cicilan->nominal ?? $pembayaran->nominal, 0, ',', '.') }}</p>
            <p><strong>Tanggal Pembayaran:</strong>
                {{ \Carbon\Carbon::parse($cicilan->updated_at ??$pembayaran->updated_at)->format('d M Y H:i') }}</p>
        </div>

        @if (empty($cicilan))
            <h2>Detail Pembayaran</h2>

            <table class="details-table detail-pembayaran">
                @forelse ($detailPembayaran as $detail)
                    <tr>
                        <th>{{ $detail?->nama }} :</th>
                        <td>Rp. {{ number_format($detail?->nominal, 0, ',', '.') }}</td>
                    </tr>
                @empty
                @endforelse
                <tr class="total">
                    <th>Total :</th>
                    <td>Rp. {{ number_format($detailPembayaran?->sum('nominal'), 0, ',', '.') }}</td>
                </tr>
            </table>
        @else
            <h2>Detail Cicilan</h2>

            <table class="details-table detail-pembayaran">
                <tr>    
                    <th>Keterangan: {{ $cicilan?->keterangan }}</th>
                    <td>Nominal: Rp. {{ number_format($cicilan?->nominal, 0, ',', '.') }}</td>
                </tr>

                <tr class="total">
                    <th>Total Cicilan Bulan {{ $pembayaran->pembayaranTimeline?->nama_bulan }}: </th>
                    <td>Rp. {{ number_format($cicilan?->sum('nominal'), 0, ',', '.') }}</td>
                </tr>
            </table>
        @endif
    </div>
</body>

</html>
