<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tampil Data</title>
</head>
<body>
    <div style="margin-bottom: 15px; margin-top: 15px">
        <a href="{{ route('case-study.create') }}"><input type="button" value="Tambah Data"></a>
    </div>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Opsi</th>
            </tr>
            <tbody>
                @foreach ($rak_ as $rak)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rak->nama }}</td>
                        <td>
                            <form action="{{ route('case-study.destroy', ['case_study'=> $rak->id]) }}" method="POST" style="display: inline"
                                onclick="return confirm('Yakin menghapus data ini ?')"
                                >
                                @csrf @method('DELETE')
                                <button type="submit">Hapus</button>
                            </form>
                            <a href="{{ route('case-study.edit', ['case_study'=>$rak->id]) }}"><input type="button" value="Edit"></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </thead>
    </table>

    @if (session()->has('pesan'))
        <script>
            alert("{{ session()->get('pesan') }}")
        </script>
    @endif
</body>
</html>