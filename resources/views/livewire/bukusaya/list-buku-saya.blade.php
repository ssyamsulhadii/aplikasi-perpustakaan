<div class="col-lg-8 col-md-10 col-12">
    <div class="card">
        <div class="card-header pb-2 pt-3">
            <h4 class="card-title">Daftar Buku Saya</h4>
        </div>
        <div class="card-content ">
            <div class="card-body pt-0 mt-0">
                <div class="table-responsive">
                    <table class="table table-md ">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Judul</th>
                                <th>Jumlah</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($bukusaya_ !== null)
                                @foreach ($bukusaya_ as $bukusaya)
                                <tr>
                                    <td>{{ $bukusaya->kode }}</td>
                                    <td>{{ $bukusaya->buku->judul }}</td>
                                    <td>{{ $bukusaya->jumlah_pinjam }}</td>
                                    <td>{{ $bukusaya->tanggal_pinjam->isoFormat('DD-MM-YYYY') }}</td>
                                    <td>{{ $bukusaya->tanggal_kembali->isoFormat('DD-MM-YYYY') }}</td>
                                    <td>
                                        @if ($bukusaya->status)
                                            <span><i style="font-size: 25px" class="bi bi-check-all"></i></span>
                                        @else
                                            <span><i style="font-size: 25px" class="bi bi-check"></i></span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <img width="200px" src="{{ asset('assets/images/not-found/undraw_taken_re_yn20.svg') }}">
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
