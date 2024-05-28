@extends('layout')
@section('title', 'Dashboard')
@section('content')
<div class="container bg-white">
    <div class="row py-2 border-bottom">
        <h4 class="text-center text-success">Messages</h4>
    </div>
    <div class="row mt-1">
        <div class="col-4 bg-light overflow-auto border-end" style="height: 75vh;">
            <livewire:search-user />
        </div>
        <div class="col-8" style="height: 75vh;">
            <div class="row text-white bg-success p-2 mx-1 rounded-bottom">
                Start a new conversation by selecting the
                user from the right side</div>
            <livewire:conversations />
        </div>
    </div>
</div>
@endsection