<div class="form-group">
    <label class="mb-2" for="{{ $name }}">{{ __($title) }} @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="input-group">
        <input type="{{ $type }}" id="{{ $name }}" class="form-control" value="{{ old($name) ?? $value }}"
            name="{{ $name }}" placeholder="{{ $placeholder }}">
    </div>
    @error($name)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
