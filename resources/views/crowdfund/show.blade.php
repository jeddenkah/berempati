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
                <img src="{{ asset('storage/images/crowdfund/'.$crowdfund->image) }}" class="rounded"
                    style="max-width: 100%" alt="">
            </div>
            <div class="col-12 px-5">
                <p class="display-3 mb-0">{{ $crowdfund->name }}</p>
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
                        <div class="progress-bar bg-info" role="progressbar"
                            aria-valuenow="{{$crowdfund->totalDonationPercentage()}}" aria-valuemin="0"
                            aria-valuemax="100" style="width: {{$crowdfund->totalDonationPercentage()}}%;"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 mt-3">
                        <a href="{{ route('auction.createUser', $crowdfund->id) }}"
                            class="btn btn-default btn-block">Lelang Barang</a>
                    </div>
                    <div class="col-md-6 mt-3">
                        <button type="button" class="btn btn-info btn-block" data-toggle="modal"
                            data-target="#addDonation">Berdonasi</button>

                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="addDonation" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Berdonasi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('donation.storeUser', $crowdfund->id) }}" method="POST"
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
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label"
                                                            for="input-message">Anonym?</label>
                                                        <br>
                                                        <label class="custom-toggle">
                                                            <input type="checkbox" name="is_anonym" value="1">
                                                            <span class="custom-toggle-slider rounded-circle"
                                                                data-label-off="No" data-label-on="Yes"></span>
                                                        </label>
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
                <div class="card text-center mt-5 py-2">
                    <p class="lead">{{ $crowdfund->desc }}</p>
                    <br>
                    <footer><small>Penggalang Dana - {{ $crowdfund->user->name }} <i class="{{ $crowdfund->user->is_verified ? 'fas fa-check-circle text-primary':''}}"></i></small></footer>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Report
                                @if (Auth::user()->id == $crowdfund->user_id)
                                <button type="button" class="btn btn-primary btn-sm shadow float-right"
                                data-toggle="modal"
                                data-target="#addReport""><i
                                        class="fas fa-plus"></i></button>
                                @endif
                                
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-11">

                                        <!-- Timeline -->
                                        <ul class="timeline">
                                            @foreach ($crowdfund->reports->reverse() as $report)

                                            <li class="timeline-item bg-white rounded ml-3 p-4 shadow">
                                                <div class="timeline-arrow"></div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <img src="{{ asset('/storage/images/report/'.$report->image) }}"
                                                            class="w-100" alt="">
                                                    </div>

                                                    <div class="col-md-8">
                                                        <span class="small text-gray">
                                                            <i
                                                                class="fa fa-clock-o mr-1"></i>{{ Carbon::parse($report->datetime)->isoFormat('dddd, D MMMM Y')}}
                                                        </span>
                                                        <p class="text-small mt-2 font-weight-light">{{$report->desc}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul><!-- End -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->id == $crowdfund->user_id)
                        <!-- Modal Report-->
                        <div class="modal fade" id="addReport" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Add Report</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('report.storeUser', $crowdfund->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="pl-lg-2">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-image">Image</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="image" id="input-image" lang="en">
                                                                <label class="custom-file-label" for="customFileLang">Select file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-description">Description</label>
                                                            <textarea name="description" class="form-control" id="input-description"
                                                                rows="5">{{ old('description') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="input-target-date" class="form-control-label">Date</label>
                                                            <input class="form-control" type="datetime-local" name="datetime" id="input-target-date" value="{{ old('datetime') }}" max="{{ date('Y-m-d\TH:i') }}" >
                                                       
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                        
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add Report</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Donatur</div>
                            <div class="card-body">
                                @foreach ($crowdfund->donations->take(-5)->reverse() as $donation)
                                <div class="card mb-2 px-3 py-2">
                                    <p><strong>{{$donation->is_anonym ? 'Anonym':$donation->user->name}}</strong> |
                                        <span>Rp {{number_format($donation->nominal,0,",",".")}}</span></p>
                                    <p class="m-0">{{ $donation->message}}</p>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 px-5">
                <div class="card">
                    <div class="card-header">Barang Lelang</div>
                    <div class="card-body row">
                        @foreach ($crowdfund->auctions as $auction)
                        <div class="col-md-3">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset('storage/images/auction/'.$auction->image) }}"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title"><a href="{{ route('auction.showUser', $auction->id) }}"
                                            class="stretched-link">{{$auction->name}}</a></h4>
                                    <p class="card-text">Rp. {{number_format($auction->topBid(),0,",",".")}}</p>
                                    <span class="badge badge-pill badge-primary float-right">{{$auction->daysLeft()}}
                                        HARI LAGI</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
