<div class="col-lg-9 col-md-7 col-12">
    <div class="card">
        <div class="card-content pt-0">
            <div class="card-body">
                <h4 class="card-title mb-4">Request Buku</h4>
                <form class="form form-horizontal" wire:submit.prevent="store" autocomplete="off">
                    <div class="row">
                        <div class="text-center" x-data>
                            <span class="d-block pb-1">Default sampul buku</span>
                            <input class="d-none" type="file" x-ref="sampul" wire:model='sampul'>

                            <img role="button" x-on:click="$refs.sampul.click()" width="150px" class="img-thumbnail"
                                @if ($bukuItem)
                                        @if ($sampul)
                                            src="{{ $sampul->temporaryUrl() }}"
                                        @endif
                                @else
                                    src="{{ $sampul ? $sampul->temporaryUrl() : asset('storage/sampul/default.jpg') }}"
                                @endif
                            >

                            <span class="d-block pt-1">Klik gambar untuk mengganti sampul buku <span class="text-danger">minimal 5024kb</span> </span>
                        </div>
                        <x-form.basic.input-group  type="text" name="state.judul" label="Judul"/>
                        <x-form.basic.input-group  type="text" name="state.penulis" label="Penulis"/>
                        <x-form.basic.input-group  type="text" name="state.penerbit" label="Penebrit"/>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea  rows="5" class="form-control @error('state.keterangan') is-invalid @enderror" wire:model.defer="state.keterangan"></textarea>
                            <x-pesan.error-message error="state.keterangan"/>
                        </div>
                        
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Kirim</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
<script src="{{ asset('assets/js/alpinejs/alpine.min.js') }}"></script>
@endpush
