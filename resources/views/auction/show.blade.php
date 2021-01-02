@extends('layouts.main')
@section('title', 'Galang Dana')
@section('header')
{{-- <div class="header-body text-center mb-7">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            <h1 class="text-white">{{$crowdfund->name}}</h1>
<p class="text-lead text-white">{{$crowdfund->desc}}</p>
</div>
</div>
</div> --}}
@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('css/crowdfund.css')}}">
@endpush
@php
use Carbon\Carbon;
Carbon::setLocale('id');
@endphp
@section('content')
<div class="row justify-content-center">
    <div class="bg-white col-12 rounded">
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <div class="col-12 text-center p-5">
                <img src="{{ asset('storage/images/auction/'.$auction->image) }}" class="rounded"
                    style="max-width: 100%" alt="">
            </div>
            <div class="col-12 px-5 border-bottom">
                <p class="display-3 mb-0">{{ $auction->name }}</p>
                <div class="row mt-3">
                    <div class="col-md-12 mt-3">
                        <button type="button" class="btn btn-info btn-block" data-toggle="modal"
                            data-target="#addDonation">Bid</button>

                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="addDonation" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Bid</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('bid.storeUser', $auction->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="pl-lg-2">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label"
                                                            for="input-nominal">Nominal</label>

                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Rp</span>
                                                            </div>
                                                            <input type="number" id="input-nominal" class="form-control"
                                                                name="nominal" placeholder="Nominal"
                                                                value="{{ old('nominal') }}" required>
                                                        </div>
                                                        <small id="emailHelp" class="form-text text-muted">Saldo anda:
                                                            Rp 26.000.000</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-message">Message
                                                            (Optional)</label>
                                                        <textarea name="message" class="form-control" id="input-message"
                                                            rows="5">{{ old('message') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Bayar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 mt-5 py-2">
                        <div class="card text-center ">
                            <p class="lead">{{ $auction->desc }}</p>
                            <br>
                            <footer><small>Pelelang - {{ $auction->user->name }} <i class="{{ $auction->user->is_verified ? 'fas fa-check-circle text-primary':''}}"></i></small></footer>
                        </div>
                    </div>
                    <div class="col-md-4 mt-5 py-2">
                        <div class="card">
                            <div class="card-header">5 Top Bids</div>
                            <div class="card-body">
                                @foreach ($auction->bids->sortByDesc('nominal')->take(5) as $index=>$bid)
                                @if ($index==0)
                                <div class="card px-3 mb-4 mx-n3 py-2 text-center">
                                    <p><strong>{{$bid->user->name}}</strong></p>
                                    <h2>Rp {{number_format($bid->nominal,0,",",".")}}</h2>
                                    <p class="m-0">{{ $bid->desc}}</p>
                                </div>
                                @else
                                <div class="card px-3 mb-1 py-3">
                                    <p><strong>{{$bid->user->name}}</strong> |
                                        <span>Rp {{number_format($bid->nominal,0,",",".")}}</span></p>
                                    <p class="mt-n3">{{ $bid->desc}}</p>
                                </div>
                                @endif

                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <p class="mt-3 ml-3">Hasil Lelang ini akan didonasikan untuk</p>
            <div class="card m-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/images/crowdfund/'. $auction->crowdfund->image) }}"
                            class="card-img center-block" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title"><a href="{{ route('crowdfund.showUser', $auction->crowdfund->id)}}"
                                    class="stretched-link">{{ $auction->crowdfund->name }}</a></h3>
                            <div class="progress-wrapper mt-n4">
                                <div class="progress-info">
                                    <div class="progress-label">
                                        <span>{{$auction->crowdfund->daysLeft()}} hari lagi</span>
                                    </div>
                                    <div class="progress-percentage">
                                        <span>Rp.
                                            {{number_format($auction->crowdfund->totalDonation(),0,",",".")}}</span>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        aria-valuenow="{{$auction->crowdfund->totalDonationPercentage()}}"
                                        aria-valuemin="0" aria-valuemax="100"
                                        style="width: {{$auction->crowdfund->totalDonationPercentage()}}%;"></div>
                                </div>
                            </div>
                            <div class="h5 mb-0 mt-auto text-right">
                                <i class="ni business_briefcase-24 mr-2"></i>Penggalang Dana - {{$auction->crowdfund->user->name}} <i class="{{ $auction->crowdfund->user->is_verified ? 'fas fa-check-circle text-primary':''}}"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
