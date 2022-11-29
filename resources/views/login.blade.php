@extends('layouts.app')
@section('title')
    Login
@endsection
@section('content')
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="box-wrapper">
            <div class="container">
                @include('admin.notification')
                <div class="row">
                    <div class="col-12">
                        <div class="container text-center">
                            <h2 class="title">Halaman Login</h2>
                            <form class="default-form-group" action="/login" method="post">
                                @csrf
                                <div class="row mb-n20">
                                    <div class="col-12 mb-20">
                                        <!-- Start From Group SingleI tem  -->
                                        <div class="default-form-group-single-item border-white">
                                            <input type="text" placeholder="Masukan Username" name="username" required>
                                        </div>
                                        <!-- End From Group SingleItem  -->
                                    </div>
                                    <div class="col-12 mb-20">
                                        <!-- Start From Group SingleI tem  -->
                                        <div class="default-form-group-single-item border-white">
                                            <input type="password" placeholder="Masukan Password" name="password" required>
                                        </div>
                                        <!-- End From Group SingleItem  -->
                                    </div>
                                </div>
                                <div class="submit-btn text-center">
                                    <button type="submit" class="btn btn-lg btn-default btn-animate icon-space-left"><span>
                                            Login
                                            <i class="icofont-double-right"></i></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
