<nav class="navbar navbar-top navbar-expand navbar-dark" style="position: absolute; z-index:100; background-color:transparent; width:100%;">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav align-items-center mr-auto">
            <a class="nav-link " href="{{route('home')}}">
                <h2 class="text-light">BEREMPATI</h2>
            </a>
        </ul>
        <!-- Search form -->
        <form action="{{ route('search') }}" method="GET" class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative input-group-merge">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Cari Barang Lelang / Galang Dana" type="text" name="search_query" value="{{ $search ?? ''}}">
            </div>
          </div>
          <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </form>
        <!-- Navbar links -->

        <ul class="navbar-nav align-items-center  ml-auto mr-auto ml-md-0">
         
              
                <li class="nav-item d-sm-none">
                    <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                      <i class="ni ni-zoom-split-in"></i>
                    </a>
                  </li>
        </ul>
        <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
          <li class="nav-item dropdown">
            @guest
            <a class="nav-link pr-0" href="{{ route('login') }}">
                <div class="media align-items-center">
                  <span class="fas fa-sign-in-alt">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">Login</span>
                  </div>
                </div>
              </a>
            @else
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="ni ni-circle-08">
                </span>
                <div class="media-body  ml-2  d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">{{Auth::user()->name}}</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu  dropdown-menu-right ">
              <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome! <span class="text-capitalize">{{ Auth::user()->name }}</span></h6>
                <br>
                <h6 class="text-overflow m-0">Saldo anda: Rp. 26.000.000</h6>
              </div>
              <div class="dropdown-divider"></div>

              <a href="{{ route('crowdfund.createUser') }}" class="dropdown-item">
                <i class="ni ni-atom"></i>
                <span>Mulai Galang Dana</span>
              </a>
              <a href="{{ route('user.profile') }}" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </div>
            @endguest
          </li>
        </ul>
      </div>
    </div>
  </nav>