<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-group text-center">
                            <h4 class="card-title">Data Laporan Perpustakaan Umum Dinas Kearsipan dan Perpustakaan</h4>
                            <h5>Periode : 2021</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-group">
                            <h4 class="card-title">Laporan Pengguna</h4>
                            <span class="text-subtitle text-muted d-block">Penguna yang melakukan pendaftaran.</span>
                            <div class="dropdown mt-4">
                                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Pilih waktu
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7" style="margin: 0px;">
                                    <a target="_blank" class="dropdown-item" href="{{ route('cetak.pendaftaran-pengguna')."?opsi=3" }}">3 bulan awal 2021</a>
                                    <a target="_blank" class="dropdown-item" href="{{ route('cetak.pendaftaran-pengguna') ."?opsi=6" }}">6 bulan awal 2021</a>
                                    <a target="_blank" class="dropdown-item" href="{{ route('cetak.pendaftaran-pengguna') ."?opsi=12"}}">1 Tahun terkahir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-group">
                            <h4 class="card-title">Laporan Anggota</h4>
                            <span class="text-subtitle text-muted d-block">Anggota yang sering melakukan peminjaman buku.</span>
                            <a target="_blank" href="{{ route('cetak.anggota-peminjaman') }}" class="btn btn-outline-dark mt-3">Cetak</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-group">
                            <h4 class="card-title">Laporan Anggota</h4>
                            <span class="text-subtitle text-muted d-block">Anggota yang sering melakukan keterlambatan pengembalian buku.</span>
                            <a target="_blank" href="{{ route('cetak.anggota-pengembalian-terlambat') }}" class="btn btn-outline-dark mt-3">Cetak</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-group">
                            <h4 class="card-title">Laporan Buku</h4>
                            <span class="text-subtitle text-muted d-block">Buku terfavorite yang sering dipinjam.</span>
                            <a target="_blank" href="{{ route('cetak.buku-favorite') }}" class="btn btn-outline-dark mt-3">Cetak</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
