<div class="form-group">
    <select {{ $attributes }} wire:model.defer="{{ $name }}" class="form-select @error($name) is-invalid @enderror">
        <option value="">{{ $label }}</option>
        @foreach ($result as $value)
            <option value="{{ $value->id }}">{{ $value->nama ?? $value->judul }}</option>
            {{-- <option value="{{ $value->id }}">ID{{ str_pad($value->id, 3, '***', STR_PAD_LEFT) }}&ensp; {{ $value->nama }}</option> --}}
        @endforeach
    </select>
    <x-pesan.error-message :error="$name" />
</div>