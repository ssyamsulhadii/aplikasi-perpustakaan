@extends('laporan.layouts.main-cetak')
@section('content')
    <table class="table-item">
        <tr>
            <td><strong>Laporan Peminjaman Buku
                    {{ request('rak') ?? request('kategori') }}</strong>
            </td>
        </tr>
        <tr>
            <td><strong>Nama : {{ $anggota->nama }}
                    {{ request('rak') ?? request('kategori') }}</strong>
            </td>
        </tr>
    </table>
    <table class="table-item" border=".1">
        <thead>
            <tr style="background: dodgerblue">
                <th>No</th>
                <th>Kode</th>
                <th>Judul</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($anggota->peminjaman_->sortByDesc('tanggal_kembali') as $peminjaman)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $peminjaman->kode }}</td>
                    <td>{{ $peminjaman->buku->judul }}</td>
                    <td>{{ $peminjaman->tanggal_pinjam->isoFormat('DD-MM-YYYY ') }}</td>
                    <td>{{ $peminjaman->tanggal_kembali->isoFormat('DD-MM-YYYY ') }}</td>
                    <td>{{ $peminjaman->string_status }}</td>
                </tr>
            @empty
                <tr style="text-align: center">
                    <td colspan="6"><h5>Data tidak ditemukan</h5></td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection