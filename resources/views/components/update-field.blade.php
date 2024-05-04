<div>
    <label for="{{$input}}" class="form-label text-md-end fw-bold">
        {{$text }}
    </label>
    <input id="{{$input}}" name="{{$input}}" type="{{$type}}" value="{{ old($input,$value)}}"
        class=" mb-3 form-control @error($input) is-invalid @enderror" autocomplete="{{$input}}" />
    @error($input)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>