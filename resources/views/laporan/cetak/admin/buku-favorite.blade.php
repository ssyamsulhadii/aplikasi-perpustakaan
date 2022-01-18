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
            <td style="text-align: center;" colspan="6"><strong>Laporan Buku Terfavorite yang Sering dipinjam</strong></td>
        </tr>
    </table>
    <table border=".1">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori Buku</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Dibaca</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategori_ as $kategori)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kategori->nama }}</td>
                    <td>
                        @foreach ($kategori->buku_->where('dibaca', '>', 25) as $buku)
                                {{ $buku->judul }} <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($kategori->buku_->where('dibaca', '>', 25) as $buku)
                        {{ $buku->penulis }} <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($kategori->buku_->where('dibaca', '>', 25) as $buku)
                        {{ $buku->penerbit }} <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($kategori->buku_->where('dibaca', '>', 25) as $buku)
                        {{ $buku->dibaca }} <br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
