@extends('laporan.layouts.main-cetak')
@section('content')
    <table class="table-item">
        <tr>
            <td style="text-align: center;"><strong>Laporan Anggota Perpustakaan yang Melakukan Keterlambatan Pengembalian Buku <br> Tahun {{ request('tahun') }}</strong>
            </td>
        </tr>
    </table>
    <table class="table-item" border=".1">
        <thead>
            <tr style="background: dodgerblue">
                <th>No</th>
                <th>Nama</th>
                <th>Buku</th>
                <th>Alamat</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Tanggal Kembali Over</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($result as $value)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $value->peminjaman->user->nama }}</td>
                    <td>{{ $value->peminjaman->buku->judul }}</td>
                    <td>{{ $value->peminjaman->user->alamat }}</td>
                    <td>{{ $value->peminjaman->tanggal_pinjam->isoFormat('DD-MM-YYYY') }}</td>
                    <td>{{ $value->peminjaman->tanggal_kembali->isoFormat('DD-MM-YYYY') }}</td>
                    <td>{{ $value->tanggal_kembali_over->isoFormat('DD-MM-YYYY') }}</td>
                    <td>Rp. {{ $value->denda }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center"><h5>Data tidak ada.</h5></td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection