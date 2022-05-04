@extends('layouts.master')

@if (Auth::user()->user_role == 1)
    @section('title', '| Dashboard')
@else
    @section('title', '| ###')
@endif


@section('content')
    <div class="container-fluid">

        @if (Auth::user()->user_role == 1)
            @include('features.dashboard')
        @endif

    </div>
@endsection
