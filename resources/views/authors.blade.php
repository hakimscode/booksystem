@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p class="h1">Authors Management</p>
            <hr>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9"><h4>Data Authors</h4></div>
                        <div class="col-md-3">
                            <div class="float-right">
                            <a href="{{ route('insert-author') }}" type="button" class="btn btn-primary">Insert</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($authors as $key => $author)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $author->name }}</td>
                                <td>{{ $author->email }}</td>
                                <td>{{ $author->phone }}</td>
                                <td>
                                    <a href="/edit-author/{{ $author->id }}" type="button" class="btn btn-success">Edit</a>
                                    @admin
                                        <a href="/delete-author/{{ $author->id }}" type="button" class="btn btn-danger">Delete</a>
                                    @endadmin
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection