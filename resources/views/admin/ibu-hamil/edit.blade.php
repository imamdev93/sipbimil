@extends('admin.layouts.app')
@section('title') Ibu Hamil @endsection
@section('content')
<div class="row">
    @include('admin.notification')
    @livewire('admin.ibu-hamil-update', ['ibu_hamil' => $ibu_hamil])
</div>
@endsection

