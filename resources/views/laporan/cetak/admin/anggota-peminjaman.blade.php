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
            <td style="text-align: center;" colspan="6"><strong>Laporan Anggota Perpustakaan yang Sering Melakukan Peminjaman Buku</strong>
            </td>
        </tr>
    </table>
    <table border=".1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Telpon</th>
                <th>Jumlah Pinjam</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggota_ as $anggota)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $anggota->user->nama }}</td>
                    <td>{{ $anggota->user->alamat }}</td>
                    <td>{{ $anggota->user->email }}</td>
                    <td>{{ $anggota->user->telpon }}</td>
                    <td class="text-center">{{ $anggota->peminjaman__count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
