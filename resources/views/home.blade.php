@extends('layouts.master')

@if (Auth::user()->user_role == 1)
    @section('title', '| Dashboard')
@else
    @section('title', '| Manage Your Assets')
@endif


@section('content')
    <div class="container-fluid">

        @if (Auth::user()->user_role == 1)
            @include('features.dashboard')
        @endif

        @if (Auth::user()->user_role == 2)
            @include('features.Client.managemodule')
        @endif
    </div>
@endsection
