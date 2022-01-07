<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Kartu</title>
    <style>
        .namaSingkat {
            height: 70px;
            width: 70px;
            font-size: 38px;
            background: orange;
            text-align: center;
            /* display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 100%; */
            padding: 10px;
        }

    </style>
</head>

<body>
    <table>
        <tbody>
            <tr>
                <td>
                    <img src="assets/images/logo-disperpus-40.png">
                </td>
                <td colspan="2" style="text-align: center">
                    <strong style="font-size: 20px">Kartu Anggota</strong>
                </td>
            </tr>
            <tr>
                <td>Id Anggota</td>
                <td> : {{ str_pad($user->id, 2, '0', STR_PAD_LEFT) }}</td>
                <td rowspan="5">
                    <div class="namaSingkat">
                        <strong style="margin-top: 15px">{{ $user->nama_singkat }}</strong>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Nama</td>
                <td> : {{ $user->nama }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td> : {{ $user->email }}</td>
            </tr>
            <tr>
                <td>Telpon</td>
                <td> : {{ $user->telpon }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td style="width: 300px"> : {{ $user->alamat }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
