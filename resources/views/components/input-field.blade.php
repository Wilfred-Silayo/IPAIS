<div class="mb-3 row">
    <label for="{{$input}}" class="form-label">{{$text}}</label>

    <div class="input-group">
        <span class="input-group-text"><i class="{{$prefixIcon}}"></i></span>
        <input id="{{$input}}" type="{{$type}}" class="form-control @error($input) is-invalid @enderror"
            name="{{$input}}" placeholder="{{$placeholder}}" value="{{old($input)}}">
        @if($type==='password')
        <div class="input-group-append">
            <button type="button" class="btn btn-light rounded-left rounded-right btn-eye" id="togglePassword"><i
                    class="fa fa-eye"></i></button>
        </div>
        @endif
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>