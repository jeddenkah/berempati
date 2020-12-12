@extends('layouts.main')
@section('title', 'Login')
@section('header')
<div class="header-body text-center mb-7">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            <h1 class="text-white">Welcome!</h1>
            <p class="text-lead text-white">Kebahagiaan bukan hak kita semata, tetapi juga orang lain</p>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row justify-content-center">
  @for ($i = 0; $i < 3; $i++)
  <div class="col-xl-4 order-xl-1">
    <div class="card card-profile">
      <img src="img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">

      <div class="card-header text-center border-0 pt-4 pt-md-2 pb-0 pb-md-4">
        <div class="progress-wrapper mb-4">
          <div class="progress-info">
            <div class="progress-label">
              <span>28 hari lagi</span>
            </div>
            <div class="progress-percentage">
              <span>Rp. 26.000.000</span>
            </div>
          </div>
          <div class="progress">
            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <a href="#" class="btn btn-sm btn-default">Lelang Barang</a>
          <a href="#" class="btn btn-sm btn-info float-right">Berdonasi</a>
        </div>
      </div>
      <div class="card-body pt-4">
        {{-- <div class="row">
          <div class="col">
            <div class="card-profile-stats d-flex justify-content-center">
              <div>
                <span class="heading">22</span>
                <span class="description">Friends</span>
              </div>
              <div>
                <span class="heading">10</span>
                <span class="description">Photos</span>
              </div>
              <div>
                <span class="heading">89</span>
                <span class="description">Comments</span>
              </div>
            </div>
          </div>
        </div> --}}
        <div class="text-center">
          {{-- <h5 class="h3">
            Jessica Jones<span class="font-weight-light">, 27</span>
          </h5>
          <div class="h5 font-weight-300">
            <i class="ni location_pin mr-2"></i>Bucharest, Romania
          </div> --}}
          <div>
            <i class="ni education_hat mr-2"></i>Pembangunan Pondok Pesantren Darul Majid di Kuningan Jawa Barat
          </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Penggalang Dana - Alan Suryawijaya
                </div>
        </div>
      </div>
    </div>
  </div>
  @endfor
  @for ($i = 0; $i < 2; $i++)
  <div class="col-xl-6 order-xl-1">
    <div class="card card-profile">
      <img src="img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">

      <div class="card-header text-center border-0 pt-4 pt-md-2 pb-0 pb-md-4">
        <div class="progress-wrapper mb-4">
          <div class="progress-info">
            <div class="progress-label">
              <span>28 hari lagi</span>
            </div>
            <div class="progress-percentage">
              <span>Rp. 26.000.000</span>
            </div>
          </div>
          <div class="progress">
            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <a href="#" class="btn btn-sm btn-default">Lelang Barang</a>
          <a href="#" class="btn btn-sm btn-info float-right">Berdonasi</a>
        </div>
      </div>
      <div class="card-body pt-4">
        {{-- <div class="row">
          <div class="col">
            <div class="card-profile-stats d-flex justify-content-center">
              <div>
                <span class="heading">22</span>
                <span class="description">Friends</span>
              </div>
              <div>
                <span class="heading">10</span>
                <span class="description">Photos</span>
              </div>
              <div>
                <span class="heading">89</span>
                <span class="description">Comments</span>
              </div>
            </div>
          </div>
        </div> --}}
        <div class="text-center">
          {{-- <h5 class="h3">
            Jessica Jones<span class="font-weight-light">, 27</span>
          </h5>
          <div class="h5 font-weight-300">
            <i class="ni location_pin mr-2"></i>Bucharest, Romania
          </div> --}}
          <div>
            <i class="ni education_hat mr-2"></i>Pembangunan Pondok Pesantren Darul Majid di Kuningan Jawa Barat
          </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Penggalang Dana - Alan Suryawijaya
                </div>
        </div>
      </div>
    </div>
  </div>
  @endfor

  @for ($i = 0; $i < 3; $i++)
  <div class="col-xl-4 order-xl-3">
    <div class="card card-profile">
      <img src="img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">

      <div class="card-header text-center border-0 pt-4 pt-md-2 pb-0 pb-md-4">
        <div class="progress-wrapper mb-4">
          <div class="progress-info">
            <div class="progress-label">
              <span>28 hari lagi</span>
            </div>
            <div class="progress-percentage">
              <span>Rp. 26.000.000</span>
            </div>
          </div>
          <div class="progress">
            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <a href="#" class="btn btn-sm btn-default">Lelang Barang</a>
          <a href="#" class="btn btn-sm btn-info float-right">Berdonasi</a>
        </div>
      </div>
      <div class="card-body pt-4">
        {{-- <div class="row">
          <div class="col">
            <div class="card-profile-stats d-flex justify-content-center">
              <div>
                <span class="heading">22</span>
                <span class="description">Friends</span>
              </div>
              <div>
                <span class="heading">10</span>
                <span class="description">Photos</span>
              </div>
              <div>
                <span class="heading">89</span>
                <span class="description">Comments</span>
              </div>
            </div>
          </div>
        </div> --}}
        <div class="text-center">
          {{-- <h5 class="h3">
            Jessica Jones<span class="font-weight-light">, 27</span>
          </h5>
          <div class="h5 font-weight-300">
            <i class="ni location_pin mr-2"></i>Bucharest, Romania
          </div> --}}
          <div>
            <i class="ni education_hat mr-2"></i>Pembangunan Pondok Pesantren Darul Majid di Kuningan Jawa Barat
          </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Penggalang Dana - Alan Suryawijaya
                </div>
        </div>
      </div>
    </div>
  </div>
  @endfor

</div>
@endsection
