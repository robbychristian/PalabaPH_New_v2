@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="back mb-4">
            <a href="{{ route('client.manageorder') }}" class="text-gray-900" style="text-decoration: none;">
                <i class="fas fa-chevron-left"></i> Back</a>
        </div>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Order Management</h1>

        </div>

        <div class="row">
            <div class="col-md-8">
                <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-machine-tab" data-toggle="pill" href="#pills-machine"
                            role="tab" aria-controls="pills-machine" aria-selected="true">Machines</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-services-tab" data-toggle="pill" href="#pills-services"
                            role="tab" aria-controls="pills-services" aria-selected="false">Services</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-products-tab" data-toggle="pill" href="#pills-products"
                            role="tab" aria-controls="pills-products" aria-selected="false">Products</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    {{-- ==================================================== MACHINES TAB ==================================================== --}}
                    {{-- ==================================================== MACHINES TAB ==================================================== --}}
                    {{-- ==================================================== MACHINES TAB ==================================================== --}}
                    <div class="tab-pane fade show active" id="pills-machine" role="tabpanel"
                        aria-labelledby="pills-machine-tab">

                        <div class="row row-cols-1 row-cols-md-3">
                            @foreach ($laundry as $info)
                                @if ($info->status == 0)
                                    <div class="col mb-4">
                                        <div class="card h-100 bg-success text-white" id="M{{ $info->id }}">
                                            <div class="card-body ">
                                                <h2 class="card-title d-flex justify-content-center align-items-center">
                                                    {{ $info->machine_name }}
                                                </h2>
                                                <div class="card-footer text-center" style="background-color: transparent;">
                                                    <span class="badge badge-success">Available</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $("#M{{ $info->id }}").on('click', function() {
                                            const currPrice = $("#totalPrice").html()
                                            const currTime = $("#totalTime").html()
                                            $("#totalPrice").html(Number(currPrice) + Number({{ $info->price }}))
                                            $("#totalTime").html(Number(currTime) + Number({{ $info->timer }}))
                                            $("#receiptTable > tbody:last-child").append(
                                                '<tr>' +
                                                '<td>{{ $info->machine_service }}<span class="d-none" id="machineId{{ $info->id }}">{{ $info->id }}</span></td>' +
                                                '<td>{{ $info->price }}<span class="d-none" id="machineTimer{{ $info->id }}">{{ $info->timer }}</span></td>' +
                                                '<td class="d-flex">' +
                                                '<button class="btn btn-sm btn-circle btn-danger mr-3" id="{{ $info->id }}minusQuantity" type="button"><i class="fas fa-minus"></i></button>' +
                                                '<input readonly type="text" value="0" class="form-control w-25" id="weight{{ $info->id }}">' +
                                                '<button class="btn btn-sm btn-circle btn-success ml-3" type="button" id="{{ $info->id }}addQuantity"><i class="fas fa-plus"></i></button></td>' +
                                                '<td id="totalService{{ $info->id }}"></td>' +
                                                '<td>action</td>' +
                                                '<tr>'
                                            )
                                            const currVal = Number($("#numberOfRows").val())
                                            $("#numberOfRows").val(currVal + 1)
                                            const numRows = Number($("#numberOfRows").val())

                                            // for (let i = 0; i < numRows; i++) {
                                            //     console.log($("#weight{{ $info->id }}").val())
                                            // }
                                            $("#{{ $info->id }}addQuantity").on('click', function() {
                                                let currWeight = Number($('#weight{{ $info->id }}').val())
                                                if (currWeight >= 0 && currWeight < Number({{ $info->max_kg }})) {
                                                    currWeight = currWeight + 0.5
                                                    $("#weight{{ $info->id }}").val(currWeight);
                                                    $("#totalService{{ $info->id }}").html(Number({{ $info->price }}))
                                                } else {
                                                    swal({
                                                        icon: 'error',
                                                        title: 'Error!',
                                                        text: "Cannot exceed past the weight limit!",
                                                        buttons: false
                                                    })
                                                }
                                            })
                                            $("#{{ $info->id }}minusQuantity").on('click', function() {
                                                let currWeight = Number($('#weight{{ $info->id }}').val())
                                                if (currWeight > 0 && currWeight <= Number({{ $info->max_kg }})) {
                                                    currWeight = currWeight - 0.5
                                                    $("#weight{{ $info->id }}").val(currWeight);
                                                    $("#totalService{{ $info->id }}").html(Number({{ $info->price }}))
                                                } else {
                                                    swal({
                                                        icon: 'error',
                                                        title: 'Error!',
                                                        text: "Cannot exceed past the weight limit!",
                                                        buttons: false
                                                    })
                                                }
                                            })
                                        });
                                    </script>
                                @else
                                    <div class="col mb-4">
                                        <div class="card h-100 bg-danger text-white">
                                            <div class="card-body">
                                                <h2 class="card-title d-flex justify-content-center align-items-center">
                                                    {{ $info->machine_name }}
                                                </h2>
                                                <div class="card-footer text-center" style="background-color: transparent;">
                                                    <span class="badge badge-danger">Not
                                                        Available</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div> {{-- END OF MACHINES TAB --}}

                    {{-- ==================================================== SERVICES TAB ==================================================== --}}
                    {{-- ==================================================== SERVICES TAB ==================================================== --}}
                    {{-- ==================================================== SERVICES TAB ==================================================== --}}
                    <div class="tab-pane fade" id="pills-services" role="tabpanel" aria-labelledby="pills-services-tab">
                        <div class="row row-cols-1 row-cols-md-3">
                            @foreach ($additionalServices as $info)
                                <div class="col mb-4">
                                    <div class="card h-100 bg-success text-white" id="S{{ $info->id }}">
                                        <div class="card-body ">
                                            <h2 class="card-title d-flex justify-content-center align-items-center">
                                                {{ $info->add_serv_name }}
                                            </h2>
                                            <div class="card-footer text-center" style="background-color: transparent;">
                                                <span class="badge badge-success">P{{ $info->add_serv_price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $("#S{{ $info->id }}").on('click', function() {
                                        const currPrice = $("#totalPrice").html()
                                        $("#totalPrice").html(Number(currPrice) + Number({{ $info->add_serv_price }}))
                                        $("#receiptTable > tbody:last-child").append(
                                            '<tr>' +
                                            '<td>{{ $info->add_serv_name }}</td>' +
                                            '<td></td>' +
                                            '<td></td>' +
                                            '<td id="servicePrice{{ $info->id }}}">{{ $info->add_serv_price }}</td>' +
                                            '<td>action</td></tr>'
                                        )
                                        const currVal = Number($("#numberOfRows").val())
                                        $("#numberOfRows").val(currVal + 1)
                                        const numRows = Number($("#numberOfRows").val())
                                    })
                                </script>
                            @endforeach

                            {{-- <div class="col mb-4">
                                <div class="card h-100 bg-danger text-white">
                                    <div class="card-body ">
                                        <h2 class="card-title d-flex justify-content-center align-items-center">
                                            S1
                                        </h2>
                                        <div class="card-footer text-center" style="background-color: transparent;">
                                            <span class="badge badge-danger">Not Available</span>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>{{-- END OF SERVICES TAB --}}

                    {{-- ==================================================== PRODUCTS TAB ==================================================== --}}
                    {{-- ==================================================== PRODUCTS TAB ==================================================== --}}
                    {{-- ==================================================== PRODUCTS TAB ==================================================== --}}
                    <div class="tab-pane fade" id="pills-products" role="tabpanel" aria-labelledby="pills-products-tab">
                        <div class="row row-cols-1 row-cols-md-3">
                            @foreach ($additionalProducts as $info)
                                <div class="col mb-4">
                                    <div class="card h-100 bg-success text-white" id="P{{ $info->id }}">
                                        <div class="card-body ">
                                            <h2 class="card-title d-flex justify-content-center align-items-center">
                                                {{ $info->add_prod_name }}
                                            </h2>
                                            <div class="card-footer text-center" style="background-color: transparent;">
                                                <span class="badge badge-success">P{{ $info->add_prod_price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $("#P{{ $info->id }}").on('click', function() {
                                        const currPrice = $("#totalPrice").html()
                                        $("#receiptTable > tbody:last-child").append(
                                            '<tr>' +
                                            '<td>{{ $info->add_prod_name }}</td>' +
                                            '<td>{{ $info->add_prod_price }}</td>' +
                                            '<td class="d-flex">' +
                                            '<button class="btn btn-sm btn-circle btn-danger mr-3" id="{{ $info->id }}minusQuantityProd" type="button"><i class="fas fa-minus"></i></button>' +
                                            '<input readonly type="text" value="0" class="form-control w-25" id="prod{{ $info->id }}">' +
                                            '<button class="btn btn-sm btn-circle btn-success ml-3" type="button" id="{{ $info->id }}addQuantityProd"><i class="fas fa-plus"></i></button></td>' +
                                            '<td id="totalProd{{ $info->id }}"></td>' +
                                            '<td>action</td></tr>'
                                        )
                                        const currVal = Number($("#numberOfRows").val())
                                        $("#numberOfRows").val(currVal + 1)
                                        const numRows = Number($("#numberOfRows").val())

                                        $("#{{ $info->id }}addQuantityProd").on('click', function() {
                                            let currProd = Number($('#prod{{ $info->id }}').val())
                                            if (currProd >= 0) {
                                                currProd = currProd + 1
                                                $("#prod{{ $info->id }}").val(currProd);
                                                let newTotal = currProd * Number({{ $info->add_prod_price }})
                                                $("#totalProd{{ $info->id }}").html(newTotal)
                                                $("#totalPrice").html(Number(currPrice) + newTotal)
                                            }
                                        })
                                        $("#{{ $info->id }}minusQuantityProd").on('click', function() {
                                            let currProd = Number($('#prod{{ $info->id }}').val())
                                            if (currProd != 0) {
                                                currProd = currProd - 1
                                                $("#prod{{ $info->id }}").val(currProd);
                                                let newTotal = currProd * Number({{ $info->add_prod_price }})
                                                $("#totalProd{{ $info->id }}").html(newTotal)
                                                $("#totalPrice").html(Number(currPrice) + newTotal)
                                            }
                                        })
                                    })
                                </script>

                                {{-- <div class="col mb-4">
                                <div class="card h-100 bg-danger text-white">
                                    <div class="card-body ">
                                        <h2 class="card-title d-flex justify-content-center align-items-center">
                                            P1
                                        </h2>
                                        <div class="card-footer text-center" style="background-color: transparent;">
                                            <span class="badge badge-danger">Not Available</span>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            @endforeach
                        </div>
                    </div> {{-- END OF PRODUCTS TAB --}}
                </div>

            </div>

            <div class="col-md-4">
                <div class="h5 text-center font-weight-bold">Orders</div>

                <form action="" method="post" id="orderForm">
                    {{-- CHECK RADIO BUTTON --}}
                    {{-- CHECK RADIO BUTTON --}}
                    <div class="row my-2">
                        <div class="col-auto">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="customerState" id="unregistered"
                                    value="unregistered">
                                <label class="form-check-label" for="unregistered">
                                    Unregistered Customer
                                </label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="customerState" id="registered"
                                    value="registered">
                                <label class="form-check-label" for="registered">
                                    Registered Customer
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- REGISTERED CUSTOMER --}}
                    {{-- REGISTERED CUSTOMER --}}
                    <div class="row my-2 d-none" id="registeredName">
                        <div class="col-auto">
                            <label for=""><strong>Customer Name:</strong></label>
                        </div>
                        <div class="col-auto">
                            <select class="form-control form-control-sm" id="orderingCustomerId">
                                <option value="0">Choose a customer...</option>
                                @foreach ($customers as $info)
                                    <option value="{{ $info->id }}">{{ $info->last_name }},
                                        {{ $info->first_name }}
                                        {{ Str::substr($info->middle_name, 0, 1) }}.</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- UNREGISTERED CUSTOMER --}}
                    {{-- UNREGISTERED CUSTOMER --}}
                    <div class="row my-2 d-none" id="unregisteredName">
                        <div class="col-auto">
                            <label for=""><strong>Customer Name:</strong></label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control form-control-sm" name="first_name" id="fname"
                                placeholder="First Name">
                            <input type="text" class="form-control form-control-sm" name="middle_name" id="mname"
                                placeholder="Middle Name">
                            <input type="text" class="form-control form-control-sm" name="last_name" id="lname"
                                placeholder="Last Name">
                        </div>
                    </div>
                    <select name="" id="laundryCommodity" class="form-control form-control-sm">
                        @foreach ($laundryCommodities as $info)
                            <option value="Walk-In"
                                class="@if ($info->self_service === false) d-none
                            @else @endif">
                                Walk-in (Self-Service)</option>
                            <option value="Drop-Off"
                                class="@if ($info->full_service === false) d-none
                            @else @endif">
                                Drop-Offs (Full-Service)</option>
                            <option value="Pick-up"
                                class="@if ($info->pick_up === false) d-none
                            @else @endif">
                                Pick-up and Delivery</option>
                            <option value="Reservation"
                                class="@if ($info->reservations === false) d-none
                            @else @endif">
                                Reservation</option>
                        @endforeach
                    </select>
                    <input type="text" value="{{ csrf_token() }}" id="csrfToken" class="d-none">
                    <div class="table-responsive">
                        <table class="table" id="receiptTable">
                            <thead>
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Weight/Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <td>Jacob</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                    <td>@fat</td>
                                </tr> --}}
                                {{-- <tr>
                                    <th scope="row">Grand Total</th>
                                    <td></td>
                                    <td></td>
                                    <td colspan="4">30.00</td>
                                </tr> --}}
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-around">
                            <div class="h6">
                                Total Price: P<span id="totalPrice">0</span>
                            </div>
                            <div class="h6">
                                Total Time: <span id="totalTime">0</span> minutes
                            </div>
                        </div>
                        {{-- INPUT FOR COUTING NUMBER OF ROWS --}}
                        <input type="text" id="numberOfRows" class="d-none">

                    </div>
                    <div class="d-flex justify-content-around">

                        <button class="btn btn-primary d-block mr-auto ml-auto" type="button"
                            id="cashRecepitSubmit">Cash</button>
                        <button class="btn btn-primary d-block mr-auto ml-auto" type="button">Cashless</button>
                    </div>

                </form>

                <div class="d-flex justify-content-end mt-5">
                    <button class="btn btn-danger mr-3">Clear Items</button>
                    <button class="btn btn-warning">Back</button>
                </div>
            </div>
        </div>

    </div>
@endsection

{{-- <div class="col mb-4">
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
    </div> --}}
