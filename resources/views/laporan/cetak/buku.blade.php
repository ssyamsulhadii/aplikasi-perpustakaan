@extends('laporan.layouts.main-cetak')
@section('content')
<table class="table-item">
    <tr>
        <td style="text-align: center;"><strong>Laporan Buku
            @if(request('kategori'))
                {{ \App\Models\Kategori::find(request('kategori'))->nama  }}
            @endif
        </strong>
        </td>
    </tr>
    <tr>
        <td style="text-align: left;">Jumlah Buku : <strong>{{ count($buku_) }}</strong>
        </td>
    </tr>
</table>
<table class="table-item" border=".1">
    <thead>
        <tr style="background: dodgerblue">
            <th>No</th>
            <th>Cover</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Dibaca</th>
            <th>Kategori Buku</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($buku_ as $buku)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><img style="width: 40px; height: 40px;" src="{{ $buku->sampul_url }}" ></td>
                <td style="width: 120px">{{ $buku->judul }}</td>
                <td style="width: 120px">{{ $buku->penulis }}</td>
                <td style="width: 120px">{{ $buku->penerbit }}</td>
                <td>{{ $buku->dibaca }}</td>
                <td>{{ $buku->kategori->nama ?? 'tidak terdaftar' }}</td>
            </tr>
            @empty
                <tr style="text-align: center">
                    <td colspan="7"><h5>Data tidak ditemukan</h5></td>
                </tr>
            @endforelse
    </tbody>
</table>
@endsection