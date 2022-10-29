@extends('admin.layouts.app')
@section('title') Dashboard @endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-child fa-4x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <h5>Total Balita</h5>
                            <h2 class="font-bold" style="font-size: 20px">{{ $balita }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-female fa-4x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <h5>Total Ibu Hamil</h5>
                            <h2 class="font-bold" style="font-size: 20px">{{ $ibuhamil }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-child fa-4x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <h5>Total Balita Gizi Baik</h5>
                            <h2 class="font-bold" style="font-size: 20px">{{ $balita }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 red-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-child fa-4x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <h5>Total Balita Gizi Buruk</h5>
                            <h2 class="font-bold" style="font-size: 20px">{{ $balita }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-female fa-4x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <h5>Ibu Hamil Gizi Baik</h5>
                            <h2 class="font-bold" style="font-size: 20px">{{ $balita }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 red-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-female fa-4x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <h5>Ibu Hamil Gizi Buruk</h5>
                            <h2 class="font-bold" style="font-size: 20px">{{ $balita }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
