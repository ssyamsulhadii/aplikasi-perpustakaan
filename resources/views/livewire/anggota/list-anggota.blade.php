<div>
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-group">
                            <h4 class="card-title">Anngota</h4>
                            <span class="text-subtitle text-muted d-block">Anggota adalah daftar pengguna yang telah melakukan pendaftaran disitus ini.</span>
                            <a target="_blank" href="{{ route('cetak.anggota') }}" class="btn btn-outline-dark mt-5">Cetak</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($anggota_ as $anggota)
        <div class="col-12 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-start align-items-center">
                        <div  style="height: 50px; width: 50px; margin-right: 10px;" class="rounded bg-primary">
                            <i style="font-size: 30px" class="bi bi-person-badge bi-middle text-warning"></i>
                        </div>
                        <div>
                            <strong>{{ $anggota->nama }}</strong>
                            <span class="text-muted d-block"><i class="bi bi-calendar-plus"></i>&emsp;{{ $anggota->created_at->isoFormat('DD MMMM YYYY') }}</span>
                            <span class="text-muted d-block"><i class="bi bi-telephone"></i>&emsp;{{ $anggota->telpon }}</span>
                            <span class="text-muted d-block"><i class="bi bi-geo"></i>&emsp;{{ $anggota->alamat }}</span>
                            <a class="text-muted d-block" href="{{ route('cetak.peminjaman-anggota', ['anggota'=>$anggota->id]) }}"><i class="bi bi-printer"></i>&emsp;cetak</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
