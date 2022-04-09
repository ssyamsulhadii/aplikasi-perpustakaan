<div class="form-group">
    <label>{{ $label }}</label>
    <input {{ $attributes }} wire:model.defer="{{ $name }}" class="form-control @error($name) is-invalid @enderror">
    <x-pesan.error-message :error="$name" />
</div>
