@extends('layout')
@section('title','Dashboard')
@section('content')
<div class="container">
    <div class="row bg-light justify-content-between">
        <div class="col">
            <p class="fw-bold">Welcome : <span class="text-primary">{{Auth::user()->first_name}}
                    {{Auth::user()->last_name}}</span> </p>
        </div>
        <div class="col text-end text-danger fw-bold">
            <p>
                Administrator
            </p>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-9">
            <div class="row justify-content-around">
                <div class="col col-md-3">
                    <x-card header="Total Reporters" :body="$reporters" route="manage.users" />
                </div>
                <div class="col col-md-3">
                    <x-card header="Total Officers" :body="$officers" route="manage.users.officers" />
                </div>
            </div>
        </div>

        <div class="col-md-3 border-start border-2 border-danger">
            <p class="fw-bold">Quick links</p>
            <ul>
                <li>
                    <a href="{{route('profile.edit')}}">Edit profile</a>
                </li>
                <li>
                    <a href="{{route('notifications')}}">Read notifications</a>
                </li>
            </ul>

        </div>
    </div>
</div>
@endsection