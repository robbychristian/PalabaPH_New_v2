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
                <div class="registration-actions d-flex flex-row">

                    <form action="/clientmanagement/{{ $laundries[0]->id }}/accept" method="POST">
                        @csrf
                        @method('post')
                        <button class="btn btn-sm btn-success mr-3">Approve</button>
                    </form>
                    <form action="/clientmanagement/{{ $laundries[0]->id }}/decline" method="POST">
                        @csrf
                        @method('post')
                        <button class="btn btn-sm btn-danger">Deny</button>
                    </form>
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
                    <div class="col-md-6"> <strong> Cellphone Number: </strong>{{ $laundries[0]->phone }}</div>
                    <div class="col-md-6"> <strong> Landline Number: </strong>{{ $laundries[0]->landline }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4"> <strong> Street: </strong>{{ $laundries[0]->street }}</div>
                    <div class="col-md-4"> <strong> Barangay: </strong>
                        {{ Str::substr($laundries[0]->barangay, 9) }}</div>
                    <div class="col-md-4"> <strong> City: </strong> {{ Str::substr($laundries[0]->city, 6) }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"> <strong> State/Province:
                        </strong>{{ Str::substr($laundries[0]->state, 4) }}</div>

                    <div class="col-md-4"> <strong> Region: </strong> {{ Str::substr($laundries[0]->region, 2) }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="d-flex flex-column">
                            <div class="h6">
                                BIR
                            </div>
                            <img src="{{  }}" alt="" srcset="" style="height: 100px; width: 100px">
                        </div>
                    </div>

                    <div class="col-md-6">Photo</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">Photo</div>

                    <div class="col-md-6">Photo</div>
                </div>
            </div>
        </div>

    </div>
@endsection
