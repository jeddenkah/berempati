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
    <div class="card-deck">


        @foreach($crowdfunds as $crowdfund)
        <div class="col-xl-4 order-xl-1">
            <div class="card card-profile h-100 shadow">
                <img src="{{ asset('storage/images/crowdfund/'.$crowdfund->image) }}" alt="Image placeholder"
                    class="card-img-top" height="200px">

                <div class="card-header text-center border-0 pt-4 pt-md-2 pb-0 pb-md-4">
                    <h2 class="mb-0"><a href="{{ route('crowdfund.showUser', $crowdfund->id)}}" class="stretched-link">{{ $crowdfund->name }}</a></h2>
                    <div class="progress-wrapper mb-4">
                        <div class="progress-info">
                            <div class="progress-label">
                                <span>{{$crowdfund->daysLeft()}} hari lagi</span>
                            </div>
                            <div class="progress-percentage">
                                <span>Rp. {{number_format($crowdfund->totalDonation(),0,",",".")}}</span>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="{{$crowdfund->totalDonationPercentage()}}" aria-valuemin="0"
                                aria-valuemax="100" style="width: {{$crowdfund->totalDonationPercentage()}}%;"></div>
                        </div>
                    </div>
                    {{-- <div class="d-flex justify-content-between">
                        <a href="#" class="btn btn-sm btn-default">Lelang Barang</a>
                        <a href="{{ route('crowdfund.showUser', $crowdfund->id)}}" class="btn btn-sm btn-info float-right">Berdonasi</a>
                    </div> --}}
                </div>
                <div class="card-body pt-4 mb-2 mt-auto">
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
                            <i class="ni education_hat mr-2"></i>{{$crowdfund->desc}}
                        </div>
                        
                    </div>
                    
                </div>
                <div class="h5 mb-3 mt-auto text-center">
                  <i class="ni business_briefcase-24 mr-2"></i>Penggalang Dana - {{$crowdfund->user->name}}
              </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
