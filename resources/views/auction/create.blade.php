@extends('layouts.main')
@section('title', 'Galang Dana')
@section('header')
<div class="header-body text-center mb-7">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            <h1 class="text-white">Mulai Lelang!</h1>
            {{-- <p class="text-lead text-white">{{$crowdfund->desc}}</p> --}}
        </div>
    </div>
</div>
@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('css/crowdfund.css')}}">
@endpush
@section('content')
<div class="row justify-content-center">
    <div class="bg-white col-12 rounded">
        <div class="row px-3 py-5">
            <div class="col-lg-4">
                <div class="card card-profile shadow">
                    <img src="{{ asset('storage/images/crowdfund/'.$crowdfund->image) }}" alt="Image placeholder"
                        class="card-img-top" height="200px">

                    <div class="card-header text-center border-0 pt-4 pt-md-2 pb-0 pb-md-4">
                        <h2 class="mb-0"><a href="{{ route('crowdfund.showUser', $crowdfund->id)}}"
                                class="stretched-link">{{ $crowdfund->name }}</a></h2>
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
                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="60"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            </div>
                        </div>

                    </div>
                    <div class="h5 mb-3 mt-auto text-center">
                        <i class="ni business_briefcase-24 mr-2"></i>Penggalang Dana - {{$crowdfund->user->name}}
                    </div>
                </div>
            </div>

            
            <div class="col-lg-8">
                <form action="{{ route('auction.storeUser', $crowdfund->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-control-label" for="input-name">Nama Barang</label>
                            <input id="input-name" class="form-control" name="name" placeholder="Nama Barang" type="text"
                                value="{{ old('name') }}">
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
                            <label class="form-control-label" for="input-image">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="input-image" lang="en">
                                <label class="custom-file-label" for="customFileLang">Select file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-start-nominal">Start Nominal</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" id="input-start-nominal" class="form-control" name="start_nominal"
                                    placeholder="Nominal" value="{{ old('start_nominal') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="input-target-date" class="form-control-label">Target Date</label>
                            <input class="form-control" type="date" name="target_date" id="input-target-date"
                                value="{{ old('target_date') }}">
                        </div>
                    </div>
                </div>
                <hr class="my-4" />
                <button type="submit" class="btn btn-primary float-right ml-3">Submit</button>
                <a href="{{ route('crowdfund.showUser', $crowdfund->id) }}" class="btn btn-secondary float-right">Cancel</a>
            </form>
            </div>
        </div>

    </div>
</div>
</div>
@endsection
