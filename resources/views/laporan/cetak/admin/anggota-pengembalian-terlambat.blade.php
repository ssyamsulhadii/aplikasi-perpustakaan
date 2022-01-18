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
            <td style="text-align: center;" colspan="6"><strong>Laporan Anggota Perpustakaan yang Melakukan Keterlambatan Pengembalian Buku</strong>
            </td>
        </tr>
    </table>
    <table border=".1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Tanggal Kembali Over</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggota_ as $anggota)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $anggota->user->nama }}</td>
                    <td>{{ $anggota->user->alamat }}</td>
                    <td class="text-center">
                        @foreach ($anggota->pengembalian_->where('denda', '!=', null) as $pengembalian)
                            {{ $pengembalian->peminjaman->tanggal_pinjam->isoFormat('DD-MM-YYYY') }} <br>
                        @endforeach
                    </td>
                    <td class="text-center">
                        @foreach ($anggota->pengembalian_->where('denda', '!=', null) as $pengembalian)
                            {{ $pengembalian->peminjaman->tanggal_kembali->isoFormat('DD-MM-YYYY') }} <br>
                        @endforeach
                    </td>
                    <td class="text-center">
                        @foreach ($anggota->pengembalian_->where('denda', '!=', null) as $pengembalian)
                            {{ $pengembalian->tanggal2 }} <br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
