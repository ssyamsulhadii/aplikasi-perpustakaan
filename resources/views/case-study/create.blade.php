<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Data</title>
</head>
<body>
    <form action="{{ route('case-study.store') }}" method="POST" style="width: 40%">
        @csrf
        <fieldset>
            <legend>Tambah Data</legend>
            <p>
                <label for="nama">Nama Rak : </label>
                <input type="text" name="nama" required id="nama">
            </p>
            <a href="{{ route('case-study.index') }}"><input type="button" value="Kembali"></a>
            <button type="submit">Simpan</button>
        </fieldset>
    </form>
</body>
</html>