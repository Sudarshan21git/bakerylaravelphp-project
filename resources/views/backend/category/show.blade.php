@extends('layouts.backend_master')
@section('title', 'Category Details')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Category Management</h1>
        <!-- Your content goes here -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Details
                    <a class="btn btn-primary" href="{{ route('backend.category.create') }}">Create</a>
                    <a class="btn btn-secondary" href="{{ route('backend.category.index') }}">List</a>
                </h6>
            </div>
            <div class="card-body">
                @include('backend.includes.flash_message')
                <table class="table table-bordered">
                    @if($category)
                        <tr><th>Name</th>
                        <td>{{ $category->title }}</td></tr>
                        <tr><th>Rank</th>
                        <td>{{ $category->rank }}</td></tr>
                        <tr><th>Icon</th>
                       <td><img src="{{ asset('assets/images/category/' . $category->icon) }}" width="50%" alt="Category Icon">
                        
                       </td> </tr>
                       <tr><th>passout Status</th>
                       <td>@include('backend.includes.display_status_message', ['status' => $category->status])</td>

                        </tr>
                        <tr><th>Created BY</th>
                        <td>{{ $category->created_by}}</td></tr>
                        <tr><th>Updated By</th>
                        <td>{{ $category->updated_by }}</td></tr>
                        <tr><th>Created At</th>
                        <td>{{ $category->created_at}}</td></tr>
                        <tr><th>Updated At</th>
                        <td>{{ $category->updated_at }}</td></tr>
                    @else
                        <tr><th colspan="2">Category not found.</th></tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
