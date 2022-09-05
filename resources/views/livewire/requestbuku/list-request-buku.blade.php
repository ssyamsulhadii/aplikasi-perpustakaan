<div>
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-2 pt-3 d-flex justify-content-between">
                <h4 class="card-title">Daftar Request Buku</h4>
            </div>
            <div class="card-content ">
                <div class="card-body pt-0 mt-0">
                    <div class="table-responsive">
                        <table class="table table-md ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Sampul</th>
                                    <th>Judul Buku</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th class="text-center">opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requestBuku_ as $buku)
                                    <tr>
                                        <td>{{ $requestBuku_->firstItem() + $loop->index }}</td>
                                        <td>
                                            <div style="width: 8em">{{ $buku->user->nama }}</div>
                                        </td>
                                        <td>
                                            <img class="img-thumbnail" width="80px" src="{{ $buku->sampul_url }}" alt="rawpixel.com">
                                        </td>
                                        <td>
                                            <div style="width: 10em">{{ $buku->judul }}
                                                <span class="badge bg-secondary">{{ $buku->jumlah }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="width: 7em">{{ $buku->penulis }}</div>
                                        </td>
                                        <td>
                                            <div style="width: 7em">{{ $buku->penerbit }}</div>
                                        </td>
                                        <td>
                                            <div style="width: 10em">{{ $buku->keterangan }}</div>
                                        </td>
                                        <td>
                                            <div style="width: 4em">{{ $buku->status }}</div>
                                        </td>
                                        <td class="text-center">
                                            <div style="width: 8em">
                                                <span wire:click="confirmation('{{ $buku->id }}')" role="button" class="badge bg-primary p-2">Konfirmasi</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer pb-0 pt-3">
                    {{ $requestBuku_->onEachSide(2)->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
