@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-flex justify-content-center font-weight-bold h3" style="color: #000">
            Inventory Management
        </div>

        <div class="d-flex justify-content-center align-items-center">
            <div class="row w-100">
                <div class="col-xs-12 col-md-5 card p-2">
                    <div class="d-flex justify-content-center">
                        <div class="h5 text-dark">Add an item</div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center my-2">
                        <div class="p mx-2">Description: </div>
                        <div class="d-flex mx-2 justify-content-center align-items-center">

                            <input type="text" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center my-2">
                        <div class="d-flex justify-content-left mx-2">

                            <div class="p mx-2">Quantity: </div>
                        </div>
                        <div class="d-flex mx-2 justify-content-right align-items-center">

                            <input type="text" id="quantity" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center my-2">
                        <div class="p mx-2">Threshold: </div>
                        <div class="d-flex mx-2 justify-content-center align-items-center">

                            <input type="text" class="form-control form-control-sm">
                        </div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center my-2">
                        <button class="btn btn-primary w-50" id="submitbtn">Submit</button>
                    </div>
                </div>
                <div class="col-xs-12 col-md-7 d-flex justify-content-center">
                    asdad
                </div>
            </div>
        </div>
        <script src="{{ asset('js/inventorymanagement.js') }}"></script>
    </div>
@endsection
