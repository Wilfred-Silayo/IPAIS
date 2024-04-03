@extends('layout')
@section('title','Login')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card bg-light shadow-sm">
            <div class="card-header bg-secondary text-white">{{ __('Login') }}</div>
            <div class="card-body">
                @session('error')
                <x-alert type="danger" session="error" />
                @endsession.
                @session('info')
                <x-alert type="info" session="info" />
                @endsession
                @session('success')
                <x-alert type="success" session="success" />
                @endsession
                <form method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <x-input-field input="email" type="email" text="Email" prefixIcon="fa fa-envelope"
                        placeholder="Enter Your Email" />
                    <x-input-field input="password" type="password" text="Password" prefixIcon="fa fa-lock"
                        placeholder="Enter Your Password" />
                    <x-form-footer text="Login" />
                </form>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('scripts/visibility.js')}}"></script>
@endsection