@extends('layout')
@section('title','Welcome')
@section('content')
<div class="container-fluid">
    @session('error')
    <x-alert type="danger" session="error" />
    @endsession.
    @session('info')
    <x-alert type="info" session="info" />
    @endsession
    @session('success')
    <x-alert type="success" session="success" />
    @endsession

    <!---small screen welcome navigation-->
    <div class="row d-inline d-md-none d-lg-none d-xl-none d-xxl-none">
        <a href="{{route('welcome.popular')}}"
            class="nav-link d-inline {{request()->routeIs('welcome.popular')? 'active': 'text-dark'}}">Popular</a>
        <a href="{{route('welcome.most.wanted')}}"
            class="nav-link d-inline {{request()->routeIs('welcome.most.wanted')? 'active': 'text-dark'}}">Most
            wanted</a>
        <a href="{{route('welcome.lost.items')}}"
            class="nav-link d-inline {{request()->routeIs('welcome.lost.items')? 'active': 'text-dark'}}">Lost
            Items</a>
    </div>
    <div class="mt-1 border-top d-md-none d-lg-none d-xl-none d-xxl-none"></div>
    <div class="row">
        <!---welcome content--->

        <div class="col-sm-12 col-md-8 me-1">
            <x-post-card />
        </div>

        <!---large screen welcome navigation-->
        <div class="col-md-3 ms-1 border d-none d-md-block d-xl-block d-lg-block d-xxl-block">
            <h4>Category</h4>
            <div class="row">
                <div
                    class="col-12 border-bottom border-top py-2 {{request()->routeIs('welcome.popular')?'bg-info':''}}">
                    <a href="{{route('welcome.popular')}}" class="text-decoration-none text-dark">
                        <h6>Popular</h6>
                    </a>
                </div>
                <div class="col-12  border-bottom py-2 {{request()->routeIs('welcome.most.wanted')?'bg-info':''}} ">
                    <a href="{{route('welcome.most.wanted')}}" class="text-decoration-none text-dark">
                        <h6>Most wanted</h6>
                    </a>
                </div>
                <div class="col-12 py-2 {{request()->routeIs('welcome.lost.items')?'bg-info':''}}">
                    <a href="{{route('welcome.lost.items')}}" class="text-decoration-none text-dark">
                        <h6>Lost Items</h6>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection