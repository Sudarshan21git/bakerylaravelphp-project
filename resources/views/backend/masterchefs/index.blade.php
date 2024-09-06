@extends('layouts.backend_master')

@section('title', 'Master Chefs')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Master Chefs Management</h1>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    List of Master Chefs
                </div>
                <div class="card-body">
                    @include('backend.includes.flash_message')
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Specialty</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chefs as $key => $chef)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $chef->name }}</td>
                                <td>{{ $chef->specialty }}</td>
                                <td><img src="{{ asset('images/masterchefs/' . $chef->photo) }}" width="50" height="50"></td>
                                <td>
                                    <a href="{{ route('backend.masterchefs.edit', $chef->id) }}" class="btn btn-primary">
                                        Edit
                                    </a>
                                    <form style="display: inline-block" method="POST" action="{{ route('backend.masterchefs.destroy', $chef->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group">
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addMasterChefModal">Add Master Chef</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Master Chef Modal -->
    <div class="modal fade" id="addMasterChefModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Master Chef</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form action="{{ route('backend.masterchefs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="chefName">Name</label>
                            <input type="text" class="form-control" id="chefName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="chefSpecialty">Specialty</label>
                            <input type="text" class="form-control" id="chefSpecialty" name="specialty" required>
                        </div>
                        <div class="form-group">
                            <label for="chefImage">Image</label>
                            <input type="file" class="form-control" id="chefImage" name="photo">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Master Chef</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
