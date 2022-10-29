@extends('admin.layouts.app')
@section('title') Balita @endsection
@section('content')
<div class="row">
    @include('admin.notification')
    @livewire('admin.balita-update', ['balita' => $balita])
</div>
@endsection

