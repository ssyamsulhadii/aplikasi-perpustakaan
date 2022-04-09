<div>
    <div class="card">
        <div class="card-body">
                <form action="{{ route('cetak.pengembalian') }}" method="GET">
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
            <h4 class="card-title">Daftar Pengembalian Buku</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-lg">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Judul</th>
                            <th>Tanggal Kembali</th>
                            <th>Tanggal Over</th>
                            <th>Denda</th>
                            <th>Konfirmasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengembalian_ as $pengembalian)
                            <tr>
                                <td><div style="width: 4em">{{ $pengembalian->kode }}</div></td>
                                <td><div style="width: 6em">{{ $pengembalian->peminjaman->user->nama }}</div></td>
                                <td><div style="width: 8em">{{ $pengembalian->peminjaman->buku->judul }}</div></td>
                                <td><div style="width: 5em">{{ $pengembalian->tanggal1 }}</div></td>
                                <td><div style="width: 5em">{{ $pengembalian->tanggal2 }}</div></td>
                                <td><div style="width: 5em">{{ $pengembalian->rupiah_denda}}</div></td>
                                <td>
                                    @if ($pengembalian->fungsi)
                                        <span title="Konfirmasi" wire:click.prevent="pesan" role="button" class="badge bg-primary p-2">
                                            <i class="bi bi-check2-all" style="font-size: 20px"></i>
                                        </span>
                                        <span  title="Pulihkan" wire:click.prevent="pulihkan('{{ $pengembalian->id }}')" role="button" class="badge bg-warning p-2">
                                            <i class="bi bi-shift" style="font-size: 20px"></i>
                                        </span>
                                    @else
                                        <span title="Konfirmasi" wire:click.prevent="konfirmasi('{{ $pengembalian->id }}')" role="button" class="badge bg-primary p-2">
                                            <i class="bi bi-check2-all" style="font-size: 20px"></i>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $pengembalian_->onEachSide(2)->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    <div wire:ignore.self class="modal fade text-left" id="formModal" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Form konfirmasi pengembalian buku</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form wire:submit.prevent="prosesKonfirmasi">
                    <div class="modal-body">
                        <div class="form-group d-flex justify-content-center">
                            <div class="col-6">
                                <input disabled placeholder="Kode Pengembalian : {{ $pengembalian->kode }}" class="form-control">
                            </div>
                        </div>
                        @if ($tanggal)
                            <x-form.basic.input-group type="text" type="text" name="state.denda" label="Denda Rp."/>
                        @endif
                        <div class="form-group">
                            <label >Tanggal Dikembalikan</label>
                            <x-form.waktu.tanggal tahunAwal="2021" tahunAkhir="2030" :name="[
                                'value' => 'state.tanggal_kembali',
                                'hari' => 'tanggalKembali.hari',
                                'bulan' => 'tanggalKembali.bulan',
                                'tahun' => 'tanggalKembali.tahun',
                                ]"/>
                        </div>
                        
                        @if ($tanggal)
                            <div class="form-group">
                                <label >Tanggal Kembali Over</label>
                                <x-form.waktu.tanggal tahunAwal="2021" tahunAkhir="2030" :name="[
                                    'value' => 'state.tanggal_kembali_over',
                                    'hari' => 'tanggalKembaliOver.hari',
                                    'bulan' => 'tanggalKembaliOver.bulan',
                                    'tahun' => 'tanggalKembaliOver.tahun',
                                    ]"/>
                            </div>
                        @endif

                    </div>
                    <div class="modal-footer">
                        <button data-bs-dismiss="modal"  class="btn btn-light-secondary">
                            <i class="bi bi-arrow-left-square d-block d-sm-none" style="margin-bottom: 5px"></i>
                            <span class="d-none d-sm-block">Tidak Jadi</span>
                        </button>
                        <button  class="btn btn-primary ml-1">
                            <i class="bi bi-save2 d-block d-sm-none" style="margin-bottom: 5px"></i>
                            <span class="d-none d-sm-block">
                                Konfirmasi
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
