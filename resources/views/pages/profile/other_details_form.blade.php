
@extends('layouts.app')

@section('title', 'Profile complete')

@section('content')
    <div class='container'>
        <div class="d-flex flex-column align-items-center text-center my-3">
            <h1>Complete profile</h1>
            <form data-url="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body form-group">
                        <div class="mb-3">
                            <label for="adminCountry" class="col-form-label">Country:</label>
                            <input name="country" type="text" class="form-control" id="adminCountry" required>
                        </div>
                        <div class="mb-3">
                            <label for="adminBirthDate" class="col-form-label">Birthdate:</label>
                            <input name="birthdate" type="date" class="form-control"  id="adminBirthDate" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        <div>
    </div>
@endsection