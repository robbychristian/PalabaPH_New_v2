@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="h3 font-weight-bold text-dark">Order Management</div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
@endsection
