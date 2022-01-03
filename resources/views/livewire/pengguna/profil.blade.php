<div class="row">
    <div class="col-lg-3 col-md-5 col-12">
        <div class="card">
            <div class="card-body pt-2 pb-4 px-3">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-xl">
                        <img src="{{ auth()->user()->profil_gambar }}" alt="Face 1">
                    </div>
                    <div class="ms-2 name">
                        <h5 class="font-bold">{{ auth()->user()->nama }}</h5>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-muted">{{ auth()->user()->email }}</span>
                </div>
                <div class="bg-light-primary rounded mt-2 p-1">
                    <span class="text-muted d-block"><i class="bi bi-calendar-plus"></i>&emsp;{{ auth()->user()->created_at->isoFormat('DD MMMM YYYY') }}</span>
                    <span class="text-muted d-block"><i class="bi bi-telephone"></i>&emsp;{{ auth()->user()->telpon }}</span>
                    <span class="text-muted d-block"><i class="bi bi-geo"></i>&emsp;{{ auth()->user()->alamat }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-7 col-12">
        <div class="card">
            <div class="card-content pt-0">
                <div class="card-body">
                    <h4 class="card-title mb-4">Profil Saya</h4>
                    <form class="form form-horizontal" wire:submit.prevent="updateProfil" autocomplete="off">
                        <div class="row">
                            <x-form.profil-elemen.input-group type="text" wire:model.defer="state.nama" name="nama" label="Nama Lengkap"/>
                            <x-form.profil-elemen.input-group type="text" wire:model.defer="state.email" name="email" label="Alamat Email"/>
                            <x-form.profil-elemen.input-group type="text" wire:model.defer="state.telpon" name="telpon" label="No Telpon"/>
                            <x-form.profil-elemen.input-group type="text" wire:model.defer="state.alamat" name="telpon" label="Alamat"/>
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
