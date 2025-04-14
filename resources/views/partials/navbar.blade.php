<div class="container py-2 d-flex justify-content-between align-items-center">
    <div>
        <img src="{{ asset('assets/logo.svg') }}" alt="Logo" class="img-fluid" width="100">
    </div>
    <div class="d-flex align-items-center gap-3">
        <a href="https://github.com/ryhazh/arsipin" class="btn" target="_blank"> <svg xmlns="http://www.w3.org/2000/svg"
                width="20" height="20" viewBox="0 0 24 24">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 19c-4.3 1.4-4.3-2.5-6-3m12 5v-3.5c0-1 .1-1.4-.5-2c2.8-.3 5.5-1.4 5.5-6a4.6 4.6 0 0 0-1.3-3.2a4.2 4.2 0 0 0-.1-3.2s-1.1-.3-3.5 1.3a12.3 12.3 0 0 0-6.2 0C6.5 2.8 5.4 3.1 5.4 3.1a4.2 4.2 0 0 0-.1 3.2A4.6 4.6 0 0 0 4 9.5c0 4.6 2.7 5.7 5.5 6c-.6.6-.6 1.2-.5 2V21" />
            </svg> &nbsp; Source Code</a>
        {{-- Add dark mode toggle button --}}
        <button class="btn btn-pill p-2" id="darkModeToggle">
            <i class="ti ti-sun-filled" id="lightIcon"></i>
            <i class="ti ti-moon-filled" id="darkIcon" style="display: none;"></i>
        </button>
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex align-items-center gap-2">

                @if (isset($currentUser))
                    <div class="dropdown">
                        <button class="btn  p-2 btn-pill" data-bs-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2">
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0-18 0" />
                                    <path
                                        d="M9 10a3 3 0 1 0 6 0a3 3 0 1 0-6 0m-2.832 8.849A4 4 0 0 1 10 16h4a4 4 0 0 1 3.834 2.855" />
                                </g>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end p-0" style="min-width: 200px;">
                            <div class="p-3 border-bottom">
                                <div class="d-flex flex-column">
                                    <span class="h3 mb-1">{{ $currentUser->name }}</span>
                                    <span class="text-secondary">ID: {{ $currentUser->id }}</span>
                                </div>
                            </div>
                            @auth
                                <div class="p-3">
                                    <button type="button"
                                        class="btn btn-danger w-100 d-flex align-items-center justify-content-center gap-2"
                                        data-bs-toggle="modal" data-bs-target="#logoutModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg>
                                        Logout
                                    </button>
                                </div>
                            @endauth
                        </div>
                    </div>
                    <p class="fw-bold m-0">{{ $currentUser->name }}</p>
                @endif

            </div>
        </div>
    </div>
</div>
<hr class="m-0">

{{-- Logout Confirmation Modal --}}
<div class="modal" id="logoutModal" tabindex="-1">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                </svg>
                <h3>Logout Confirmation</h3>
                <div class="text-secondary">
                    Are you sure you want to logout from your account?
                </div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn w-100" data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                        <div class="col">
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
