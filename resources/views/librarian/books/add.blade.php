<div class="modal" id="addBook" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" id="addBookForm">
                @csrf
                <div class="modal-body">
                    <div class="row g-4">
                        {{-- Image Upload --}}
                        <div class="col-12">
                            <label for="image" class="form-label">Book Cover</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <small class="text-muted">Recommended size: 400x600 pixels</small>
                        </div>

                        {{-- Basic Information --}}
                        <div class="col-md-6">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" 
                                placeholder="Enter book title" required>
                        </div>

                        <div class="col-md-6">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" name="author" id="author" class="form-control" 
                                placeholder="Enter author name" required>
                        </div>

                        {{-- Publishing Details --}}
                        <div class="col-md-6">
                            <label for="publisher" class="form-label">Publisher</label>
                            <input type="text" name="publisher" id="publisher" class="form-control" 
                                placeholder="Enter publisher name" required>
                        </div>

                        <div class="col-md-6">
                            <label for="publication_date" class="form-label">Publication Date</label>
                            <input type="date" name="publication_date" id="publication_date" 
                                class="form-control" required>
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" 
                                rows="3" placeholder="Enter book description" required></textarea>
                        </div>

                        {{-- Categories and Genres --}}
                        <div class="col-md-6">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Genres</label>
                            <div class="dropdown w-100">
                                <button class="form-select text-start" type="button" 
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Select Genres
                                </button>
                                <div class="dropdown-menu p-3 shadow-sm" style="width: 100%; max-height: 300px; overflow-y: auto;">
                                    <div class="mb-2">
                                        <input type="text" class="form-control form-control" 
                                            id="genreSearch" placeholder="Search genres..." autocomplete="off">
                                    </div>
                                    <div class="genre-list">
                                        @foreach ($genres as $genre)
                                            <div class="form-check py-1">
                                                <input type="checkbox" class="form-check-input genre-checkbox"
                                                    name="genres[]" value="{{ $genre->id }}" 
                                                    id="genre{{ $genre->id }}">
                                                <label class="form-check-label" for="genre{{ $genre->id }}">
                                                    {{ $genre->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Inventory Information --}}
                        <div class="col-md-6">
                            <label for="total_copies" class="form-label">Total Copies</label>
                            <input type="number" name="total_copies" id="total_copies" 
                                class="form-control" placeholder="Enter total copies" required min="1">
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" 
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Book</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
