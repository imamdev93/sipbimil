@extends('admin.layouts.app')
@section('title')
    Dashboard
@endsection
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
                    <div class="widget style1 blue-bg">
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
                                <h5>Total Balita Normal</h5>
                                <h2 class="font-bold" style="font-size: 20px">{{ $balitaNormal }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 navy-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-child fa-4x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <h5>Total Balita Gemuk</h5>
                                <h2 class="font-bold" style="font-size: 20px">{{ $balitaGemuk }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 blue-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-female fa-4x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <h5>Total Ibu Hamil Normal</h5>
                                <h2 class="font-bold" style="font-size: 20px">{{ $bumilNormal }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 blue-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-female fa-4x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <h5>Total Ibu Hamil Kurus</h5>
                                <h2 class="font-bold" style="font-size: 20px">{{ $bumilKurus }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 navy-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-child fa-4x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <h5>Total Balita Sangat Kurus</h5>
                                <h2 class="font-bold" style="font-size: 20px">{{ $balitaSangatKurus }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 navy-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-child fa-4x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <h5>Total Balita Kurus</h5>
                                <h2 class="font-bold" style="font-size: 20px">{{ $balitaKurus }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 blue-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-female fa-4x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <h5>Total Ibu Hamil Gemuk</h5>
                                <h2 class="font-bold" style="font-size: 20px">{{ $bumilGemuk }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 blue-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-female fa-4x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <h5>Total Ibu Hamil Obase I</h5>
                                <h2 class="font-bold" style="font-size: 20px">{{ $bumilObase1 }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                </div>
                <div class="col-lg-3">
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 blue-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-female fa-4x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <h5>Total Ibu Hamil Obase II</h5>
                                <h2 class="font-bold" style="font-size: 20px">{{ $bumilObase2 }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
