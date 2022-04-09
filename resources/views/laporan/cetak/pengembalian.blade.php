@extends('laporan.layouts.main-cetak')
@section('content')
    <table class="table-item">
        <tr>
            <td style="text-align: center;">
                <strong>Laporan Pengembalian Buku</strong>
            </td>
        </tr>
    </table>
    <table style="margin-left:50px;">
        <tr>
            <td>
                Periode Tanggal : {{ $tanggal_from->isoFormat('DD-MM-YYYY') }} s.d {{ $tanggal_to->isoFormat('DD-MM-YYYY') }}
            </td>
        </tr>
        <tr>
            <td>
                Jumlah Pengembalian : <strong>{{ count($pengembalian_) }}</strong>
            </td>
        </tr>
    </table>
    <table class="table-item" border=".1">
        <thead>
            <tr style="background: dodgerblue">
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Tanggal Kembali Over</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengembalian_ as $pengembalian)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengembalian->kode }}</td>
                    <td>{{ $pengembalian->peminjaman->user->nama }}</td>
                    <td style="width: 120px">{{ $pengembalian->peminjaman->buku->judul }}</td>
                    <td>{{ $pengembalian->peminjaman->tanggal_pinjam->isoFormat('DD-MM-YYYY ') }}</td>
                    <td>{{ $pengembalian->tanggal_kembali->isoFormat('DD-MM-YYYY ') }}</td>
                    <td>{{ $pengembalian->tanggal_kembali_over == null ? '-' : $pengembalian->tanggal_kembali_over->isoFormat('DD-MM-YYYYY') }}</td>
                    <td>{{ $pengembalian->denda ?? '-' }}</td>
                </tr>
            @empty
                <tr style="text-align: center">
                    <td colspan="8"><h5>Data tidak ditemukan</h5></td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection