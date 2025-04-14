<?php
use Carbon\Carbon;
?>

@extends('layouts.librarian')
@section('content')
    <div class="container">
        <div class="card my-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Incoming Requests</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Borrower</th>
                            <th>Requested Date</th>
                            <th>Due Date</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th class="w-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests ?? [] as $record)
                            <tr>
                                <td>{{ $record->book->title }}</td>
                                <td>{{ $record->user->name }}</td>
                                <td>{{ Carbon::parse($record->borrowed_at)->format('M d, Y') }}</td>
                                <td>{{ Carbon::parse($record->due_date)->format('M d, Y') }}</td>
                                <td>
                                    @if ($record->reason)
                                        <span class="badge bg-blue-lt">{{ $record->reason }}</span>
                                    @else
                                        <span class="badge bg-green-lt">No reason</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-yellow-lt">Pending</span>
                                </td>
                                <td class="d-flex align-items-center">
                                    <form action="{{ route('records.approve', $record->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-pill rounded-end-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M5 12l5 5L20 7" />
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="{{ route('records.reject', $record->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-pill rounded-start-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M18 6L6 18M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer px-4 py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="m-0 text-secondary">Showing {{ $requests->firstItem() ?? 0 }} to
                        {{ $requests->lastItem() ?? 0 }} of {{ $requests->total() }} entries</p>
                    {{ $requests->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@if (session('success'))
    <div class="alert alert-success alert-dismissible position-fixed top-0 end-0 m-3" role="alert"
        style="z-index: 1050; min-width: 300px;">
        <div class="d-flex">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l5 5l10 -10"></path>
                </svg>
            </div>
            <div>
                <h4 class="alert-title">Success</h4>
                <div class="text-secondary">{{ session('success') }}</div>
            </div>
        </div>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
@endif

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