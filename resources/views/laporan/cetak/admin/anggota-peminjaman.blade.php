@extends('laporan.layouts.main-cetak')
@section('content')
    <table class="table-item">
        <tr>
            <td style="text-align: center;" colspan="6"><strong>Laporan Anggota Perpustakaan yang Sering Melakukan Peminjaman Buku <br>Tahun {{ request('tahun') }}</strong>
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
                <th>Jumlah Pinjam</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($result->sortByDesc('peminjaman__count')->where('peminjaman__count', '>=', 5) as $value)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $value->nama }}</td>
                    <td>{{ $value->alamat }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->telpon }}</td>
                    <td class="text-center">{{ $value->peminjaman__count }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center"><h5>Data tidak ada.</h5></td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection