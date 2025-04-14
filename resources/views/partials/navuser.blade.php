<div class="container py-2">
    <div>
        <ul class="nav nav-underline border-0">
            <li class="nav-item">
              <a class="nav-link {{ Request::is('dashbook') ? 'active' : '' }} px-3 pb-2 mb-n1" href="/dashbook">Books</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('dashbook/requests') ? 'active' : '' }} px-3 pb-2 mb-n1" href="/dashbook/requests">My Requests</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('dashbook/borrowed') ? 'active' : '' }} px-3 pb-2 mb-n1" href="/dashbook/borrowed">My Borrowed Books</a>
            </li>
        </ul>          
    </div>
</div>
<hr class="m-0">