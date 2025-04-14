<?php
use Carbon\Carbon;
?>

<div class="modal" id="editRecord{{ $record->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Borrowing Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('records.update', $record->id) }}" method="POST" id="editRecordForm{{ $record->id }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-4">
                        {{-- Book Selection --}}
                        <div class="col-md-12">
                            <label for="book_id{{ $record->id }}" class="form-label">Book</label>
                            <select name="book_id" id="book_id{{ $record->id }}" class="form-select" required>
                                <option value="">Select Book</option>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}" 
                                        {{ $book->id === $record->book_id ? 'selected' : '' }}
                                        {{ ($book->available_copies < 1 && $book->id !== $record->book_id) ? 'disabled' : '' }}>
                                        {{ $book->title }} ({{ $book->available_copies }} available)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- User Selection --}}
                        <div class="col-md-12">
                            <label for="user_id{{ $record->id }}" class="form-label">Borrower</label>
                            <select name="user_id" id="user_id{{ $record->id }}" class="form-select" required>
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id === $record->user_id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Quantity --}}
                        <div class="col-md-6">
                            <label for="quantity{{ $record->id }}" class="form-label">Quantity</label>
                            <input type="number" name="quantity" id="quantity{{ $record->id }}" 
                                class="form-control" required min="1" value="{{ $record->quantity }}">
                        </div>

                        {{-- Due Date --}}
                        <div class="col-md-6">
                            <label for="due_date{{ $record->id }}" class="form-label">Due Date</label>
                            <input type="date" name="due_date" id="due_date{{ $record->id }}" 
                                class="form-control" required 
                                value="{{ $record->due_date }}">
                        </div>

                        {{-- Reason --}}
                        <div class="col-md-12">
                            <label for="reason{{ $record->id }}" class="form-label">Reason for Borrowing</label>
                            <textarea name="reason" id="reason{{ $record->id }}" class="form-control" 
                                required rows="3">{{ $record->reason }}</textarea>
                        </div>

                        {{-- Return Status --}}
                        <div class="col-md-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" 
                                    name="returned" id="returned{{ $record->id }}"
                                    {{ $record->returned_at ? 'checked' : '' }}>
                                <label class="form-check-label" for="returned{{ $record->id }}">
                                    Mark as Returned
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" 
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Record</button>
                </div>
            </form>
        </div>
    </div>
</div>