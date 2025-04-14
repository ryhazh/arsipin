<div class="modal" id="addRecord" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Borrowing Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('records.borrow') }}" method="POST" id="addRecordForm">
                @csrf
                <div class="modal-body">
                    <div class="row g-4">
                        {{-- Book Selection --}}
                        <div class="col-md-12">
                            <label for="book_id" class="form-label">Book</label>
                            <select name="book_id" id="book_id" class="form-select" required>
                                <option value="">Select Book</option>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}" {{ $book->available_copies < 1 ? 'disabled' : '' }}>
                                        {{ $book->title }} ({{ $book->available_copies }} available)
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        {{-- Quantity --}}
                        <div class="col-md-6">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" name="quantity" id="quantity" 
                                class="form-control" required min="1" value="1">
                        </div>

                        {{-- Due Date --}}
                        <div class="col-md-6">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" name="due_date" id="due_date" 
                                class="form-control" required 
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        </div>

                        {{-- Reason --}}
                        <div class="col-md-12">
                            <label for="reason" class="form-label">Reason for Borrowing</label>
                            <textarea name="reason" id="reason" class="form-control" 
                                required rows="3" 
                                placeholder="Please state your reason for borrowing"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" 
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Record</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
document.getElementById('due_date').valueAsDate = new Date(Date.now() + 14 * 24 * 60 * 60 * 1000);
</script>
@endpush
