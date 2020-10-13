@include('themes.molla.user.onesignal')
<aside class="col-md-4 col-lg-3 mb-2" style="background: #F8F8F8;">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav nav-dashboard flex-column mb-3 mb-md-0 " role="tablist" style="width:100%;">
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
        </div>
    </nav>
</aside><!-- End .col-lg-3 -->
