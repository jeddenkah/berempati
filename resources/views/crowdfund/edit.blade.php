@extends('layouts.main')
@section('title', 'Galang Dana')
@section('header')
<div class="header-body text-center mb-7">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            <h1 class="text-white">Edit Galang Dana</h1>
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
            <div class="col-lg-12">
                <form action="{{ route('crowdfund.updateUser', $crowdfund->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <!-- Address -->
                    <div class="pl-lg-2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">Nama Galang Dana</label>
                                    <input id="input-name" class="form-control" name="name"
                                        placeholder="Nama Galang Dana" type="text" value="{{ $crowdfund->name }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-description">Description</label>
                                    <textarea name="description" class="form-control" id="input-description"
                                        rows="5">{{ $crowdfund->desc }}</textarea>
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
                    </div>
                    <hr class="my-4" />
                    <!-- Address -->
                    <h6 class="heading-small text-muted mb-4">Target</h6>
                    <div class="pl-lg-4">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-address">Nominal</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Rp</span>
                                        </div>
                                        <input type="number" class="form-control" name="target_nominal" placeholder="Nominal" value="{{ $crowdfund->target_nominal }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-date" class="form-control-label">Date</label>
                                    <input class="form-control" type="date" name="target_date" id="input-date" value="{{ date('Y-m-d', strtotime($crowdfund->target_date))  }}">
                               
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <hr class="my-4" />
                    <button type="submit" class="btn btn-primary float-right ml-3">Update</button>
                    <a href="{{ route('user.profile') }}" class="btn btn-secondary float-right">Cancel</a>
                </form>
            </div>
        </div>

    </div>
</div>
</div>
@endsection
