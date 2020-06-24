@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p class="h1">Books Management</p>
            <hr>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9"><h4>Data Books</h4></div>
                        <div class="col-md-3">
                            <div class="float-right">
                            <a href="{{ route('insert-book') }}" type="button" class="btn btn-primary">Insert</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Publisher</th>
                                <th>Year</th>
                                <th>Authors</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $key => $book)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>{{ $book->year }}</td>
                                <td>{{ $book->authors }}</td>
                                <td>
                                    <a href="/edit-book/{{ $book->id }}" type="button" class="btn btn-success">Edit</a>
                                    @admin
                                        <a href="/delete-book/{{ $book->id }}" type="button" class="btn btn-danger">Delete</a>
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