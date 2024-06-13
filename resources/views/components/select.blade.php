<div class="form-group">
    <label class="mb-2">{{ __($title) }} @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <select class="form-control" name="{{ $name }}" id="{{ $id }}">
        <option selected disabled>{{ __($placeholder) }}</option>
        {{ $slot }}
    </select>
    @error($name)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
