@extends('layouts.master')

@if (Auth::user()->user_role == 1)
    @section('title', '| Client Management')
@else
    @section('title', '| ###')
@endif

@section('content')
    <div class="container-fluid">

        <div class="back mb-4">
            <a href="{{ route('admin.clientmanagement.index') }}" class="text-gray-900" style="text-decoration: none;">
                <i class="fas fa-chevron-left"></i> Back</a>

        </div>


        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Client Management</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-end">
                <div class="registration-actions">


                    <button class="btn btn-sm btn-success">Approve</button>
                    <button class="btn btn-sm btn-danger">Deny</button>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <h1 class="h5 mb-3 text-gray-800">Laundry Owner Details</h1>

                <div class="row mb-3">
                    <div class="col-md-4"> <strong> First Name: </strong>{{ $laundries[0]->first_name }}</div>
                    <div class="col-md-4"> <strong> Middle Name: </strong> {{ $laundries[0]->middle_name }}</div>
                    <div class="col-md-4"> <strong> Last Name: </strong> {{ $laundries[0]->last_name }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4"> <strong> Cellphone Number: </strong>{{ $laundries[0]->first_name }}</div>
                    <div class="col-md-4"> <strong> Birthday: </strong> {{ $laundries[0]->middle_name }}</div>
                    <div class="col-md-4"> <strong> Gender: </strong> {{ $laundries[0]->last_name }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4"> <strong> Street: </strong>{{ $laundries[0]->first_name }}</div>
                    <div class="col-md-4"> <strong> Barangay: </strong> {{ $laundries[0]->middle_name }}</div>
                    <div class="col-md-4"> <strong> City: </strong> {{ $laundries[0]->last_name }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"> <strong> State/Province: </strong>{{ $laundries[0]->first_name }}</div>

                    <div class="col-md-4"> <strong> Country: </strong> {{ $laundries[0]->last_name }}</div>
                </div>
            </div>
        </div>

    </div>
@endsection
