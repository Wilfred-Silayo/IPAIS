<div class="row mb-3">
    <div class="col-md-6 ">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                value="{{ old('remember') ? 'checked' : '' }}">

            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>
    </div>
</div>