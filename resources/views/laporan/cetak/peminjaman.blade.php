<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data</title>
    <style>
        body {
            background: white;
        }

        table {
            border-collapse: collapse;
            margin: auto;
        }


        th,
        td {
            text-align: left;
            padding: 5px;
        }

        th {
            background: DodgerBlue;
        }

        .no {
            background: white;
        }

        .text-center {
            text-align: center;
        }

    </style>
</head>

<body>
    <table style="margin-bottom: 10px">
        @include('laporan.cetak.logo-header', ['barisSatu' => 5, 'barisDua' => 6])
        <tr>
            <td style="text-align: center;" colspan="6">
                <strong>Laporan Peminjaman Buku</strong>
            </td>
        </tr>
    </table>
    <table style="margin-left:-220px;">
        <tr>
            <td>
                Periode Tanggal : {{ $tanggal_from->isoFormat('DD-MM-YYYY') }} s.d {{ $tanggal_to->isoFormat('DD-MM-YYYY') }}
            </td>
        </tr>
        <tr>
            <td>
                Jumlah Peminjaman : <strong>{{ count($peminjaman_) }}</strong>
            </td>
        </tr>
    </table>
    <table border=".1">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Jumlah Buku</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman_ as $peminjaman)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $peminjaman->kode }}</td>
                    <td>{{ $peminjaman->anggota->user->nama }}</td>
                    <td style="width: 120px">{{ $peminjaman->buku->judul }}</td>
                    <td>{{ $peminjaman->tanggal_pinjam->isoFormat('DD-MM-YYYY ') }}</td>
                    <td>{{ $peminjaman->tanggal_kembali->isoFormat('DD-MM-YYYY ') }}</td>
                    <td class="text-center">{{ $peminjaman->jumlah_pinjam }}</td>
                    <td class="text-center">{{ $peminjaman->string_status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
