@extends('layouts.app')

@section('title', 'Parents List')

@section('content')
    <div class='container'>
        <div class="d-flex flex-column align-items-center text-center my-3">
            <h1>Parents List</h1>
            <div class="alert alert-success m-2 d-none alert-dismissible fade show" id="successAlert" role="alert">
                <strong></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="alert alert-danger m-2 d-none alert-dismissible fade show" id="errorAlert" role="alert">
                <strong></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <button type="button" data-url="{{ route('parents.create') }}" class="btn btn-primary p-2 m-2 add-parent" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Add Parent</button>

        <div id="parent_listing_table">
            @include('pages.templates.parents.listing', ['parents' => $parents ?? null])
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="addUpdateParentFormModal">
                @include('pages.templates.parents.parent_add_update_form', ['childrens' => $childrens ?? null])
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/parents/parent.js') }}"></script>
@endsection