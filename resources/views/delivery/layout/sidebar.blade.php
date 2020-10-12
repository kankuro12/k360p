<div class="sidebar" data-active-color="rose" data-background-color="black"
    data-image="{{ asset('images/backend_images/sidebar-1.jpg') }}">
    <div class="logo">
        <a href="#" class="simple-text logo-normal">
            <span class="sidebar-normal " style="padding-left: 2rem;"> Multi Ecom </span>
        </a>
    </div>
    <div class="sidebar-wrapper">
      
        <ul class="nav">
            <li class="{{Route::is('delivery.dashboard')?"active":""}}">
                <a href="{{route('delivery.dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <p> Dashboard </p>
                </a>
            </li>
            <li class="{{Route::is('delivery.pickup')?"active":""}}">
                <a href="{{route('delivery.pickup')}}">
                    <i class="material-icons">directions_boat</i>
                    <p> Pickup </p>
                </a>
            </li>
            <li class="{{ (Route::is('delivery.warehouse') ? ' active' : '') }}"  >
                <a href="{{ route('delivery.warehouse') }}">
                    <i class="material-icons">house
                    </i>
                    <p> Items in Warehouse </p>
                </a>
            </li>

            <li class="{{ (Route::is( 'delivery.delivered') ? ' active' : '') }}"  >
                <a href="{{ route( 'delivery.delivered') }}">
                    <i class="material-icons">house
                    </i>
                    <p> Make A Delivery </p>
                </a>
            </li>

           
          
        </ul>
    </div>
</div>
