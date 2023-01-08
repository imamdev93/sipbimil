@extends('admin.layouts.app')
@section('title')
    Rekap Gizi Balita
@endsection
@section('content')
    <div class="row">
        @include('admin.notification')
        @livewire('admin.rekap-balita')
    </div>
@endsection
