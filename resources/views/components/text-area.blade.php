<div class="mb-3 row">
    <label for="{{ $input }}" class="form-label">{{ $text }}</label>
    <div class="input-group">
        <textarea id="{{ $input }}" name="{{ $input }}" class="form-control @error($input) is-invalid @enderror"
            name="{{ $input }}" placeholder="{{ $placeholder }}">{{ old($input) }}</textarea>
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>