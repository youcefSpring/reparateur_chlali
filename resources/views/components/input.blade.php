<div class="form-group">
    <label class="mb-2" for="{{ $name }}">{{ __($title) }} @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <input type="{{ $type }}" id="{{ $name }}" class="form-control" placeholder="{{ $placeholder }}"
        value="{{ old($name) ?? $value }}" name="{{ $name }}" @if ($readonly == true) readonly @endif>
    @error($name)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
