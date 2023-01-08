@extends('admin.layouts.app')
@section('title')
    Rekap Gizi Ibu Hamil
@endsection
@section('content')
    <div class="row">
        @include('admin.notification')
        @livewire('admin.rekap-bumil')
    </div>
@endsection
