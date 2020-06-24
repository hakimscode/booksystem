@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p class="h1">Edit Book</p>
            <hr>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8"><h4>Form Book</h4></div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('update-book') }}">
                        @csrf
                        <input name="id" type="hidden" value="{{ $book->id }}">
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $book->title }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="publisher" class="col-md-4 col-form-label text-md-right">Publisher</label>

                            <div class="col-md-6">
                                <input id="publisher" type="text" class="form-control @error('publisher') is-invalid @enderror" name="publisher" value="{{ $book->publisher }}" required autocomplete="publisher" autofocus>

                                @error('publisher')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="year" class="col-md-4 col-form-label text-md-right">Year</label>

                            <div class="col-md-6">
                                <input id="ye" type="number" class="form-control @error('ye') is-invalid @enderror" name="year" value="{{ $book->year }}" required autocomplete="year" autofocus>

                                @error('ye')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Authors</label>

                            <div class="col-md-4">
                                <select id="author_id" class="form-control">
                                    @foreach ($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <a class="btn btn-success" id="add_author">+</a>
                                <a class="btn btn-warning" id="reset_author">-</a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6">
                                <textarea name="authors" id="authors" cols="45" rows="4" readonly>{{ $current_authors }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection