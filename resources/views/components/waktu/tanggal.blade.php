@php
    $bulan = ['Januari', 'Februarai', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Novemeber', 'Desember'];
@endphp
<div class="d-flex">
    <select class="custom-select form-control ml-1 @error($name[0]) is-invalid @enderror" name="{{ $name[1] }}">
        <option value="">Hari</option>
        @for ($i = 1; $i <= 31; $i++)
        <option {{ old($name[1],($tanggal['hari'] ?? '')) == $i ? 'selected' : '' }} value="{{ $i }}">{{ str_pad($i, 2, 0, STR_PAD_LEFT) }}</option>            
        @endfor
    </select>
    <select class="custom-select form-control ml-1 @error($name[0]) is-invalid @enderror" name="{{ $name[2] }}">
        <option value="">Bulan</option>
        @foreach ($bulan as $key => $value)
            <option {{ old($name[2], ($tanggal['bulan'] ?? '')) == $key+1 ? 'selected' : '' }} value="{{ $key+1}}">{{ $value }}</option>
        @endforeach
    </select>
    <select class="custom-select form-control ml-1 @error($name[0]) is-invalid @enderror" name="{{ $name[3] }}">
        <option value="">Tahun</option>
        @for ($i = $tahunAwal; $i <= $tahunAkhir; $i++)
            <option {{ old($name[3], ($tanggal['tahun'] ?? '')) == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
</div>
@error($name[0])
    <small class="text-danger">{{ $message }}</small>
@enderror