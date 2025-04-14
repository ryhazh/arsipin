<div class="modal" id="editBook{{ $book->id}}" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data" id="editBookForm">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    <div class="row g-4">
                        <div class="col-12 mb-2">
                            <label for="image" class="form-label">Book Cover</label>
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}"
                                    class="rounded shadow-sm" style="width: 100px; height: 140px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                    <small class="text-muted">Leave empty to keep current image</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="edit_title" class="form-control" 
                                value="{{ old('title', $book->title) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" name="author" id="edit_author" class="form-control" 
                                value="{{ old('author', $book->author) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="publisher" class="form-label">Publisher</label>
                            <input type="text" name="publisher" id="edit_publisher" class="form-control" 
                                value="{{ old('publisher', $book->publisher) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="publication_date" class="form-label">Publication Date</label>
                            <input type="date" name="publication_date" id="edit_publication_date"
                                class="form-control" value="{{ old('publication_date', $book->publication_date) }}" required>
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="edit_description" class="form-control" 
                                rows="3" required>{{ old('description', $book->description) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="edit_category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Genres</label>
                            <div class="dropdown w-100">
                                <button class="form-select text-start" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Select Genres
                                </button>
                                <div class="dropdown-menu p-3 shadow-sm" style="width: 100%; max-height: 300px; overflow-y: auto;">
                                    <div class="mb-2">
                                        <input type="text" class="form-control form-control" id="genreSearch"
                                            placeholder="Search genres..." autocomplete="off">
                                    </div>
                                    <div class="genre-list">
                                        @foreach ($genres as $genre)
                                            <div class="form-check py-1">
                                                <input type="checkbox" class="form-check-input genre-checkbox"
                                                    name="genres[]" value="{{ $genre->id }}"
                                                    id="genre{{ $genre->id }}"
                                                    {{ in_array($genre->id, old('genres', $book->genres->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="genre{{ $genre->id }}">
                                                    {{ $genre->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="total_copies" class="form-label">Total Copies</label>
                            <input type="number" name="total_copies" id="edit_total_copies" class="form-control"
                                value="{{ old('total_copies', $book->total_copies) }}" required min="1">
                        </div>


                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-muted me-auto"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Book</button>
                </div>
            </form>
        </div>
    </div>
</div>

