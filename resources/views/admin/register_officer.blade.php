@extends('layout')
@section('title','Registration')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card bg-light shadow-sm">
            <div class="card-header bg-secondary text-white">{{ __('Register') }}</div>
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
                <form method="POST" action="{{ route('register.officer.store') }}">
                    @csrf
                    <input name="role" type="hidden" value="officer">
                    <x-input-field input="first_name" type="text" text="First Name" prefixIcon="fa fa-user"
                        placeholder="Enter First Name" />
                    <x-input-field input="last_name" type="text" text="Last Name" prefixIcon="fa fa-user"
                        placeholder="Enter Last Name" />
                    <x-input-field input="email" type="email" text="Email" prefixIcon="fa fa-envelope"
                        placeholder="Enter Email" />
                    <x-form-footer text="Register" />
                </form>
            </div>
        </div>
    </div>
</div>


@endsection