@extends('layouts.librarian')
@section('content')
    <div class="container mt-4">
        <div class="row g-4">
            <!-- Categories Section -->
            @include('librarian.genrescategories.addcategory')
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title m-0">Categories</h3>
                        <button class="btn btn-pill" data-bs-toggle="modal" data-bs-target="#addCategory">Add New</button>
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
                                @foreach ($categories ?? [] as $category)
                                    <tr>
                                        <td>
                                            <span class="item-name">{{ $category->name }}</span>
                                            <form action="{{ route('category.update', $category->id) }}" method="POST"
                                                class="edit-form d-none">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $category->name }}">
                                            </form>
                                        </td>
                                        <td>
                                            <div class="action-buttons d-flex align-items-center">
                                                <button class="btn btn-pill edit-btn rounded-end-0"
                                                    onclick="toggleEdit(this)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24">
                                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M4 20h4L18.5 9.5a2.828 2.828 0 1 0-4-4L4 16zm9.5-13.5l4 4" />
                                                    </svg>
                                                </button>
                                                <button class="btn btn-pill delete-btn rounded-start-0"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteCategory{{ $category->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24">
                                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <button class="btn btn-pill save-btn d-none"
                                                onclick="saveEdit(this)">Save</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @include('librarian.genrescategories.addgenre')
            <!-- Genres Section -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title m-0">Genres</h3>
                        <button class="btn btn-pill" data-bs-toggle="modal" data-bs-target="#addGenre">Add New</button>
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
                                @foreach ($genres ?? [] as $genre)
                                    <tr>
                                        <td>
                                            <span class="item-name">{{ $genre->name }}</span>
                                            <form action="{{ route('genre.update', $genre->id) }}" method="POST"
                                                class="edit-form d-none">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $genre->name }}">
                                            </form>
                                        </td>
                                        <td>
                                            <div class="action-buttons d-flex align-items-center">
                                                <button class="btn btn-pill edit-btn rounded-end-0"
                                                    onclick="toggleEdit(this)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24">
                                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M4 20h4L18.5 9.5a2.828 2.828 0 1 0-4-4L4 16zm9.5-13.5l4 4" />
                                                    </svg>
                                                </button>
                                                <button class="btn btn-pill delete-btn rounded-start-0"
                                                    data-bs-toggle="modal" data-bs-target="#deleteGenre{{ $genre->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24">
                                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <button class="btn btn-pill save-btn d-none"
                                                onclick="saveEdit(this)">Save</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function toggleEdit(button) {
                const row = button.closest('tr');
                const nameSpan = row.querySelector('.item-name');
                const editForm = row.querySelector('.edit-form');
                const actionButtons = row.querySelector('.action-buttons');
                const saveBtn = row.querySelector('.save-btn');

                nameSpan.classList.toggle('d-none');
                editForm.classList.toggle('d-none');
                actionButtons.classList.toggle('d-none');
                saveBtn.classList.toggle('d-none');
            }

            function saveEdit(button) {
                const row = button.closest('tr');
                const form = row.querySelector('.edit-form');
                form.submit();
            }
        </script>

        <!-- Category Delete Modal -->
        @foreach ($categories ?? [] as $category)
            <div class="modal" id="deleteCategory{{ $category->id }}" tabindex="-1">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-status bg-danger"></div>
                        <div class="modal-body text-center py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 9v2m0 4v.01" />
                                <path
                                    d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                            </svg>
                            <h3>Delete Category</h3>
                            <div class="text-secondary">Are you sure you want to delete "{{ $category->name }}"? This
                                action cannot be undone.</div>
                        </div>
                        <div class="modal-footer">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col"><button class="btn w-100" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                    <div class="col">
                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger w-100">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Genre Delete Modal -->
        @foreach ($genres ?? [] as $genre)
            <div class="modal" id="deleteGenre{{ $genre->id }}" tabindex="-1">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-status bg-danger"></div>
                        <div class="modal-body text-center py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 9v2m0 4v.01" />
                                <path
                                    d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                            </svg>
                            <h3>Delete Genre</h3>
                            <div class="text-secondary">Are you sure you want to delete "{{ $genre->name }}"? This action
                                cannot be undone.</div>
                        </div>
                        <div class="modal-footer">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col"><button class="btn w-100" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                    <div class="col">
                                        <form action="{{ route('genre.destroy', $genre->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger w-100">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
