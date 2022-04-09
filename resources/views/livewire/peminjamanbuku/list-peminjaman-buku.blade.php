<div>
    <div class="card">
        <div class="card-body">
                <form action="{{ route('cetak.peminjaman') }}" method="GET">
                    @csrf
                <div class="row d-flex align-items-center">
                    <div class="col-lg-2 col-md-4 col-12 mb-lg-0 mb-sm-0 mb-2">
                        <button type="submit" class="btn btn-outline-dark">Cetak</button>
                    </div>
                    <div class="col-lg-10 col-md-8 col-12">
                        <div class="row">
                            <div class="form-group">
                                <label>Tanggal Awal</label>
                                <x-form.waktu.tanggal tahunAwal="2021" tahunAkhir="2030" :name="[
                                    'value' => 'tanggal_awal',
                                    'hari' => 'hari_awal',
                                    'bulan' => 'bulan_awal',
                                    'tahun' => 'tahun_awal',
                                    ]"/>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <x-form.waktu.tanggal tahunAwal="2021" tahunAkhir="2030" :name="[
                                    'value' => 'tanggal_akhir',
                                    'hari' => 'hari_akhir',
                                    'bulan' => 'bulan_akhir',
                                    'tahun' => 'tahun_akhir',
                                    ]"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header pb-2 pt-3 d-flex justify-content-between">
            <h4 class="card-title">Daftar Peminjaman Buku</h4>
            <div class="ml-auto">
                <span wire:click.prevent="create" role="button" class="badge bg-primary p-2">
                    <i class="bi bi-plus-circle" style="font-size: 20px"></i>
                </span>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-lg">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Judul buku</th>
                            <th class="text-center">Tanggal Pinjam</th>
                            <th class="text-center">Tanggal Kembali</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">status</th>
                            <th class="text-center">opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman_ as $peminjaman)
                            <tr>
                                <td><div style="width: 4em">{{ $peminjaman->kode }}</div></td>
                                <td><div style="width: 8em">{{ $peminjaman->user->nama }}</div></td>
                                <td><div style="width: 8em">{{ $peminjaman->buku->judul }}</div></td>
                                <td><div style="width: 5em">{{ $peminjaman->tanggal_pinjam->isoFormat('DD-MM-YYYY') }}</div></td>
                                <td><div style="width: 5em">{{ $peminjaman->tanggal_kembali->isoFormat('DD-MM-YYYY') }}</div></td>
                                <td class="text-center">{{ $peminjaman->jumlah_pinjam }}</td>
                                <td class="text-center">
                                    @if ($peminjaman->status)
                                        <span><i style="font-size: 25px" class="bi bi-check-all"></i></span>
                                    @else
                                        <span><i style="font-size: 25px" class="bi bi-check"></i></span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div style="width: 6em;">
                                        @if ($peminjaman->status)
                                            <a href="{{ route('pengembalian-buku') }}">
                                                <span class="badge p-2" style="background: peru">
                                                    <i class="bi bi-signpost" style="font-size: 15px"></i>
                                                </span>
                                            </a>
                                        @else
                                            <span wire:click.prevent="distroy('{{ $peminjaman->id }}')" role="button" class="badge bg-danger p-2">
                                                <i class="bi bi-trash-fill" style="font-size: 15px"></i>
                                            </span>
                                            <span wire:click.prevent="edit('{{ $peminjaman->id }}')" role="button" class="badge bg-success p-2">
                                                <i class="bi bi-pencil-square" style="font-size: 15px"></i>
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $peminjaman_->onEachSide(2)->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    <div wire:ignore.self class="modal fade text-left" id="formModal" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Form Peminjaman Buku</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form wire:submit.prevent="{{ $peminjamanItem ? 'update' : 'store' }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Kode Peminjaman</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text @error('state.kode') border-danger @enderror">
                                    PMJ
                                </span>
                                <input wire:model.defer="state.kode" type="text" placeholder="000" class="form-control @error('state.kode') is-invalid @enderror">
                                <x-pesan.error-message error="state.kode" />
                            </div>
                        </div>
                        <x-form.basic.selection-group name="state.user_id" label="Pilih Anggota" :result="$anggota_"/>
                        <x-form.basic.selection-group name="state.buku_id" label="Pilih Buku" :result="$buku_"/>

                        {{-- tanggal pinjam --}}
                        <div class="form-group">
                            <label >Tanggal Peminjaman</label>
                            <x-form.waktu.tanggal tahunAwal="2021" tahunAkhir="2030" :name="[
                                'value' => 'state.tanggal_pinjam',
                                'hari' => 'tanggalPinjam.hari',
                                'bulan' => 'tanggalPinjam.bulan',
                                'tahun' => 'tanggalPinjam.tahun',
                                ]"/>
                        </div>
                        <div class="form-group">
                            <label >Tanggal Pengembalian</label>
                            <x-form.waktu.tanggal tahunAwal="2021" tahunAkhir="2030" :name="[
                                'value' => 'state.tanggal_kembali',
                                'hari' => 'tanggalKembali.hari',
                                'bulan' => 'tanggalKembali.bulan',
                                'tahun' => 'tanggalKembali.tahun',
                                ]"/>
                        </div>
                        <div class="col-6">
                            <x-form.basic.input-group type="text" type="text" name="state.jumlah_pinjam" label="Jumlah Pinjam"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-bs-dismiss="modal"  class="btn btn-light-secondary">
                            <i class="bi bi-arrow-left-square d-block d-sm-none" style="margin-bottom: 5px"></i>
                            <span class="d-none d-sm-block">Tidak Jadi</span>
                        </button>
                        <button  class="btn btn-primary ml-1">
                            <i class="bi bi-save2 d-block d-sm-none" style="margin-bottom: 5px"></i>
                            <span class="d-none d-sm-block">
                                @if ($peminjamanItem)
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
            var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instance
            modal.hide();
        });
    </script>
@endpush
