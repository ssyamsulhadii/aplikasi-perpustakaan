@extends('laporan.layouts.main-cetak')
@section('content')
    <table class="table-item">
        <tr>
            <td style="text-align: center;" colspan="4"><strong>Laporan Kategori Buku
                    @if(request('rak'))
                        {{ \App\Models\Rak::find(request('rak'))->nama }}
                    @endif
                </strong>
            </td>
        </tr>
    </table>
    <table class="table-item" border=".1">
        <thead>
            <tr style="background: dodgerblue">
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Jumlah Buku</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kategori_ as $kategori)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kategori->nama }}</td>
                    <td class="text-center">{{ $kategori->buku__count }}</td>
                </tr>
            @empty
                <tr style="text-align: center">
                    <td colspan="3"><h5>Data tidak ditemukan</h5></td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection