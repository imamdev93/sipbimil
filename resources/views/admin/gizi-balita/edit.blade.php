@extends('admin.layouts.app')
@section('title') Gizi Balita @endsection
@section('content')
<div class="row">
    @include('admin.notification')
    @livewire('admin.gizi-balita-update', ['gizi_balita' => $balita])
</div>
@endsection

