<div>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>List Buku</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Buku</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="form-group position-relative has-icon-right">
                    <input wire:model="cari" type="text" class="form-control" placeholder="Ketikkan judul buku">
                    <div class="form-control-icon">
                        <i class="bi bi-search"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                @forelse ($buku_ as $buku)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <img class="img-fluid w-100 p-3" src="{{ $buku->sampul_url }}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">{{ $buku->judul }}</h4>
                                <span class="d-block">Judul : <strong>{{ $buku->judul }}</strong></span>
                                <span class="d-block">Berada di: <strong>{{ $buku->kategori->rak->nama }}, kategori {{ $buku->kategori->nama }}</strong></span>
                                <span class="d-block">Telah dibaca : <strong>{{ $buku->dibaca }}</strong></span>
                                <span class="d-block">Penulis : <strong>{{ $buku->penulis }}</strong></span>
                                <span class="d-block">Penerbit : <strong>{{ $buku->penerbit }}</strong></span>
                                <p class="card-text"> Tetang buku :Gummies bonbon apple pie fruitcake icing biscuit apple pie jelly-o sweet roll. Toffee
                                    sugar plum sugar plum jelly-o jujubes bonbon dessert carrot cake.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center">
                    <h3>Buku Tidak Ditemukan . . . !</h3>
                    <img width="450px" src="{{ asset('assets/images/not-found/undraw_taken_re_yn20.svg') }}">
                </div>
                @endforelse
        </div>
        <div class="row mb">
            <div class="d-flex justify-content-center">
                {{ $buku_->onEachSide(2)->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </section>
</div>
