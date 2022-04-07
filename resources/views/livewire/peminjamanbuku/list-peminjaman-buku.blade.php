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
                                <div class="row">
                                    <div class="col-4">
                                        <select name="tanggal_from" class="form-select" id="basicSelect">
                                            @for ($i = 1; $i < 31; $i++)
                                                <option>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select name="bulan_from" class="form-select" id="basicSelect">
                                            @foreach ($bulan as $value)
                                                <option value="{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}" {{ $loop->iteration == $waktu_sekarang->isoFormat("MM") ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select name="tahun_from" class="form-select" id="basicSelect">
                                            @for ($i = 2021; $i < 2030; $i++)
                                                <option {{ $i == $waktu_sekarang->isoFormat("YYYY") ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <select name="tanggal_to" class="form-select" id="basicSelect">
                                            @for ($i = 1; $i < 31; $i++)
                                                <option {{ $i == $waktu_sekarang->isoFormat("DD") ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select name="bulan_to" class="form-select" id="basicSelect">
                                            @foreach ($bulan as $value)
                                                <option value="{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}" {{ $loop->iteration == $waktu_sekarang->isoFormat("MM") ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select name="tahun_to" class="form-select" id="basicSelect">
                                            @for ($i = 2021; $i < 2030; $i++)
                                                <option {{ $i == $waktu_sekarang->isoFormat("YYYY") ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
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
                        <label for="">Kode Peminjaman</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                PMJ
                            </span>
                            <input wire:model.defer="state.kode" type="text" placeholder="000" class="form-control @error('state.kode') is-invalid @enderror">
                        </div>
                        <fieldset class="form-group">
                            <select wire:model.defer="state.anggota_id" class="form-select @error('state.anggota_id') is-invalid @enderror"" id="basicSelect">
                                <option>Pilih Anggota</option>
                                @foreach ($anggota_ as $anggota)
                                    <option value="{{ $anggota->id }}">
                                        ID{{ str_pad($anggota->id, 3, '***', STR_PAD_LEFT) }}&ensp;{{ $anggota->nama }}</option>
                                @endforeach
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
                            <select wire:model.defer="state.buku_id" class="form-select @error('state.buku_id') is-invalid @enderror" id="basicSelect">
                                <option>Pilih Buku</option>
                                @foreach ($buku_ as $buku)
                                    <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                                @endforeach
                            </select>
                        </fieldset>


                        {{-- tanggal pinjam --}}
                        <div class="form-group">
                            <div class="row">
                                <label for="">Tanggal pinjam</label>
                                <div class="col-4">
                                    <select class="form-select" id="basicSelect" wire:model.defer="stateTanggal.tanggal_pinjam">
                                        @for ($i = 1; $i < 31; $i++)
                                            <option >{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class="form-select" id="basicSelect" wire:model.defer="stateTanggal.bulan_pinjam">
                                        @foreach ($bulan as $value)
                                            <option value="{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class="form-select" id="basicSelect" wire:model.defer="stateTanggal.tahun_pinjam">
                                        @for ($i = 2021; $i < 2030; $i++)
                                            <option>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- tanggal kembali --}}
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
                                            <option value="{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}">{{ $value }}</option>
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



                        <div class="form-group">
                            <div class="col-4">
                                <input wire:model.defer="state.jumlah_pinjam" type="text" placeholder="Jumlah Pinjam" class="form-control @error('state.jumlah_pinjam') is-invalid @enderror">
                            </div>
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
