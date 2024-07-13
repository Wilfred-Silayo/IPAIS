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
    <div class="row">
        <div class="col-md-9">
            <div class="row border p-2 mb-2">
                <div class="col me-1">
                    <x-card header="Total Reporters" :body="$reporters" route="manage.users" />
                </div>
                <div class="col">
                    <x-card header="Total Officers" :body="$officers" route="manage.users.officers" />
                </div>
            </div>

            <div class="row mt-3 me-1 p-2 card">
                <p class="fw-bold">Recent Users</p>
                <div class="table-responsive">
                    <table id="example1" class="table table-striped table-hover">
                        <thead>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Role</th>
                            <th>Email</th>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->first_name}}</td>
                                <td>{{$user->last_name}}</td>
                                <td>{{$user->role}}</td>
                                <td>{{$user->email}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $users->links('paginationlinks') }}

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