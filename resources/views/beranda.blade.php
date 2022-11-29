@extends('layouts.app')
@section('title')
    Beranda
@endsection
@section('content')
    <!-- ...::: Start Hero Section :::... -->
    <div class="hero-section hero-display hero-bg">
        <div class="box-wrapper">
            <div class="container">
                <div class="row align-items-center flex-column-reverse flex-md-row">
                    <div class="col-12 col-md-6">
                        <!-- Start Hero Content -->
                        <div class="hero-content">
                            <h2 class="title highlight">Selamat Datang di</h2>
                            <h2 class="title">Monitoring Perkembangan Balita dan Ibu Hamil</h2>
                            {{-- <a href="/dashboard" class="btn btn-lg btn-default btn-animate icon-space-left"><span>Pantau
                                    Perkembangan <i class="icofont-doctor-alt"></i></span></a> --}}
                        </div>
                        <!-- End Hero Content -->
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Start Hero Image -->
                        <div class="hero-image-1">
                            <img class="animate-top-bottom" src="assets/images/background/hero-bg-1.png" alt="">
                        </div>
                        <!-- End Hero Image -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ...::: Start Essential Display Section :::... -->
    <div class="essential-section section-inner-padding-200 section-fluid-100 section-inner-bg">
        <div class="box-wrapper">
            <div class="container-fluid">
                <h2 style="text-align: center">Kalkulasi Data Ibu Hamil dan Balita</h2><br>
                <div class="row">
                    <div class="col-12">
                        <!-- .Start Circle Progress Bar -->
                        <div class="circle-progress-bar">
                            <div class="row d-flex justify-content-between mb-n40">
                                <div class="col-md-6 col-sm-6 col-6 mb-40">

                                    <!-- Start Progress Bar Single Item-->
                                    <div class="circle-single-progress-bar blue">
                                        <svg class="radial-progress" data-percentage="100" viewBox="0 0 80 80">
                                            <circle class="incomplete" cx="40" cy="40" r="35">
                                            </circle>
                                            <circle class="complete" cx="40" cy="40" r="35"
                                                style="stroke-dashoffset: 39.58406743523136;">
                                            </circle>
                                            <text class="percentage" x="50%" y="57%"
                                                transform="matrix(0, 1, -1, 0, 80, 0)">{{ $totalIbuHamil }}</text>
                                        </svg>
                                        <span class="outer-text">Total Ibu Hamil</span>
                                    </div>
                                    <!-- End Progress Bar Single Item-->

                                </div>
                                <div class="col-md-6 col-sm-6 col-6 mb-40">

                                    <!-- Start Progress Bar Single Item-->
                                    <div class="circle-single-progress-bar cyan">
                                        <svg class="radial-progress" data-percentage="100" viewBox="0 0 80 80">
                                            <circle class="incomplete" cx="40" cy="40" r="35">
                                            </circle>
                                            <circle class="complete" cx="40" cy="40" r="35"
                                                style="stroke-dashoffset: 39.58406743523136;">
                                            </circle>
                                            <text class="percentage" x="50%" y="57%"
                                                transform="matrix(0, 1, -1, 0, 80, 0)">{{ $totalBalita }}</text>
                                        </svg>
                                        <span class="outer-text">Total Balita</span>
                                    </div>
                                    <!-- End Progress Bar Single Item-->

                                </div>
                                @foreach ($totalIbuHamilByStatus as $bumil)
                                    <div class="col-md-3 col-sm-4 col-6 mb-40">
                                        <!-- Start Progress Bar Single Item-->
                                        <div class="circle-single-progress-bar blue">
                                            <svg class="radial-progress"
                                                data-percentage="{{ ($bumil->total / $totalIbuHamil) * 100 }}"
                                                viewBox="0 0 80 80">
                                                <circle class="incomplete" cx="40" cy="40" r="35">
                                                </circle>
                                                <circle class="complete" cx="40" cy="40" r="35"
                                                    style="stroke-dashoffset: 39.58406743523136;">
                                                </circle>
                                                <text class="percentage" x="50%" y="57%"
                                                    transform="matrix(0, 1, -1, 0, 80, 0)">{{ $bumil->total }}</text>
                                            </svg>
                                            <span class="outer-text">
                                                {{ $bumil->status ? 'Ibu Hamil ' . $bumil->status : 'Gizi Ibu Hamil Belum diketahui' }}
                                            </span>
                                        </div>
                                        <!-- End Progress Bar Single Item-->

                                    </div>
                                @endforeach
                                @foreach ($totalBalitaByStatus as $balita)
                                    <div class="col-md-3 col-sm-4 col-6 mb-40">
                                        <!-- Start Progress Bar Single Item-->
                                        <div class="circle-single-progress-bar cyan">
                                            <svg class="radial-progress"
                                                data-percentage="{{ ($balita->total / $totalBalita) * 100 }}"
                                                viewBox="0 0 80 80">
                                                <circle class="incomplete" cx="40" cy="40" r="35">
                                                </circle>
                                                <circle class="complete" cx="40" cy="40" r="35"
                                                    style="stroke-dashoffset: 39.58406743523136;">
                                                </circle>
                                                <text class="percentage" x="50%" y="57%"
                                                    transform="matrix(0, 1, -1, 0, 80, 0)">
                                                    {{ $balita->total }}</text>
                                            </svg>
                                            <span class="outer-text">
                                                {{ $balita->status ? 'Balita ' . $balita->status : 'Gizi Balita Belum diketahui' }}</span>
                                        </div>
                                        <!-- End Progress Bar Single Item-->

                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- .End CircleProgress Bar -->
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ...::: End Essential Display Section :::... -->
@endsection
