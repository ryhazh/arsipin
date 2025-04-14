@extends('layouts.librarian')
@section('content')
    <div class="container">
        <!-- Users Table -->
        <div class="card my-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Users List</h3>
                <button type="button" class="btn btn-pill" data-bs-toggle="modal" data-bs-target="#addUser">New Users</button>
            </div>

            @include('librarian.users.add')

            <div class="table-responsive">
                <table class="table table-hover table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th class="w-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users ?? [] as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
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
                                            <a class="dropdown-item edit-user" href="#" data-bs-toggle="modal"
                                                data-bs-target="#editUser{{ $user->id }}">
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
                                                data-bs-target="#deleteUser{{ $user->id }}">
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
                            <div class="modal" id="deleteUser{{ $user->id }}" tabindex="-1">
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
                                            <h3>Delete User</h3>
                                            <div class="text-secondary">
                                                Are you sure you want to delete "{{ $user->name }}"? This action cannot
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
                                                        <form action="{{ route('users.destroy', $user->id) }}"
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

                            @include('librarian.users.edit')
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer px-4 py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="m-0 text-secondary">Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }}
                        of
                        {{ $users->total() }} entries</p>
                    {{ $users->links('vendor.pagination.bootstrap-5') }}
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
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
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

