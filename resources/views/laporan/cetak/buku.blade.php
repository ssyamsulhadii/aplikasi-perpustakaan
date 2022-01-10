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
            <td style="text-align: center;" colspan="6"><strong>Laporan Buku
                @if(request('kategori'))
                    {{ \App\Models\Kategori::find(request('kategori'))->nama  }}
                @endif
            </strong>
            </td>
        </tr>
        <tr>
            <td style="text-align: left;" colspan="6">Jumlah Buku : <strong>{{ count($buku_) }}</strong>
            </td>
        </tr>
    </table>
    <table border=".1">
        <thead>
            <tr>
                <th>No</th>
                <th>Cover</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Dibaca</th>
                <th>Kategori Buku</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($buku_ as $buku)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img style="width: 40px; height: 40px;" src="{{ $buku->sampul_url }}" ></td>
                    <td style="width: 120px">{{ $buku->judul }}</td>
                    <td style="width: 120px">{{ $buku->penulis }}</td>
                    <td style="width: 120px">{{ $buku->penerbit }}</td>
                    <td>{{ $buku->dibaca }}</td>
                    <td>{{ $buku->kategori->nama ?? 'tidak terdaftar' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
