<div class="form-group row">
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn offset-4 btn-secondary">
            {{ __($text) }}
        </button>
        @if (Route::has('password.request')&& request()->routeIs('login'))
        <a class="btn btn-link ms-4 ps-4" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
        @endif
    </div>
</div>