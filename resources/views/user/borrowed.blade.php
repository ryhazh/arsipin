<?php
use Carbon\Carbon;
?>

@extends('layouts.user')
@section('content')
    <div class="container">
        <div class="card my-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">My Borrowed Books</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Borrowed Date</th>
                            <th>Due Date</th>
                            <th>Reason</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrowed ?? [] as $borrow)
                            <tr>
                                <td>{{ $borrow->book->title }}</td>
                                <td>{{ Carbon::parse($borrow->borrowed_at)->format('M d, Y') }}</td>
                                <td>
                                    @if ($borrow->due_date < now() && !$borrow->returned_at)
                                        <span class="text-danger">{{ Carbon::parse($borrow->due_date)->format('M d, Y') }}</span>
                                    @else
                                        {{ Carbon::parse($borrow->due_date)->format('M d, Y') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($borrow->reason)
                                        <span class="badge bg-blue-lt">{{ $borrow->reason }}</span>
                                    @else
                                        <span class="badge bg-green-lt">No reason</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($borrow->returned_at)
                                        <span class="badge bg-green-lt">Returned</span>
                                    @elseif($borrow->due_date < now())
                                        <span class="badge bg-red-lt">Overdue</span>
                                    @else
                                        <span class="badge bg-blue-lt">Borrowed</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer px-4 py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="m-0 text-secondary">Showing {{ $borrowed->firstItem() ?? 0 }} to
                        {{ $borrowed->lastItem() ?? 0 }} of {{ $borrowed->total() }} entries</p>
                    {{ $borrowed->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

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
@endsection