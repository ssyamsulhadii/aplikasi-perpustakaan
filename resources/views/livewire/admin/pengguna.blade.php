<div class="col-lg-8 col-md-10 col-12">
    <div class="card">
        <div class="card-header pb-2 pt-3">
            <h4 class="card-title">Daftar Pengguna Aplikasi</h4>
        </div>
        <div class="card-content ">
            <div class="card-body pt-0 mt-0">
                <div class="table-responsive">
                    <table class="table table-md ">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Nama</th>
                                <th>Level</th>
                                <th>Bergabung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengguna_ as $pengguna)
                                <tr>
                                    <td>
                                        <div style="width: 10em">
                                            {{ $pengguna->email }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width: 7em">
                                            {{ $pengguna->nama }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width: 10em">
                                            <fieldset class="form-group">
                                                <select wire:change="pilihLevel({{ $pengguna }}, $event.target.value)" class="form-select" id="basicSelect">
                                                    @foreach ($level_ as $level)
                                                        <option value="{{ $level->id}}" {{ $level->id  == $pengguna->level_id ? 'selected' : '' }}>{{ $level->nama }}</option>
                                                    @endforeach
                                            </select>
                                        </fieldset>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width: 7em">
                                            {{ $pengguna->created_at->isoFormat('DD MMMM YYYY') }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer pb-0 pt-3">
                {{ $pengguna_->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
