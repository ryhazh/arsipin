@extends('layouts.librarian')
@section('content')
    <div class="container">
        <!-- Books Table -->
        <div class="card my-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Books List</h3>
                <a href="#" class="btn btn-pill">Add New</a> 
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Genre</th>
                            <th>Available Copies</th>
                            <th class="w-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books ?? [] as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->category }}</td>
                            <td>{{ $book->genre }}</td>
                            <td>{{ $book->available_copies }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Category and Genre Section -->
        <div class="row g-4">
            <!-- Category Table -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title m-0">Categories</h3>
                        <a href="#" class="btn btn-pill">Add New</a> 
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-vcenter card-table mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="w-1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories ?? [] as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Genre Table -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title m-0">Genres</h3>
                        <a href="#" class="btn btn-pill">Add New</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-vcenter card-table mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="w-1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($genres ?? [] as $genre)
                                <tr>
                                    <td>{{ $genre->name }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
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
