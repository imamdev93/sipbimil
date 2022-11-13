@extends('admin.layouts.app')
@section('title') Gizi Ibu Hamil @endsection
@section('content')
<div class="row">
    @include('admin.notification')
    @livewire('admin.gizi-ibu-hamil-create')
</div>
@endsection

