@extends('layouts.dashboard.main')

@section('header')
<div class="header-body">
    <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Bid</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Admin</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('crowdfund.index')}}">Crowdfund</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('crowdfund.show', $bid->auction->crowdfund->id)}}">{{ $bid->auction->crowdfund->name }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('auction.show', $bid->auction->id)}}">{{ $bid->auction->name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Bid</li>
                </ol>
            </nav>
        </div>

    </div>
    <!-- Card stats -->

</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="card shadow">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Edit Bid</h3>
                    </div>
                </div>
            </div>
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
            <div class="card-body">
                <form action="{{ route('auction.bid.update', [$bid->auction->id, $bid->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <!-- Address -->
                    <div class="pl-lg-2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nominal">Nominal</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" id="input-nominal" class="form-control" name="nominal"
                                            placeholder="Nominal" value="{{ $bid->nominal }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-desc">Description (Optional)</label>
                                    <textarea name="desc" class="form-control" id="input-desc"
                                        rows="5">{{ $bid->desc }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>


                    <hr class="my-4" />
                    <button type="submit" class="btn btn-primary float-right ml-3">Submit</button>
                    <a href="{{ route('auction.show', $bid->auction->id) }}" class="btn btn-secondary float-right">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
