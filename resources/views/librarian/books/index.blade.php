@extends('layouts.librarian')
@section('content')
    <div class="container">
        @include('librarian.books.add')
        <!-- Books Table -->
        <div class="mb-3 row mt-5">
            <form action="{{ route('books.index') }}" method="GET" class="row d-flex justify-content-between">
                <div class="col-4">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="search" class="form-control" placeholder="Search for…"
                                value="{{ request('search') }}" />
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-icon" aria-label="Button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="10" cy="10" r="7" />
                                    <line x1="21" y1="21" x2="15" y2="15" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="dropdown">
                        <a href="#" class="btn dropdown-toggle w-full" data-bs-toggle="dropdown">Filter</a>
                        <div class="dropdown-menu p-3" style="width: 300px;">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-select">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Genres</label>
                                <div class="dropdown-menu show position-static border-0 shadow-none">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="genreSearch"
                                            placeholder="Search genres..." autocomplete="off">
                                    </div>
                                    <div class="genre-list" style="max-height: 200px; overflow-y: auto;">
                                        @foreach ($genres as $genre)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input genre-checkbox"
                                                    name="genres[]" value="{{ $genre->id }}"
                                                    id="genre{{ $genre->id }}"
                                                    {{ in_array($genre->id, request('genres', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="genre{{ $genre->id }}">
                                                    {{ $genre->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('books.userindex') }}" class="btn btn-link">Reset</a>
                                <button type="submit" class="btn btn-primary">Apply Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card my-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Books List</h3>
                <button type="button" class="btn btn-pill" data-bs-toggle="modal" data-bs-target="#addBook">
                    Add Book
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publication Date</th>
                            <th>Category</th>
                            <th>Genre</th>
                            <th>Available Copies</th>
                            <th class="w-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books ?? [] as $book)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}"
                                        class="rounded" style="width: 80px; height: 100px; object-fit: cover;">
                                </td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publication_date }}</td>
                                <td>{{ $book->category->name }}</td>
                                <td>
                                    {{ $book->genres->pluck('name')->join(', ') }}
                                </td>
                                <td>{{ $book->available_copies }}</td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-icon btn-ghost-secondary btn-sm"
                                            data-bs-toggle="dropdown">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M11 12a1 1 0 1 0 2 0a1 1 0 1 0-2 0m0 7a1 1 0 1 0 2 0a1 1 0 1 0-2 0m0-14a1 1 0 1 0 2 0a1 1 0 1 0-2 0" />
                                            </svg>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item edit-book" href="#" data-bs-toggle="modal"
                                                data-bs-target="#editBook{{ $book->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2">
                                                        <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                                        <path
                                                            d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3" />
                                                    </g>
                                                </svg> View / Edit
                                            </a>
                                            <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal"
                                                data-bs-target="#deleteBook{{ $book->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24"
                                                    height="24" viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            {{-- Delete Confirmation Modal --}}
                            <div class="modal" id="deleteBook{{ $book->id }}" tabindex="-1">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="modal-status bg-danger"></div>
                                        <div class="modal-body text-center py-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 9v2m0 4v.01" />
                                                <path
                                                    d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                                            </svg>
                                            <h3>Delete Book</h3>
                                            <div class="text-secondary">
                                                Are you sure you want to delete "{{ $book->title }}"? This action cannot
                                                be undone.
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="w-100 align-items-center">
                                                <div class="row">
                                                    <div class="col">
                                                        <button type="button" class="btn w-100" data-bs-dismiss="modal">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                    <div class="col">
                                                        <form action="{{ route('books.destroy', $book->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger w-100">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @include('librarian.books.edit')
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer px-4 py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="m-0 text-secondary">Showing {{ $books->firstItem() ?? 0 }} to {{ $books->lastItem() ?? 0 }}
                        of
                        {{ $books->total() }} entries</p>
                    {{ $books->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>

    </div>
    </div>



    </div>
@endsection

@if (session('error_message'))
    <div class="alert alert-warning alert-dismissible position-fixed top-0 end-0 m-3" role="alert"
        style="z-index: 1050; min-width: 300px;">
        <div class="d-flex">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                </svg>
            </div>
            <div>
                <h4 class="alert-title">{{ session('error_title', 'Error') }}</h4>
                <div class="text-secondary">{{ session('error_message') }}</div>
            </div>
        </div>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
@endif
