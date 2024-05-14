@extends('layout')
@section('title','Lost Items')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card bg-light shadow-sm">
                <div class="card-header bg-secondary text-white">{{ __('Report lost items') }}</div>
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
                    <form method="POST" action="{{ route('reporter.store.lost.items') }}" enctype="multipart/form-data">
                        @csrf
                        <x-input-field input="name" type="text" text="Name of the lost item" prefixIcon="fa fa-tag"
                            placeholder="Enter Name" />
                        <x-input-field input="category" type="text" text="Category" prefixIcon="fa fa-globe"
                            placeholder="Enter Category" />
                        <x-input-field input="location" type="text" text="Location where it was lost"
                            prefixIcon="fa fa-map" placeholder="Enter Location" />
                        <div class="mb-3">
                            <label for="images" class="form-label">Upload Images (Optional)</label>
                            <input type="file" class="form-control " id="images" name="images[]" multiple>
                        </div>
                        <x-text-area input="description" text="Description" placeholder="Enter description here" />
                        <x-form-footer text="Report" />
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection