<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container-fluid">
        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons visible-on-sidebar-mini">view_list</i>
            </button>
        </div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/vendor/dashboard">{{ Auth::user()->vendor->name }}'s Dashboard </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/vendor/dashboard" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="material-icons">dashboard</i>
                        <p class="hidden-lg hidden-md">Dashboard</p>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="material-icons">notifications</i>
                        <span class="notification">{{ Auth::user()->vendor->messageCount() }}</span>
                        <p class="hidden-lg hidden-md">
                            Messages
                            <b class="caret"></b>
                        </p>
                    </a>
                    <ul class="dropdown-menu" style="max-width: 300px;overflow: hidden;">
                        @foreach (Auth::user()->vendor->messages() as $message)

                            <li>
                                <a href="#">{{ $message->message }}</a>
                            </li>
                        @endforeach
                        <li class="text-center">
                            <a href="/vendor/messages"><Strong>View All</Strong></a>
                        </li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="material-icons">person</i>
                        <p class="hidden-lg hidden-md">Profile</p>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#">Setting</a>
                        </li>
                        <li>
                            <form action="" method="post">
                                @csrf
                            </form>
                            <a href="{{route('vendor.getLogout')}}" >Logout</a>
                        </li>
                    </ul>
                </li>
                <li class="separator hidden-lg hidden-md"></li>
            </ul>

        </div>
    </div>
</nav>
