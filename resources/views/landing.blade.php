@extends('layouts.user')
@section('content')
    <section class="hero">
        <div class="container-xl">
            <div class="row align-items-center">
                <div class="col-lg-6 pt-5">
                    <h1 class="display-3 fw-bold mb-3">Modern Library Management Made Simple</h1>
                    <p class="fs-2 opacity-75 mb-4">An intuitive system for archiving books and managing borrowing requests.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="/login" class="btn btn-pill btn-lg">
                            Get Started
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-6" id="features">
        <div class="container-xl">
            <div class="text-center mb-5">
                <h2 class="h1">Powerful Features for Library Management</h2>
                <p class="text-muted">Everything you need to efficiently manage your library collection and borrowing system
                </p>
            </div>
            <div class="row g-4">
                <!-- Feature 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 feature-card">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="ti ti-books"></i>
                            </div>
                            <h3 class="card-title">Book Archiving</h3>
                            <p class="text-muted">Easily catalog and organize your library's entire collection with detailed
                                metadata.</p>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Categorize by genre, author,
                                    and more</li>
                                <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Upload book covers and
                                    descriptions</li>
                                <li><i class="ti ti-check text-success me-2"></i>Track book condition and status</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 feature-card">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="ti ti-exchange"></i>
                            </div>
                            <h3 class="card-title">Borrowing System</h3>
                            <p class="text-muted">Streamlined process for users to request books and admins to manage
                                approvals.</p>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Simple request submission
                                </li>
                                <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Admin approval workflow</li>
                                <li><i class="ti ti-check text-success me-2"></i>Automatic due date calculations</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 feature-card">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="ti ti-history"></i>
                            </div>
                            <h3 class="card-title">Comprehensive History</h3>
                            <p class="text-muted">Complete transaction records for both users and administrators.</p>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Track borrowing patterns
                                </li>
                                <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Due date notifications</li>
                                <li><i class="ti ti-check text-success me-2"></i>Historical reporting and analytics</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 feature-card">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="ti ti-users"></i>
                            </div>
                            <h3 class="card-title">Role-Based Access</h3>
                            <p class="text-muted">Separate interfaces and permissions for users and administrators.</p>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2"><i class="ti ti-check text-success me-2"></i>User-friendly borrower
                                    interface</li>
                                <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Powerful admin dashboard
                                </li>
                                <li><i class="ti ti-check text-success me-2"></i>Customizable permission levels</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 feature-card">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="ti ti-search"></i>
                            </div>
                            <h3 class="card-title">Advanced Search</h3>
                            <p class="text-muted">Find books quickly with powerful search and filtering options.</p>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Search by title, author, or
                                    keyword</li>
                                <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Filter by availability and
                                    category</li>
                                <li><i class="ti ti-check text-success me-2"></i>Save favorite searches</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 feature-card">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="ti ti-chart-bar"></i>
                            </div>
                            <h3 class="card-title">Analytics Dashboard</h3>
                            <p class="text-muted">Gain insights into library usage patterns and popular materials.</p>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Usage statistics and trends
                                </li>
                                <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Most/least borrowed items
                                </li>
                                <li><i class="ti ti-check text-success me-2"></i>Overdue tracking and reporting</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Footer -->
    <footer class="footer py-4">
        <div class="container-xl">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="mb-2"><span class="text-primary fw-bold">arsip</span><span class="text-dark">in</span>
                    </h2>
                    <p class="text-muted">Modern library management system for archiving books and managing borrowing
                        requests.</p>
                    <p class="mb-0 text-muted">© 2025 arsipin. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
@endsection
