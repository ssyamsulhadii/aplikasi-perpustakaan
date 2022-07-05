<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Data</title>
</head>
<body>
    <form action="{{ route('case-study.update', ['case_study' => $rak->id]) }}" method="POST" style="width: 40%">
        @csrf @method('PUT')
        <fieldset>
            <legend>Edit Data</legend>
            <p>
                <label for="nama">Nama Rak : </label>
                <input type="text" name="nama" required id="nama" value="{{ $rak->nama }}">
            </p>
            <a href="{{ route('case-study.index') }}"><input type="button" value="Kembali"></a>
            <button type="submit">Simpan Perubahan</button>
        </fieldset>
    </form>
</body>
</html>