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
            <div class="d-flex">
                <button class="btn btn-secondary mx-3" data-toggle="modal" data-target="#cashlessReceiptsModal">View Cashless
                    Receipts</button>
                <a href="{{ route('client.vieworder', $laundryID->id) }}"><button class="btn btn-primary mx-3">View
                        Orders</button></a>
            </div>

            <div class="modal fade" id="cashlessReceiptsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cashless Receipts</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cashlessReceipts as $cashlessReceipt)
                                        <tr>
                                            <th scope="row" class="w-50">
                                                {{-- <img src="https://palabaph.com/PalabaPH_New_v2-main/storage/app/cashless_recepts/{{ $cashlessReceipt->user_id }}/{{ $cashlessReceipt->payment_image_uri }}"
                                                    alt="" srcset="" class="w-50"> --}}
                                                <img src="{{ asset('storage/cashless_receipts/'. $cashlessReceipt->user_id . '/' . $cashlessReceipt->payment_image_uri) }}"
                                                    alt="" srcset="" class="w-50">
                                            </th>
                                            <td>{{ $cashlessReceipt->first_name }}</td>
                                            <td>{{ $cashlessReceipt->last_name }}</td>
                                            <td>P{{ $cashlessReceipt->total_price }}</td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8">
                <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-machine-tab" data-toggle="pill" href="#pills-machine"
                            role="tab" aria-controls="pills-machine" aria-selected="true">Machines</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-services-tab" data-toggle="pill" href="#pills-services" role="tab"
                            aria-controls="pills-services" aria-selected="false">Services</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-products-tab" data-toggle="pill" href="#pills-products" role="tab"
                            aria-controls="pills-products" aria-selected="false">Products</a>
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
                                                    <span class="badge badge-success"
                                                        id="machineAvailability{{ $info->id }}">Available</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            @if ($info->maintenance_date !== null)
                                                const currDate = moment().format('LL')
                                                const maintenanceDate = moment('{{ $info->maintenance_date }}').format('LL')

                                                if (currDate === maintenanceDate) {
                                                    $("#M{{ $info->id }}").removeClass('bg-success')
                                                    $("#M{{ $info->id }}").addClass('d-none')
                                                    $("#machineAvailability{{ $info->id }}").removeClass('bg-success')
                                                    $("#machineAvailability{{ $info->id }}").addClass('bg-danger')
                                                    $("#machineAvailability{{ $info->id }}").text("Maintenance")
                                                }
                                            @endif
                                        })
                                        $("#M{{ $info->id }}").on('click', function() {
                                            const currPrice = $("#totalPrice").html()
                                            const currTime = $("#totalTime").html()
                                            const currVal = Number($("#numberOfRows").val())

                                            //CHECK IF MACHINE EXIST ALREADY

                                            $("#numberOfRows").val(currVal + 1)
                                            const numRows = Number($("#numberOfRows").val())
                                            $("#totalPrice").html(Number(currPrice) + Number({{ $info->price }}))
                                            $("#totalTime").html(Number(currTime) + Number({{ $info->timer }}))
                                            $("#receiptTable > tbody:last-child").append(
                                                '<tr>' +
                                                '<td>{{ $info->machine_service }}<span class="d-none" id="machineCount' +
                                                numRows + '">{{ $info->id }}</span></td>' +
                                                '<td>{{ $info->price }}<span class="d-none" id="machineTimer' + numRows +
                                                '">{{ $info->timer }}</span></td>' +
                                                '<td class="d-flex">' +
                                                '<button class="btn btn-sm btn-circle btn-danger mr-3" id="{{ $info->id }}minusQuantity" type="button"><i class="fas fa-minus"></i></button>' +
                                                '<input readonly type="text" value="0" class="form-control w-25" id="weight{{ $info->id }}">' +
                                                '<input readonly type="text" value="{{ $info->machine_service }}" class="form-control w-25 d-none" id="machineService' +
                                                numRows + '">' +
                                                '<button class="btn btn-sm btn-circle btn-success ml-3" type="button" id="{{ $info->id }}addQuantity"><i class="fas fa-plus"></i></button></td>' +
                                                '<td id="totalService{{ $info->id }}"></td>' +
                                                '<td><button class="btn btn-danger btn-sm btn-circle"><i class="fas fa-trash"></i></button></td>' +
                                                '<tr>'
                                            )
                                            // $("#machineCount{{ $info->id }}").text(numRows);
                                            // console.log($("#machineId{{ $info->id }}").html())
                                            console.log($("#machineCount" + numRows).html())
                                            const currMachineTimer = Number($("#totalTime").html())

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
                                        <div class="card h-100 bg-danger text-white" id="M{{ $info->id }}">
                                            <div class="card-body">
                                                <h2 class="card-title d-flex justify-content-center align-items-center">
                                                    {{ $info->machine_name }}
                                                </h2>
                                                <div class="card-footer text-center"
                                                    style="background-color: transparent;">
                                                    <span class="badge badge-danger">In Use</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $("#M{{ $info->id }}").on('click', function() {
                                            const currPrice = $("#totalPrice").html()
                                            const currTime = $("#totalTime").html()
                                            const currVal = Number($("#numberOfRows").val())

                                            //CHECK IF MACHINE EXIST ALREADY

                                            $("#numberOfRows").val(currVal + 1)
                                            const numRows = Number($("#numberOfRows").val())
                                            $("#totalPrice").html(Number(currPrice) + Number({{ $info->price }}))
                                            $("#totalTime").html(Number(currTime) + Number({{ $info->timer }}))
                                            $("#receiptTable > tbody:last-child").append(
                                                '<tr>' +
                                                '<td>{{ $info->machine_service }}<span class="d-none" id="machineCount' +
                                                numRows + '">{{ $info->id }}</span></td>' +
                                                '<td>{{ $info->price }}<span class="d-none" id="machineTimer' + numRows +
                                                '">{{ $info->timer }}</span></td>' +
                                                '<td class="d-flex">' +
                                                '<button class="btn btn-sm btn-circle btn-danger mr-3" id="{{ $info->id }}minusQuantity" type="button"><i class="fas fa-minus"></i></button>' +
                                                '<input readonly type="text" value="0" class="form-control w-25" id="weight{{ $info->id }}">' +
                                                '<input readonly type="text" value="{{ $info->machine_service }}" class="form-control w-25 d-none" id="machineService' +
                                                numRows + '">' +
                                                '<button class="btn btn-sm btn-circle btn-success ml-3" type="button" id="{{ $info->id }}addQuantity"><i class="fas fa-plus"></i></button></td>' +
                                                '<td id="totalService{{ $info->id }}"></td>' +
                                                '<td><button class="btn btn-danger btn-sm btn-circle"><i class="fas fa-trash"></i></button></td>' +
                                                '<tr>'
                                            )
                                            // $("#machineCount{{ $info->id }}").text(numRows);
                                            // console.log($("#machineId{{ $info->id }}").html())
                                            console.log($("#machineCount" + numRows).html())
                                            const currMachineTimer = Number($("#totalTime").html())

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
                                            '<td><button class="btn btn-danger btn-sm btn-circle"><i class="fas fa-trash"></i></button></td></tr>'
                                        )
                                        const currVal = Number($("#numberOfRows").val())
                                        $("#numberOfRows").val(currVal + 1)
                                        const numRows = Number($("#numberOfRows").val())
                                    })
                                </script>
                            @endforeach


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
                                            '<td><button class="btn btn-danger btn-sm btn-circle"><i class="fas fa-trash"></i></button></td></tr>'
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
                            @foreach ($customers as $info)
                                <span class="d-none"
                                    id="registeredFname{{ $info->id }}">{{ $info->first_name }}</span>
                                <span class="d-none"
                                    id="registeredMname{{ $info->id }}">{{ $info->middle_name }}</span>
                                <span class="d-none"
                                    id="registeredLname{{ $info->id }}">{{ $info->last_name }}</span>
                            @endforeach
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
                    <select name="" id="laundrySegregation" class="form-control form-control-sm my-2">
                        <option value="">Choose a Segregation...</option>
                        <option value="Whites">Whites</option>
                        <option value="Mixed">Mixed</option>
                        <option value="Colors">Colors</option>
                        <option value="Delicates">Delicates</option>
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
                        {{-- INPUT FOR COUTING NUMBER OF ROWS AND LAUNDRY ID --}}
                        <input type="text" id="numberOfRows" class="d-none">
                        <input type="text" id="laundryId" value="{{ $laundryID->id }}" class="d-none">

                    </div>
                    <div class="d-flex justify-content-around">

                        <button class="btn btn-primary d-block mr-auto ml-auto" type="button"
                            id="cashRecepitSubmit">Cash</button>
                        <button class="btn btn-primary d-block mr-auto ml-auto" type="button" data-toggle="modal"
                            data-target="#cashlessModal">Cashless</button>
                    </div>
                </form>

                <div class="d-flex justify-content-end mt-5">
                    <button type="button" id="queueItems" class="btn btn-warning mr-3">Queue Items</button>
                </div>
                {{-- ======================== CASHLESS MODAL ======================== --}}
                {{-- ======================== CASHLESS MODAL ======================== --}}
                {{-- ======================== CASHLESS MODAL ======================== --}}
                <div class="modal fade" id="cashlessModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Gcash QR Code</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @forelse ($gcash_image as $gcash)
                                    <img src="https://palabaph.com/PalabaPH_New_v2-main/storage/app/gcash_image/{{ $laundryID->id }}/{{ $gcash->gcash_qr_code }}"
                                        class="img-fluid" alt="">
                                @empty
                                @endforelse
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" id="cashlessRecepitSubmit"
                                    class="btn btn-primary">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- INSERT TABLE HERE --}}
        <div class="d-flex mx-4 justify-content-between">
            <div class="h4 text-dark">View Reservations</div>
        </div>
        <table class="table mx-4">
            <thead>
                <tr>
                    <th scope="col">Machine</th>
                    <th scope="col">User</th>
                    <th scope="col">Reservation Date</th>
                    <th scope="col">Time Start</th>
                    <th scope="col">Time End</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <th scope="row">{{ $reservation->machine_name }}</th>
                        <td>{{ $reservation->reservation_date }}</td>
                        <td>{{ $reservation->first_name }} {{ $reservation->last_name }}</td>
                        <td>{{ $reservation->time_start }}</td>
                        <td>{{ $reservation->time_end }}</td>
                        <td>
                            <button class="btn btn-success" id="successReservation{{ $reservation->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                </svg>
                            </button>
                            <button class="btn btn-danger" id="cancelReservation{{ $reservation->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    <script>
                        $("#cancelReservation{{ $reservation->id }}").click(function() {
                            swal({
                                icon: "warning",
                                title: "Cancel Reservation?",
                                text: "Are you sure you want to cancel the reservation?",
                                buttons: {
                                    cancel: "Cancel",
                                    true: "OK"
                                }
                            }).then(response => {
                                if (response == 'true') {
                                    const formdata = new FormData()
                                    formdata.append('id', '{{ $reservation->id }}')
                                    axios.post('/cancelreservation', formdata)
                                        .then(response => {
                                            swal({
                                                icon: "success",
                                                title: "Reservation Cancelled!",
                                                text: "The reservation has been cancelled!",
                                                buttons: false,
                                            }).then(response => {
                                                location.reload()
                                            })
                                        })
                                }
                            })
                        })

                        $("#successReservation{{ $reservation->id }}").click(function() {
                            swal({
                                icon: "warning",
                                title: "Process the Reservation?",
                                text: "Are you sure you want to process the reservation?",
                                buttons: {
                                    cancel: "Cancel",
                                    true: "OK"
                                }
                            }).then(response => {
                                if (response == 'true') {
                                    swal({
                                        icon: "success",
                                        title: "Successfully Processed!",
                                        text: "The reservation has pushed through!",
                                        buttons: false
                                    }).then(response => {
                                        const formdata = new FormData()
                                        formdata.append('id', "{{ $reservation->id }}")
                                        axios.post('/processreservation', formdata)
                                            .then(response => {
                                                location.reload()
                                            })
                                    })
                                }
                            })
                        })
                    </script>
                @endforeach
            </tbody>
        </table>
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
