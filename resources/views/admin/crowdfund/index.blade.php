@extends('layouts.dashboard.main')
@push('css')
@include('layouts.plugin.dataTable-css')
@endpush
@section('header')
<div class="header-body">
    <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Crowdfund</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="{{ route('home')}}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Crowdfund</li>
                </ol>
            </nav>
        </div>

    </div>
    <!-- Card stats -->
    {{-- <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total traffic</h5>
                            <span class="h2 font-weight-bold mb-0">350,897</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="ni ni-active-40"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                            <span class="h2 font-weight-bold mb-0">2,356</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                            <span class="h2 font-weight-bold mb-0">924</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                            <span class="h2 font-weight-bold mb-0">49,65%</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="ni ni-chart-bar-32"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <a class="btn btn-primary btn-sm shadow float-right" href="{{ route('crowdfund.create') }}"><i
                        class="fas fa-plus"></i></a>
                <h3 class="mb-0">Crowdfunds List</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table align-items-center dataTable table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Name</th>
                            <th scope="col" class="sort" data-sort="budget">Crowdfunder</th>
                            <th scope="col" class="sort" data-sort="status">Target Nominal</th>
                            <th scope="col" class="sort" data-sort="completion">Target Date</th>
                            <th scope="col" class="sort" data-sort="status">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($crowdfunds as $crowdfund)
                        <tr>
                            <th scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <a href="{{ route('crowdfund.show', $crowdfund->id) }}"><span class="name mb-0 text-sm">{{ $crowdfund->name }}</span></a>
                                    </div>
                                </div>
                            </th>
                            <td class="budget">
                              {{ $crowdfund->user->name }}
                            </td>
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
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="{{$crowdfund->totalDonationPercentage()}}"
                                                aria-valuemin="0" aria-valuemax="100" style="width: {{$crowdfund->totalDonationPercentage()}}%;"></div>
                                        </div>
                                    </div>
                                </div>
                                <small>Terkumpul Rp. {{ number_format($crowdfund->totalDonation(),0,",",".") }}</small>
                            </td>
                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                      <form action="{{ route('crowdfund.destroy', $crowdfund->id) }}" method="POST" onsubmit="return confirm('Are you sure delete this item?')">
                                        @csrf
                                        @method('delete')
                                        <a class="dropdown-item" href="{{ route('crowdfund.edit', $crowdfund->id) }}">Edit</a>
                                        <button type="submit" class="dropdown-item">Delete</button>
                                      </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
@push('js')
@include('layouts.plugin.dataTable-js')
@endpush
