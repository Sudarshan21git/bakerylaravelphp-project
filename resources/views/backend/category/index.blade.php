@extends('layouts.backend_master')
@section('title','List Category')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Category Management</h1>
        <!-- Your content goes here -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List category
                    <a class="btn btn-primary" href="{{route('backend.category.create')}}">Create</a>
               
                </h6>
            </div>
            <div class="card-body">
                @include('backend.includes.flash_message')
                <table class="table table-bordered">
                    <tr>
                        <th>sn</th>
                        <th>Title</th>
                        <th>Rank</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @forelse($data['records'] as $record)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$record->title}}</td>
                            <td>{{$record->rank}}</td>
                            <td>
                               @include('backend.includes.display_status_message',['status'=>$record->status])
                            </td>
                            <td>                         
                           <a href="{{route('backend.category.show',$record->id)}}" class="btn btn-primary">View</a>
                           <a href="{{route('backend.category.edit',$record->id)}}" class="btn btn-warning">Edit</a>
                           
                           <form style="display: inline-block" method="post" action="{{route('backend.category.destroy',$record->id)}}">
                           @csrf
                                        <input type="hidden" name="_method" value="DELETE"/>
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                    </form>

                            </td>
                 
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"><span class="text-danger">No records</span></td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
