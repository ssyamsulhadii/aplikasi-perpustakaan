<div>
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
                                <td><div style="width: 6em">{{ $pengembalian->peminjaman->anggota->user->nama }}</div></td>
                                <td><div style="width: 8em">{{ $pengembalian->peminjaman->buku->judul }}</div></td>
                                <td><div style="width: 5em">{{ $pengembalian->tanggal1 }}</div></td>
                                <td><div style="width: 5em">{{ $pengembalian->tanggal2 }}</div></td>
                                <td><div style="width: 5em">{{ $pengembalian->rupiah_denda}}</div></td>
                                <td>
                                    @if ($pengembalian->fungsi)
                                        <span wire:click.prevent="pesan" role="button" class="badge bg-primary p-2">
                                            <i class="bi bi-check2-all" style="font-size: 20px"></i>
                                        </span>
                                    @else
                                        <span wire:click.prevent="konfirmasi('{{ $pengembalian->id }}')" role="button" class="badge bg-primary p-2">
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
            {{ $pengembalian_->onEachSide(1)->links() }}
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
                        @if ($tanggal_kembali_over)
                            <div class="form-group">
                                <input wire:model.defer="state.denda" placeholder="Denda Rp." class="form-control @error('state.denda') is-invalid @enderror">
                            </div>
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <label for="">Tanggal kembali</label>
                                <div class="col-4">
                                    <select class="form-select" id="basicSelect" wire:model.defer="stateTanggal.tanggal_kembali">
                                        @for ($i = 1; $i < 31; $i++)
                                            <option >{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class="form-select" id="basicSelect" wire:model.defer="stateTanggal.bulan_kembali">
                                        @foreach ($bulan as $value)
                                            <option value="{{ $loop->iteration }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class="form-select" id="basicSelect" wire:model.defer="stateTanggal.tahun_kembali">
                                        @for ($i = 2021; $i < 2030; $i++)
                                            <option>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        @if ($tanggal_kembali_over)
                            <div class="form-group">
                                <div class="row">
                                    <label for="">Tanggal kembali Over</label>
                                    <div class="col-4">
                                        <select class="form-select" id="basicSelect" wire:model.defer="stateTanggal.tanggal_kembali_over">
                                            @for ($i = 1; $i < 31; $i++)
                                                <option >{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select class="form-select" id="basicSelect" wire:model.defer="stateTanggal.bulan_kembali_over">
                                            @foreach ($bulan as $value)
                                                <option value="{{ $loop->iteration }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select class="form-select" id="basicSelect" wire:model.defer="stateTanggal.tahun_kembali_over">
                                            @for ($i = 2021; $i < 2030; $i++)
                                                <option>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
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
