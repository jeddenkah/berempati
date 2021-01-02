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
        <div class="col-lg-4 d-flex align-items-stretch mb-4">
            <div class="card card-profile shadow m-0">
                <img src="{{ asset('storage/images/crowdfund/'.$crowdfund->image) }}" alt="Image placeholder"
                    class="card-img-top" height="200px">

                <div class="card-header text-center border-0 pt-4 pt-md-2 pb-0 pb-md-4">
                    <h2 class="mb-0"><a href="{{ route('crowdfund.showUser', $crowdfund->id)}}" class="stretched-link">{{ $crowdfund->name }}</a></h2>
                    <div class="progress-wrapper">
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
    
                </div>
                <div class="card-body mb-4">
                    <div class="text-center">
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

    <p class="display-3 mt-5">Barang Lelang</p>
    <div class="card-deck">
        @foreach ($auctions as $auction)
        <div class="col-md-3 d-flex align-items-stretch">
            <div class="card">
                <img class="card-img-top" src="{{ asset('storage/images/auction/'.$auction->image) }}"
                    alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title"><a href="{{ route('auction.showUser', $auction->id) }}"
                            class="stretched-link">{{$auction->name}}</a></h4>
                    <p class="card-text">Rp. {{number_format($auction->topBid(),0,",",".")}}</p>
                    <span class="badge badge-pill badge-primary mb-2 mt-auto float-right">{{$auction->daysLeft()}}
                        HARI LAGI</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
