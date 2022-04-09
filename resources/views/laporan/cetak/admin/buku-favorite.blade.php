@extends('laporan.layouts.main-cetak')
@section('content')
    <table class="table-item">
        <tr>
            <td ><strong>Laporan Buku Terfavorite yang Sering dipinjam</strong></td>
        </tr>
    </table>
    <table class="table-item" border=".1">
        <thead>
            <tr style="background: dodgerblue">
                <th>No</th>
                <th>Kategori Buku</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Dibaca</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategori_ as $kategori)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kategori->nama }}</td>
                    <td>
                        @foreach ($kategori->buku_->where('dibaca', '>', 7) as $buku)
                                {{ $buku->judul }} <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($kategori->buku_->where('dibaca', '>', 7) as $buku)
                        {{ $buku->penulis }} <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($kategori->buku_->where('dibaca', '>', 7) as $buku)
                        {{ $buku->penerbit }} <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($kategori->buku_->where('dibaca', '>', 7) as $buku)
                        {{ $buku->dibaca }} <br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection