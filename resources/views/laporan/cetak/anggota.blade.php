@extends('laporan.layouts.main-cetak')
@section('content')
<table class="table-item" >
    <tr>
        <td><strong>Laporan Anggota Perpustakaan
                {{ request('rak') ?? request('kategori') }}</strong>
        </td>
    </tr>
</table>
<table class="table-item" border=".1">
    <thead>
        <tr style="background: dodgerblue">
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>Telpon</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($anggota_ as $anggota)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $anggota->nama }}</td>
                <td>{{ $anggota->alamat }}</td>
                <td>{{ $anggota->email }}</td>
                <td>{{ $anggota->telpon }}</td>
            </tr>
        @empty
            <tr style="text-align: center">
                <td colspan="5"><h5>Data tidak ditemukan</h5></td>
            </tr>
        @endforelse

    </tbody>
</table>
@endsection