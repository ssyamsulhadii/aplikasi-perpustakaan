<input name="{{ $name }}" {{ $attributes }} value="{{ old($name) }}" class="form-control form-control-lg @error($name) is-invalid @enderror">
<div class="form-control-icon">
    <i class="bi {{ $icon }}"></i>
</div>
