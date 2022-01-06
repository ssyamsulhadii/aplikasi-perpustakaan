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
        @include('laporan.cetak.logo-header', ['barisSatu' => 3, 'barisDua' => 4])
        <tr>
            <td style="text-align: center;" colspan="4"><strong>Laporan Kategori Buku
                    @if(request('rak'))
                        {{ \App\Models\Rak::find(request('rak'))->nama }}
                    @endif
                </strong>
            </td>
        </tr>
    </table>
    <table border=".1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Jumlah Buku</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategori_ as $kategori)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kategori->nama }}</td>
                    <td class="text-center">{{ $kategori->buku__count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
