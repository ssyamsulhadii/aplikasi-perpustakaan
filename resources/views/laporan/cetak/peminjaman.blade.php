@extends('laporan.layouts.main-cetak')
@section('content')
    <table class="table-item">
        <tr>
            <td>
                <strong>Laporan Peminjaman Buku</strong>
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
                Jumlah Peminjaman : <strong>{{ count($peminjaman_) }}</strong>
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
                <th>Jumlah Buku</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjaman_ as $peminjaman)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $peminjaman->kode }}</td>
                    <td>{{ $peminjaman->user->nama }}</td>
                    <td style="width: 120px">{{ $peminjaman->buku->judul }}</td>
                    <td>{{ $peminjaman->tanggal_pinjam->isoFormat('DD-MM-YYYY ') }}</td>
                    <td>{{ $peminjaman->tanggal_kembali->isoFormat('DD-MM-YYYY ') }}</td>
                    <td class="text-center">{{ $peminjaman->jumlah_pinjam }}</td>
                    <td class="text-center">{{ $peminjaman->string_status }}</td>
                </tr>
            @empty
                <tr style="text-align: center">
                    <td colspan="8"><h5>Data tidak ditemukan</h5></td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection