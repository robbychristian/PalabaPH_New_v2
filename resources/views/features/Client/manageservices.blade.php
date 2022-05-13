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
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Service Management</h1>

        </div>

        <!--- MAIN SERVICES TABLE -->
        <div class="card shadow-card mb-3 mt-3">
            <div class="card-body">
                <div style="background-color: transparent;"
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h4 class="m-0 font-weight-bold text-primary">Main Services</h4>
                    <!-- BUTTON FOR MODAL -->
                    <button class="btn btn-primary" data-toggle="modal" data-target="#mainServicesModal">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table main-serv-table" id="dataTable" width="100%" cellspacing="0"
                        style="color:#464646 !important">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Max KG</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--- END OF MAIN SERVICES TABLE -->

        <!-- MODAL FOR MAIN SERVICES -->
        <div class="modal fade" id="mainServicesModal" tabindex="-1" aria-labelledby="mainServicesModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-primary" id="mainServicesModalLabel">Main Services</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/addservice" method="POST" id="addservice" enctype="multipart/form-data">
                            @csrf
                            @method("POST")
                            <div class="form-group mb-3">
                                <label for=""> <strong> Service </strong></label>
                                <input type="text" name="service" id="service" class="form-control">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for=""> <strong> Max KG </strong></label>
                                    <input type="text" name="weight" id="weight" class="form-control">
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for=""> <strong> Price </strong></label>
                                    <input type="text" name="priceMain" id="priceMain" class="form-control">
                                </div>
                                <div class="d-none">
                                    <label for=""> <strong> laundry ID </strong></label>
                                    <input type="text" name="laundryId" class="form-control"
                                        value="{{ $laundries[0]->id }}">
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submitService">Add Service</button>
                    </div>
                </div>
            </div>
        </div> <!-- END OF MODAL FOR MAIN SERVICES -->

        <!--- ADDITIONAL SERVICES TABLE -->
        <div class="card shadow-card mb-3 mt-3">
            <div class="card-body">
                <div style="background-color: transparent;"
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h4 class="m-0 font-weight-bold text-success">Additional Services</h4>
                    <!-- BUTTON FOR MODAL -->
                    <button class="btn btn-success" data-toggle="modal" data-target="#addServicesModal">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table add-serv-table" id="dataTable" width="100%" cellspacing="0"
                        style="color:#464646 !important">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--- END OF ADDITIONAL SERVICES TABLE -->

        <!-- MODAL FOR ADDITIONAL SERVICES -->
        <div class="modal fade" id="addServicesModal" tabindex="-1" aria-labelledby="addServicesModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-success" id="addServicesModalLabel">Additional
                            Services</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/addadditionalservice" method="POST" id="additionalService"
                            enctype="multipart/form-data">
                            @csrf
                            @method("POST")
                            <div class="form-group mb-3">
                                <label for=""> <strong> Image </strong></label>
                                <br>
                                <input type="file" name="imgService" id="imgService">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for=""> <strong> Service </strong></label>
                                    <input type="text" name="addService" id="addService" class="form-control">
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for=""> <strong> Price </strong></label>
                                    <input type="text" name="priceService" id="priceService" class="form-control">
                                </div>
                                <div class="d-none">
                                    <label for=""> <strong> laundry ID </strong></label>
                                    <input type="text" name="laundryId" class="form-control"
                                        value="{{ $laundries[0]->id }}">
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="additionalServices">Add Service</button>
                    </div>
                </div>
            </div>
        </div> <!-- END OF MODAL FOR ADDITIONAL SERVICES -->

        <!--- ADDITIONAL PRODUCTS TABLE -->
        <div class="card shadow-card mb-3 mt-3">
            <div class="card-body">
                <div style="background-color: transparent;"
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h4 class="m-0 font-weight-bold text-info">Additional Products</h4>
                    <!-- BUTTON FOR MODAL -->
                    <button class="btn btn-info" data-toggle="modal" data-target="#addProductsModal">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table add-prod-table" id="dataTable" width="100%" cellspacing="0"
                        style="color:#464646 !important">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--- END OF ADDITIONAL PRODUCTS TABLE -->

        <!-- MODAL FOR ADDITIONAL PRODUCTS -->
        <div class="modal fade" id="addProductsModal" tabindex="-1" aria-labelledby="addProductsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-info" id="addProductsModalLabel">Additional
                            Products</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/addadditionalproduct" method="POST" id="additionalProduct"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group mb-3">
                                <label for=""> <strong> Image </strong></label>
                                <br>
                                <input type="file" name="imgProduct" id="imgProduct">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for=""> <strong> Service </strong></label>
                                    <input type="text" name="addProducts" id="addProducts" class="form-control">
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for=""> <strong> Price </strong></label>
                                    <input type="text" name="priceProducts" id="priceProducts" class="form-control">
                                </div>
                            </div>
                            <div class="d-none">
                                <label for=""> <strong> laundry ID </strong></label>
                                <input type="text" name="laundryId" class="form-control"
                                    value="{{ $laundries[0]->id }}">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="additionalProducts" class="btn btn-info">Add Service</button>
                    </div>
                </div>
            </div>
        </div> <!-- END OF MODAL FOR ADDITIONAL PRODUCTS -->


    </div>

    <script src="{{ asset('js/servicemanagement.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.main-serv-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('client.manageservices') }}",
                columns: [{
                        data: 'main_serv_name',
                        name: 'main_serv_name'
                    },

                    {
                        data: 'main_serv_max_kg',
                        name: 'main_serv_max_kg'
                    },
                    {
                        data: 'main_serv_price',
                        name: 'main_serv_price'
                    },

                    {
                        data: 'main_serv_action',
                        name: 'main_serv_action',
                        orderable: false,
                        searchable: false
                    },
                ],

            });
        });

        $(document).ready(function() {
            var table = $('.add-serv-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('client.addservice.table') }}",
                columns: [{
                        data: 'add_serv_name',
                        name: 'add_serv_name'
                    },
                    {
                        data: 'add_serv_price',
                        name: 'add_serv_price'
                    },

                    {
                        data: 'add_serv_action',
                        name: 'add_serv_action',
                        orderable: false,
                        searchable: false
                    },
                ],

            });


        });

        $(document).ready(function() {
            var table = $('.add-prod-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('client.addproduct.table') }}",
                columns: [{
                        data: 'add_prod_name',
                        name: 'add_prod_name'
                    },
                    {
                        data: 'add_prod_price',
                        name: 'add_prod_price'
                    },

                    {
                        data: 'add_prod_action',
                        name: 'add_prod_action',
                        orderable: false,
                        searchable: false
                    },
                ],

            });


        });
    </script>
@endsection
