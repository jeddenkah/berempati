@extends('layouts.dashboard.main')

@section('header')
<div class="header-body">
    <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Auction</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Admin</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('crowdfund.index')}}">Crowdfund</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('crowdfund.show', $auction->crowdfund->id)}}">{{ $auction->crowdfund->name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Auction</li>
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
                        <h3 class="mb-0">Update Auction</h3>
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
                <form action="{{ route('auction.update', $auction->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <!-- Address -->
                    <div class="pl-lg-2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">Name</label>
                                    <input id="input-name" class="form-control" name="name"
                                        placeholder="Name" type="text" value="{{ $auction->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-description">Description</label>
                                    <textarea name="description" class="form-control" id="input-description"
                                        rows="5">{{ $auction->desc }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-image">Image (Kosongkan jika tidak diganti)</label>
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
                                            placeholder="Nominal" value="{{ $auction->start_nominal }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-target-date" class="form-control-label">Target Date</label>
                                    <input class="form-control" type="date" name="target_date" id="input-target-date" value="{{ date('Y-m-d', strtotime($auction->target_date)) }}">
                               
                                </div>
                                
                            </div>
                        </div>

                    </div>


                    <hr class="my-4" />
                    <button type="submit" class="btn btn-primary float-right ml-3">Submit</button>
                    <a href="{{ route('crowdfund.show', $auction->crowdfund->id) }}" class="btn btn-secondary float-right">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
