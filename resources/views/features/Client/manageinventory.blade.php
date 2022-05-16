@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="back mb-4">
            <a href="{{ url('/home') }}" class="text-gray-900" style="text-decoration: none;">
                <i class="fas fa-chevron-left"></i> Back</a>
        </div>


        @if (Session::get('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-check-circle-fill mr-2" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
                <div>
                    {{ Session::get('success') }}
                </div>
            </div>
        @endif

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-900">Inventory Management</h1>

        </div>

        @foreach ($laundries as $laundry)
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <form action="/additem" method="POST" id="formItem">
                                @csrf
                                @method('POST')
                                <div class="d-flex justify-content-center">
                                    <div class="h5 text-dark font-weight-bold">Add an Item</div>
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
                    </div>
                </div>
        @endforeach

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="h5 text-dark font-weight-bold">Inventory of Stocks</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" style="color:#464646 !important; text-align:center">
                            <thead>
                                <tr>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Item Quantity</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($inventories as $inventory)
                                    <form action="/confirmquantity" method="POST" id="{{ $inventory->id }}confirm">
                                        @csrf
                                        @method('POST')
                                        <tr>
                                            <th>{{ $inventory->item_name }}</th>
                                            <td class="d-flex flex-row justify-content-center align-items-center">
                                                <button class="btn btn-sm btn-circle btn-success mr-3" type="button"
                                                    id="{{ $inventory->id }}addQuantity"><i
                                                        class="fas fa-plus"></i></button>
                                                <input type="text" name="itemQty" id="{{ $inventory->id }}itemQty"
                                                    class="form-control w-25" value="{{ $inventory->item_quantity }}">
                                                <input type="text" id="itemThreshold" class="d-none form-control w-25"
                                                    value="{{ $inventory->item_threshold }}">
                                                <input type="text" name="item_id" class="d-none form-control w-25"
                                                    value="{{ $inventory->id }}">
                                                <button class="btn btn-sm btn-circle btn-danger ml-3"
                                                    id="{{ $inventory->id }}minusQuantity" type="button"><i
                                                        class="fas fa-minus"></i></button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-circle btn-info" type="button"
                                                    id="{{ $inventory->id }}confirmQuantity"><i
                                                        class="fas fa-check"></i></button>
                                                <button class="btn btn-sm btn-circle btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    </form>
                                    <script>
                                        $(document).ready(function() {
                                            $(`#{{ $inventory->id }}addQuantity`).on("click", function() {
                                                let item{{ $inventory->id }} = Number($(`#{{ $inventory->id }}itemQty`).val());
                                                item{{ $inventory->id }} = item{{ $inventory->id }} + 1
                                                $(`#{{ $inventory->id }}itemQty`).val(item{{ $inventory->id }})
                                            });
                                            $(`#{{ $inventory->id }}minusQuantity`).on("click", function() {
                                                if (Number($(`#{{ $inventory->id }}itemQty`).val()) <= Number(
                                                        {{ $inventory->item_threshold }})) {
                                                    swal({
                                                        icon: 'error',
                                                        title: "Oops...",
                                                        text: "You cannot go below the item quantity threshold!",
                                                        buttons: false,
                                                    })
                                                } else {
                                                    let item{{ $inventory->id }} = Number($(`#{{ $inventory->id }}itemQty`).val());
                                                    item{{ $inventory->id }} = item{{ $inventory->id }} - 1
                                                    $(`#{{ $inventory->id }}itemQty`).val(item{{ $inventory->id }})
                                                }
                                            });
                                            $('#{{ $inventory->id }}confirmQuantity').on('click', function() {
                                                swal({
                                                    icon: 'warning',
                                                    title: 'Are you sure you want to confirm quantity?',
                                                    text: 'The quantity will change based on the adjusted number!',
                                                    buttons: {
                                                        cancel: 'Cancel',
                                                        true: 'OK'
                                                    }
                                                }).then(response => {
                                                    if (response === 'true') {
                                                        $('#{{ $inventory->id }}confirm').submit();
                                                    }
                                                })
                                            })
                                        })
                                    </script>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/inventorymanagement.js') }}"></script>
    </div>
@endsection
