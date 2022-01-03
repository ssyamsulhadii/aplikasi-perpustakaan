<div class="col-md-3 mb-lg-0 mb-md-0 mb-2">
    <label>{{ $label }}</label>
</div>
<div class="col-md-9 form-group">
    <input  {{ $attributes }} class="form-control @error($name) is-invalid @enderror" placeholder="{{ $label }}">
    <x-pesan.error-message :error="$name" />
</div>
