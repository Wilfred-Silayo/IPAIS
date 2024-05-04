@extends('layout')
@section('title','Profile Settings')
@section('content')
<div class="container">
    <x-profile :user=$user />
</div>
@endsection