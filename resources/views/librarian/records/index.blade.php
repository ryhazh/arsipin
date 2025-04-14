<?php
use Carbon\Carbon;
?>

@extends('layouts.librarian')
@section('content')
    <div class="container">
        @include('librarian.records.add')
        <div class="card my-4">
            <div class="card-header">
                <div class="d-flex align-items-center w-100 flex-wrap">
                    <!-- Left Side: Title + Filter Form -->
                    <div class="d-flex gap-3 align-items-center flex-grow-1">
                        <div>
                            <h3 class="card-title m-0">Borrowing Records</h3>
                        </div>
                        <div>
                            <form method="GET" action="{{ route('records.index') }}" class="d-flex gap-2">
                                <input type="month" class="form-control" name="month"
                                    value="{{ $month ?? now()->format('Y-m') }}">
                                <button type="submit" class="btn">Filter</button>
                            </form>
                        </div>
                    </div>

                    <!-- Right Side: Borrow a Book Button -->
                    <div class="md:ms-auto">
                        <button class="btn btn-pill" data-bs-toggle="modal" data-bs-target="#addRecord">
                            Borrow a Book
                        </button>
                    </div>
                </div>

            </div>
            <div class="table-responsive">
                <table class="table table-hover table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Borrower</th>
                            <th>Borrowed Date</th>
                            <th>Due Date</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th class="w-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records ?? [] as $record)
                            @include('librarian.records.edit')

                            <tr>
                                <td>{{ $record->book->title }}</td>
                                <td>{{ $record->user->name }}</td>
                                <td>{{ Carbon::parse($record->borrowed_at)->format('M d, Y') }}</td>
                                <td>
                                    @if ($record->due_date < now() && !$record->returned_at)
                                        <span
                                            class="text-danger">{{ Carbon::parse($record->due_date)->format('M d, Y') }}</span>
                                    @else
                                        {{ Carbon::parse($record->due_date)->format('M d, Y') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($record->reason)
                                        <span class="badge bg-blue-lt">{{ $record->reason }}</span>
                                    @else
                                        <span class="badge bg-green-lt">No reason</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($record->returned_at)
                                        <span class="badge bg-green-lt">Returned</span>
                                    @elseif($record->due_date < now())
                                        <span class="badge bg-red-lt">Overdue</span>
                                    @else
                                        <span class="badge bg-blue-lt">Borrowed</span>
                                    @endif
                                </td>
                                <td class="d-flex align-items-center">
                                    @if (!$record->returned_at)
                                        <form action="{{ route('records.return', $record->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-pill rounded-end-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2">
                                                        <path d="M14 20H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h12v5" />
                                                        <path d="M11 16H6a2 2 0 0 0-2 2m11-2l3-3l3 3m-3-3v9" />
                                                    </g>
                                                </svg>
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-pill rounded-start-0" data-bs-toggle="modal"
                                            data-bs-target="#editRecord{{ $record->id }}"> <svg
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24">
                                                <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2">
                                                    <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3" />
                                                </g>
                                            </svg>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-pill" data-bs-toggle="modal"
                                            data-bs-target="#editRecord{{ $record->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24">
                                                <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2">
                                                    <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3" />
                                                </g>
                                            </svg>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer px-4 py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="m-0 text-secondary">Showing {{ $records->firstItem() ?? 0 }} to
                        {{ $records->lastItem() ?? 0 }} of {{ $records->total() }} entries</p>
                    {{ $records->links('vendor.pagination.bootstrap-5') }}
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
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
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
