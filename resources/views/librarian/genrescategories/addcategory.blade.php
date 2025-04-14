<div class="modal" id="addCategory" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Categoru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" id="addCategoryForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        {{-- Basic Information --}}
                        <div>
                            <label for="title" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" 
                                placeholder="Enter genre name" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" 
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>