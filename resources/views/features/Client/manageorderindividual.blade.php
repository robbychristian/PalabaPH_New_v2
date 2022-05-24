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
                                            $("#receiptTable > tbody:last-child").append(
                                                '<tr>' +
                                                '<td>{{ $info->machine_service }}</td>' +
                                                '<td>{{ $info->price }}</td>' +
                                                '<td class="d-flex">' +
                                                '<button class="btn btn-sm btn-circle btn-danger mr-3" id="{{ $info->id }}minusQuantity" type="button"><i class="fas fa-minus"></i></button>' +
                                                '<input readonly type="text" value="0" class="form-control w-25" id="weight{{ $info->id }}">' +
                                                '<button class="btn btn-sm btn-circle btn-success ml-3" type="button" id="{{ $info->id }}addQuantity"><i class="fas fa-plus"></i></button></td>' +
                                                '<td id="total{{ $info->id }}"></td>' +
                                                '<td>action</td></tr>'
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
                                                    $("#total{{ $info->id }}").html(Number({{ $info->price }}))
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
                                                    $("#total{{ $info->id }}").html(Number({{ $info->price }}))
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

                    </div>
                    <div class="tab-pane fade" id="pills-services" role="tabpanel" aria-labelledby="pills-services-tab">
                        Services
                    </div>
                    <div class="tab-pane fade" id="pills-products" role="tabpanel" aria-labelledby="pills-products-tab">
                        Products
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="h5 text-center font-weight-bold">Orders</div>

                <form action="" method="post">
                    <label for=""><strong>Customers</strong> <button class="btn btn-sm btn-success"><i
                                class="fa fa-plus"></i></button></label>
                    <select name="" id="" class="form-control form-control-sm">
                        <option value="">Walk-in</option>
                    </select>

                    <div class="table-responsive">
                        <table class="table" id="receiptTable">
                            <thead>
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Weight</th>
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
                        {{-- INPUT FOR COUTING NUMBER OF ROWS --}}
                        <input type="text" id="numberOfRows" class="d-none">

                    </div>

                    <button class="btn btn-primary d-block mr-auto ml-auto" type="submit">Cash Payment</button>

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
