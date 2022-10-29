@extends('admin.layouts.app')
@section('title') Gizi Balita @endsection
@section('content')
<div class="row">
    @include('admin.notification')
    @livewire('admin.gizi-balita-create')
</div>
@endsection

