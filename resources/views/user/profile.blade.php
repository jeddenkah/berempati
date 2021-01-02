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
@include('layouts.plugin.dataTable-css')
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
            <div class="col-12">
                <div class="nav-wrapper">
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0  active" id="profile-tab" data-toggle="tab"
                                href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i
                                    class="ni ni-bell-55 mr-2"></i>Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="crowdfund-tab" data-toggle="tab" href="#crowdfund"
                                role="tab" aria-controls="crowdfund" aria-selected="true"><i
                                    class="ni ni-atom mr-2"></i>Galang Dana</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="auction-tab" data-toggle="tab" href="#auction"
                                role="tab" aria-controls="auction" aria-selected="false"><i
                                    class="ni ni-calendar-grid-58 mr-2"></i>Lelang</a>
                        </li>
                    </ul>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                aria-labelledby="profile-tab">
                                <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <!-- Address -->
                                    <div class="pl-lg-2">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-name">Name</label>
                                                    <input id="input-name" class="form-control" name="name"
                                                        placeholder="Name" type="text" value="{{ Auth::user()->name }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-email">Email</label>
                                                    <input id="input-email" class="form-control" name="email"
                                                        placeholder="Email" type="email"
                                                        value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-no_hp">Phone
                                                        Number</label>
                                                    <input id="input-no_hp" class="form-control" name="no_hp"
                                                        placeholder="Phone Number" type="number"
                                                        value="{{ Auth::user()->no_hp }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-address">Address
                                                        (Optional)</label>
                                                    <textarea name="address" class="form-control" id="input-address"
                                                        rows="5">{{ Auth::user()->address }}</textarea>
                                                </div>
                                            </div>
                                        </div>


                                    </div>


                                    <hr class="my-4" />
                                    <button type="submit" class="btn btn-primary float-right ml-3">Update</button>
                                    <a href="{{ route('user.profile') }}"
                                        class="btn btn-secondary float-right">Cancel</a>
                                </form>
                                <h2 class="mt-9">Ubah Password</h2>
                                <hr class="my-2" />
                                <form action="{{ route('user.changePassword') }}" class="mt-4" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <!-- Address -->
                                    <div class="pl-lg-2">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-old-password">Password
                                                        Lama</label>
                                                    <input id="input-old-password" class="form-control"
                                                        name="old_password" placeholder="Password Lama" type="password"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-old-password">Password
                                                        Baru</label>
                                                    <input id="input-old-password" class="form-control"
                                                        name="new_password" placeholder="Password Baru" type="password"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="input-old-password">Konfirmasi Password Baru</label>
                                                    <input id="input-old-password" class="form-control"
                                                        name="confirm_new_password"
                                                        placeholder="Konfirmasi Password Baru" type="password" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <hr class="my-4" />
                                    <button type="submit" class="btn btn-primary float-right ml-3">Change
                                        Password</button>
                                    <a href="{{ route('user.profile') }}"
                                        class="btn btn-secondary float-right">Cancel</a>
                                </form>

                            </div>

                            <div class="tab-pane fade " id="crowdfund" role="tabpanel" aria-labelledby="crowdfund-tab">

                                <a class="btn btn-primary btn-sm shadow float-right" href="{{ route('crowdfund.createUser') }}"><i
                                    class="fas fa-plus"></i></a>
                                <h3 class="text-muted">Daftar Galang Dana Saya</h3>
                                <div class="table-responsive">
                                    <table class="table align-items-center dataTable table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name">Name</th>
                                                <th scope="col" class="sort" data-sort="status">Target Nominal</th>
                                                <th scope="col" class="sort" data-sort="completion">Target Date</th>
                                                <th scope="col" class="sort" data-sort="status">Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach (Auth::user()->crowdfunds as $crowdfund)
                                            <tr>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <a href="{{ route('crowdfund.showUser', $crowdfund->id) }}"><span
                                                                    class="name mb-0 text-sm">{{ $crowdfund->name }}</span></a>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td class="budget">
                                                    Rp. {{ number_format($crowdfund->target_nominal,0,",",".")}}
                                                </td>
                                                <td>
                                                    {{ $crowdfund->target_date }}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="completion mr-2">{{$crowdfund->totalDonationPercentage()}}%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-warning" role="progressbar"
                                                                    aria-valuenow="{{$crowdfund->totalDonationPercentage()}}"
                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                    style="width: {{$crowdfund->totalDonationPercentage()}}%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <small>Terkumpul Rp.
                                                        {{ number_format($crowdfund->totalDonation(),0,",",".") }}</small>

                                                </td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#"
                                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div
                                                            class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            
                                                                <a class="dropdown-item"
                                                                    href="{{ route('crowdfund.editUser', $crowdfund->id) }}">Edit</a>
                                                                
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                <h2 class="text-muted mt-6">Daftar Donasi Saya</h2>
                                <div class="table-responsive">
                                    <table class="table align-items-center dataTable table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name">Galang Dana</th>
                                                <th scope="col" class="sort" data-sort="status">Nominal</th>
                                                <th scope="col" class="sort" data-sort="status">Message</th>
                                                <th scope="col" class="sort" data-sort="completion">Is Anonym</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach (Auth::user()->donations as $donation)
                                            <tr>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <a
                                                                href="{{ route('crowdfund.showUser', $donation->crowdfund->id) }}"><span
                                                                    class="name mb-0 text-sm">{{ $donation->crowdfund->name }}</span></a>
                                                        </div>
                                                    </div>
                                                </th>

                                                <td class="budget">
                                                    Rp. {{ number_format($donation->nominal,0,",",".") }}
                                                </td>
                                                <td>
                                                    {{ $donation->message }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-pill {{$donation->is_anonym ? 'badge-primary':'badge-secondary'}}">{{$donation->is_anonym ? 'Yes':'No'}}</span>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="auction" role="tabpanel" aria-labelledby="auction-tab">

                                <h3 class="text-muted">Daftar Lelang Saya</h3>
                                <div class="table-responsive">
                                    <table class="table align-items-center dataTable table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="sort">Name</th>
                                                <th scope="col" class="sort">Image</th>
                                                <th scope="col" class="sort">Description</th>
                                                <th scope="col" class="sort">Start Nominal</th>
                                                <th scope="col" class="sort">Target Date</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach (Auth::user()->auctions as $auction)
                                            <tr>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <a href="{{ route('auction.show', $auction->id) }}"><span
                                                                    class="name mb-0 text-sm">{{ $auction->name }}</span></a>
                                                        </div>
                                                    </div>
                                                </th>

                                                <td class="text-center">
                                                    <img src="{{ asset('storage/images/auction/'.$auction->image) }}"
                                                        style="max-height: 100px" class="img-responsive" alt="">
                                                </td>
                                                <td>
                                                    {{ $auction->desc }}
                                                </td>
                                                <td class="budget">
                                                    Rp. {{ number_format($auction->start_nominal,0,",",".")  }}
                                                </td>
                                                <td>
                                                    {{ $auction->target_date }}
                                                </td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#"
                                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div
                                                            class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        
                                                                <a class="dropdown-item"
                                                                    href="{{ route('auction.editUser', [$auction->id]) }}">Edit</a>
                                                                
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                <h3 class="text-muted mt-6">Daftar Bid Saya</h3>
                                <div class="table-responsive">
                                    <table class="table align-items-center dataTable table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name">Galang Dana</th>
                                                <th scope="col" class="sort" data-sort="status">Nominal</th>
                                                <th scope="col" class="sort" data-sort="status">Description</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach (Auth::user()->bids as $bid)
                                            <tr>
                                                <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <a
                                                                href="{{ route('auction.showUser', $bid->auction->id) }}"><span
                                                                    class="name mb-0 text-sm">{{ $bid->auction->name }}</span></a>
                                                        </div>
                                                    </div>
                                                </th>

                                                <td class="budget">
                                                    Rp. {{ number_format($bid->nominal,0,",",".") }}
                                                </td>
                                                <td>
                                                    {{ $bid->desc }}
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
@include('layouts.plugin.dataTable-js')
@endpush