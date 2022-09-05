<div>
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="form-group">
                        <h4 class="card-title">Rak Buku</h4>
                        <span class="text-subtitle text-muted d-block">Rak buku diibaratkan sebuah lemari yang menampung banyak kategori buku.</span>
                        <span class="text-subtitle text-muted d-block">Jika ingin menambahkan rak buku klik tombol <strong>tambah</strong>  dibawah.</span>
                        <span class="text-subtitle text-muted d-block">Jika ingin melakukan perubahan atau penghapusan rak buku klik <strong>icon</strong> pada daftar rak buku.</span>
                        <button wire:click.prevent="create" class="btn btn-outline-success mt-3">
                            Tambah
                        </button>
                        <div class="btn-group dropdown mt-3">
                            <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                <span class="sr-only">Cetak Berdasarkan</span>
                            </button>
                            <div class="dropdown-menu">
                                @foreach ($rak_ as $rak)
                                    <a target="_blank" class="dropdown-item" href="{{ route('cetak.kategori') . '?rak=' . $rak->id }}">{{ $rak->nama }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            @foreach ($rak_ as $rak)
                <div class="col-12 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-start align-items-center">
                                <div wire:click.prevent="editWithDelete('{{ $rak->id }}')" role="button" style="height: 50px; width: 50px; margin-right: 10px; background: #6f42c1;" class="rounded">
                                    <i style="font-size: 30px" class="bi bi-grid-1x2-fill bi-middle text-white"></i>
                                </div>
                                <div>
                                    <strong>{{ $rak->nama }}</strong>
                                    <span class="d-block">{{ $rak->kategori_->count() }} Kategori Buku</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <div wire:ignore.self class="modal fade text-left" id="formModal" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Form Rak</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form wire:submit.prevent="{{ $rakItem ? 'update' : 'store' }}">
                    <div class="modal-body">
                        <x-form.basic.input-group type="text" name="nama" label="Nama Rak Buku"/>
                    </div>
                    <div class="modal-footer">
                        <button data-bs-dismiss="modal"  class="btn btn-light-secondary">
                            <i class="bi bi-arrow-left-square d-block d-sm-none" style="margin-bottom: 5px"></i>
                            <span class="d-none d-sm-block">Tidak Jadi</span>
                        </button>
                        @if ($rakItem)
                            <a wire:click.prevent="distroy" class="btn btn-danger">
                                <i class="bi bi-x-square d-block d-sm-none" style="margin-bottom: 5px"></i>
                                <span class="d-none d-sm-block">Hapus</span>
                            </a>
                        @endif
                        <button  class="btn btn-primary ml-1">
                            <i class="bi bi-save2 d-block d-sm-none" style="margin-bottom: 5px"></i>
                            <span class="d-none d-sm-block">
                                @if ($rakItem)
                                    Simpan perubahan
                                @else
                                    Simpan
                                @endif
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('show-form-modal', event => {
            new bootstrap.Modal(document.getElementById('formModal')).show();
        });
        Livewire.on('hideModal', () => {
            var myModalEl = document.getElementById('formModal')
            var modal = bootstrap.Modal.getInstance(myModalEl)
            modal.hide();
        });
    </script>
@endpush
