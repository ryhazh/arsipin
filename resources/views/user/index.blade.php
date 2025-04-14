@extends('layouts.user')
@section('content')
    <div class="container mt-5">
        <!-- Books Table -->
        <div class="mb-3 row">
            <form action="{{ route('books.userindex') }}" method="GET" class="row d-flex justify-content-between">
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
        @include('user.add')
        <div class="card my-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Books List</h3>
                <button class="btn btn-pill" data-bs-toggle="modal" data-bs-target="#addRecord">Borrow a Book</button>
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
                            </tr>
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

@push('scripts')
    <script>
        const genreSearch = document.getElementById('genreSearch');
        const genreCheckboxes = document.querySelectorAll('.genre-checkbox');

        function filterGenres() {
            const searchText = genreSearch.value.toLowerCase();

            genreCheckboxes.forEach(checkbox => {
                const label = checkbox.nextElementSibling;
                const text = label.textContent.toLowerCase();
                const checkboxContainer = checkbox.closest('.form-check');

                checkboxContainer.style.display = text.includes(searchText) ? '' : 'none';
            });
        }

        function updateGenreSelection() {
            const selectedCount = document.querySelectorAll('.genre-checkbox:checked').length;
            const dropdownButton = document.querySelector('.dropdown .form-select');

            dropdownButton.textContent = selectedCount > 0 ? `${selectedCount} selected` : 'Select Genres';
        }

        genreSearch.addEventListener('input', filterGenres);
        genreCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateGenreSelection);
        });
    </script>
@endpush
