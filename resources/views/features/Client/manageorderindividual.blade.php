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
                <ul class="nav nav-pills nav-fill mb-3">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('client.manageindividual') ? 'active' : '' }}"
                            href="{{ route('client.manageindividual', $laundry[0]->id) }}">Machines</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('client.manageorder.services') ? 'active' : '' }}"
                            href="{{ route('client.manageorder.services', $laundry[0]->id) }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('client.manageorder.products') ? 'active' : '' }}"
                            href="{{ route('client.manageorder.products', $laundry[0]->id) }}">Products</a>
                    </li>
                </ul>

                @yield('manage-order-content')

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
                        <table class="table">
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
                                <tr>
                                    <td>Jacob</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                    <td>@fat</td>
                                </tr>

                                <tr>
                                    <th scope="row">Grand Total</th>
                                    <td></td>
                                    <td></td>
                                    <td colspan="4">30.00</td>
                                </tr>

                            </tbody>
                        </table>
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
