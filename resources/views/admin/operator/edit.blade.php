@extends('admin.layouts.app')
@section('title')
    Operator
@endsection
@section('content')
    <div class="row">
        @include('admin.notification')
        @livewire('admin.operator-update', ['operator' => $operator])
    </div>
@endsection
