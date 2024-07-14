@extends('layout')
@section('title','Crimes')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card bg-light shadow-sm">
                <div class="card-header bg-secondary text-white">{{ __('Create Most Wanted') }}</div>
                <div class="card-body col-md-6">
                    @session('error')
                    <x-alert type="danger" session="error" />
                    @endsession.
                    @session('info')
                    <x-alert type="info" session="info" />
                    @endsession
                    @session('success')
                    <x-alert type="success" session="success" />
                    @endsession
                    <form method="POST" action="{{ route('officer.store.crimes') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="is_most_wanted" value="1">
                        <x-input-field input="name" type="text" text="Name of the crime" prefixIcon="fa fa-tag"
                            placeholder="Enter Name" />
                        <x-input-field input="category" type="text" text="Category" prefixIcon="fa fa-globe"
                            placeholder="Enter Category" />
                        <x-input-field input="date_occurred" type="date" text="Date Occurred"
                            prefixIcon="fa fa-calendar" placeholder="Enter date of occurrance" />
                        <x-input-field input="location" type="text" text="Location where it was happened"
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