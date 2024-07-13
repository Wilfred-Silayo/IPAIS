@extends('layout')
@section('title','Edit Profile')
@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-12">
            <div class="card">
                <div class="card-header fw-bold">
                    Edit profile
                </div>
                <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
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
                        <div class="row">
                            <div class="col">
                                <img height="100" width="auto" class="rounded border border-2 border-primary p-1 mb-2"
                                    src="{{asset(Storage::url('profile_images/'.$user->profile_image))}}"
                                    alt="profile image">
                            </div>
                            <div class="col">
                                <x-update-field text="Profile photo" input="profile_image" type="file"
                                    :value="$user->profile_image" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <x-update-field text="First name" input="first_name" type="text"
                                    :value="$user->first_name" />
                            </div>
                            <div class="col">
                                <x-update-field text="Last name" input="last_name" type="text"
                                    :value="$user->last_name" />

                            </div>
                        </div>

                        <x-update-field text="Email" input="email" type="email" :value="$user->email" />

                        <x-update-field text="Address" input="address" type="text" :value="$user->address" />

                        <x-update-field text="Date of Birth" input="dob" type="date" :value="$user->dob" />

                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <input type="submit" value="Save" class="btn btn-primary">
                        <a href="{{route('profile.settings')}}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection