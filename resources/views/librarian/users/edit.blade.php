<div class="modal" id="editUser{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('users.update', $user->id) }}" method="POST" id="editUserForm{{ $user->id }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-4">
                        {{-- Name --}}
                        <div class="col-md-12">
                            <label for="name{{ $user->id }}" class="form-label">Name</label>
                            <input type="text" name="name" id="name{{ $user->id }}" class="form-control" 
                                value="{{ $user->name }}" required>
                        </div>

                        {{-- Email --}}
                        <div class="col-md-12">
                            <label for="email{{ $user->id }}" class="form-label">Email</label>
                            <input type="email" name="email" id="email{{ $user->id }}" class="form-control" 
                                value="{{ $user->email }}" required>
                        </div>

                        {{-- Phone --}}
                        <div class="col-md-12">
                            <label for="phone{{ $user->id }}" class="form-label">Phone</label>
                            <input type="tel" name="phone" id="phone{{ $user->id }}" class="form-control" 
                                value="{{ $user->phone }}" required>
                        </div>

                        {{-- Password --}}
                        <div class="col-md-12">
                            <label for="password{{ $user->id }}" class="form-label">Password</label>
                            <input type="password" name="password" id="password{{ $user->id }}" class="form-control" 
                                placeholder="Leave blank to keep current password">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>