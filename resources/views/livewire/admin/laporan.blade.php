<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="text-center">
                            <h4 class="card-title">Data Laporan PERPUSTAKAAN SMAN 1 KELUMPANG HULU</h4>
                            <h5>Periode : {{ $tahun }}</h5>
                            <select wire:change="pilihPeriode($event.target.value)" class="form-select" id="basicSelect">
                                <option value="">Pilih Tahun</option>                                
                                @for ($i = 2021; $i < 2030; $i++)
                                    <option value="{{ $i}}">{{ $i }}</option>                                
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($tahun)
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
                                        <a target="_blank" class="dropdown-item" href="{{ route('cetak.pendaftaran-pengguna', ['tahun' => $tahun, 'opsi' => 3]) }}"> 3 bulan diawal</a>
                                        <a target="_blank" class="dropdown-item" href="{{ route('cetak.pendaftaran-pengguna', ['tahun' => $tahun, 'opsi' => 6]) }}"> 6 bulan diawal</a>
                                        <a target="_blank" class="dropdown-item" href="{{ route('cetak.pendaftaran-pengguna', ['tahun' => $tahun, 'opsi' => 12])}}"> 1 Tahun terkahir</a>
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
                                <a target="_blank" href="{{ route('cetak.anggota-peminjaman', ['tahun' => $tahun]) }}" class="btn btn-outline-dark mt-3">Cetak</a>
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
                                <a target="_blank" href="{{ route('cetak.anggota-pengembalian-terlambat',['tahun' => $tahun]) }}" class="btn btn-outline-dark mt-3">Cetak</a>
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
        @endif
    </div>
</div>
