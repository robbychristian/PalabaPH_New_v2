@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-flex justify-content-center font-weight-bold h3" style="color: #000">
            Inventory Management
        </div>
        @foreach ($laundries as $laundry)
            <div class="d-flex justify-content-center align-items-center">
                <div class="row w-100">
                    <div class="col-xs-12 col-md-5 card p-2">
                        <form action="/additem" method="POST" id="formItem">
                            @csrf
                            @method('POST')
                            <div class="d-flex justify-content-center">
                                <div class="h5 text-dark">Add an item</div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center my-3">
                                <div class="p mx-2">Description: </div>
                                <div class="d-flex mx-2 justify-content-center align-items-center">

                                    <input type="text" name="item_name" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center my-3">
                                <div class="d-flex justify-content-left mx-2">

                                    <div class="p mx-2">Quantity: </div>
                                </div>
                                <div class="d-flex mx-2 justify-content-right align-items-center flex-column">
                                    <input type="text" name="item_quantity" id="quantity"
                                        class="form-control form-control-sm">
                                    {{-- <span class="text-danger" id="quantityError" style="font-size: 10px">Quantity should be
                                    higher than
                                    threshold</span> --}}
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center my-3">
                                <div class="p mx-2">Threshold: </div>
                                <div class="d-flex mx-2 justify-content-center align-items-center">

                                    <input type="text" id="threshold" name="item_threshold"
                                        class="form-control form-control-sm">
                                    <input type="text" id="threshold" name="laundry_id" value="{{ $laundry->id }}"
                                        class="form-control form-control-sm d-none">
                                </div>
                            </div>

                            <div class="d-flex justify-content-center align-items-center my-3">
                                <button type="button" class="btn btn-primary w-50" id="submitbtn">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-12 col-md-7 d-flex justify-content-center">
                        asdad
                    </div>
                </div>
            </div>
        @endforeach
        <script src="{{ asset('js/inventorymanagement.js') }}"></script>
    </div>
@endsection
