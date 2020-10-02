<aside class="col-md-4 col-lg-3">
    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
        <li class="nav-item">
            <a href="{{ route('user.account') }}" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('user.order') }}" class="nav-link">Orders</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('account.detail') }}" class="nav-link">Account Details</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('user.wishlist.page') }}" class="nav-link">Wishlist</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.getLogout') }}"> Logout</a>
        </li>
    </ul>
</aside><!-- End .col-lg-3 -->