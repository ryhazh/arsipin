<div class="container py-2">
    <div>
        <ul class="nav nav-underline border-0">
            <li class="nav-item">
              <a class="nav-link {{ Request::is('books*') ? 'active' : '' }} px-3 pb-2 mb-n1" href="/books">Books</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('genrescategories*') ? 'active' : '' }} px-3 pb-2 mb-n1" href="/genrescategories">Genres & Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('users*') ? 'active' : '' }} px-3 pb-2 mb-n1" href="/users">Users</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle {{ Request::is('records*') ? 'active' : '' }} px-3 pb-2 mb-n1" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Records</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/records">All Records</a></li>
                <li><a class="dropdown-item" href="/records/requests">Requests</a></li>
              </ul>
            </li>
        </ul>          
    </div>
</div>
<hr class="m-0">