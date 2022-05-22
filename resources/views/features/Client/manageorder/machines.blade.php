@extends('features.Client.manageorderindividual')
@section('title', 'Manage Order | Machines')
@section('manage-order-content')
    <div class="row row-cols-1 row-cols-md-3">
        <div class="col mb-4">
            <div class="card h-100 bg-success text-white">
                <div class="card-body ">
                    <h2 class="card-title d-flex justify-content-center align-items-center">D1</h2>
                    <div class="card-footer text-center" style="background-color: transparent;"><span
                            class="badge badge-success">Available</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100 bg-danger text-white">
                <div class="card-body">
                    <h2 class="card-title d-flex justify-content-center align-items-center">D2</h2>
                    <div class="card-footer text-center" style="background-color: transparent;"><span
                            class="badge badge-danger">Not
                            Available</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title d-flex justify-content-center align-items-center">D1</h2>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title d-flex justify-content-center align-items-center">D1</h2>
                </div>
            </div>
        </div>
    </div>
@endsection
