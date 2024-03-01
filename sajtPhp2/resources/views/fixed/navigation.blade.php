<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">

        <div class="col-lg-12 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                @if(session()->has('user'))
                    <div>
                        <p class="m-0 mr-2">Welcome {{session('user')->firstname}}</p>

                    </div>

                @endif

                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My Account</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        @if(!session()->has('user'))

                        <a href="/login" class="dropdown-item" type="button">Sign in</a>
                        <a href="/register" class="dropdown-item" type="button">Sign up</a>
                        @else
                            <a href="/profile" class="dropdown-item" type="button">Profile <i class="fa-solid fa-user"></i> </a>

                            <a href="/logout" class="dropdown-item" type="button">Logout <i class="fa-solid fa-power-off"></i></a>


                            @if(session()->get('user')->role_id == 1)
                                <a href="/admin" class="dropdown-item" type="button">Admin <i class="fa-solid fa-gears"></i></a>
                            @endif
                        @endif


                    </div>
                </div>

            </div>
            <div class="d-inline-flex align-items-center d-block d-lg-none">
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-heart text-dark"></i>
                </a>
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-shopping-cart text-dark"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for products">
                    <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-6 text-right">
            <p class="m-0">Customer Service</p>
            <h5 class="m-0">+012 345 6789</h5>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">

        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        @foreach($menu as $m)
                            <a href="{{$m->route}}" class="nav-item nav-link">{{$m->name}}</a>
                        @endforeach



                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">

                        <a href="/cart" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->
