@extends('admin.layouts.app')
@section('title')
    Operator
@endsection
@section('content')
    <div class="row">
        @include('admin.notification')
        @livewire('admin.operator-index')
    </div>
@endsection
