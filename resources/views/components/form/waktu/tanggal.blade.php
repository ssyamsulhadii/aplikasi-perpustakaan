@php
    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Novemeber', 'Desember'];
@endphp
<div class="row">
    <div class="col-4">
        <select class="custom-select form-select @error($name['value']) is-invalid @enderror" wire:model.defer={{ $name['hari'] }} name="{{ $name['hari'] }}">
            <option value="">Hari</option>
            @for ($i = 1; $i <= 31; $i++)
                <option value="{{ $i }}">{{ str_pad($i, 2, 0, STR_PAD_LEFT) }}</option>            
            @endfor
        </select>
    </div>
    <div class="col-4 px-1">
        <select class="custom-select form-select @error($name['value']) is-invalid @enderror" wire:model.defer={{ $name['bulan'] }} name="{{ $name['bulan'] }}">
            <option value="">Bulan</option>
            @foreach ($bulan as $key => $value)
            <option value="{{ $key+1}}">{{ $value }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4">
        <select class="custom-select form-select @error($name['value']) is-invalid @enderror" wire:model.defer={{ $name['tahun'] }} name="{{ $name['tahun'] }}">
            <option value="">Tahun</option>
            @for ($i = $tahunAwal; $i <= $tahunAkhir; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    @error($name['value'])
        <span style="font-size: 14px" class="text-danger" role="alert">{{ $message }}</span>
    @enderror
</div>