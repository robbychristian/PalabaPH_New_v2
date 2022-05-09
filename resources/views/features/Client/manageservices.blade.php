@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Service Management</h1>

        </div>

        <!--- MAIN SERVICES TABLE -->
        <div class="card shadow-card mb-3 mt-3">
            <div class="card-body">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h4 class="m-0 font-weight-bold text-primary">Main Services</h4>
                    <!-- BUTTON FOR MODAL -->
                    <button class="btn btn-primary" data-toggle="modal" data-target="#mainServicesModal">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table data-table" id="dataTable" width="100%" cellspacing="0"
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
                        <form action="">
                            <div class="form-group mb-3">
                                <label for=""> <strong> Image </strong></label>
                                <br>
                                <input type="file" name="imgMain" id="imgMain">
                            </div>
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
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Add Service</button>
                    </div>
                </div>
            </div>
        </div> <!-- END OF MODAL FOR MAIN SERVICES -->

        <!--- ADDITIONAL SERVICES TABLE -->
        <div class="card shadow-card mb-3 mt-3">
            <div class="card-body">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h4 class="m-0 font-weight-bold text-success">Additional Services</h4>
                    <!-- BUTTON FOR MODAL -->
                    <button class="btn btn-success" data-toggle="modal" data-target="#addServicesModal">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table data-table" id="dataTable" width="100%" cellspacing="0"
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
                        <form action="">
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
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Add Service</button>
                    </div>
                </div>
            </div>
        </div> <!-- END OF MODAL FOR ADDITIONAL SERVICES -->

        <!--- ADDITIONAL PRODUCTS TABLE -->
        <div class="card shadow-card mb-3 mt-3">
            <div class="card-body">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h4 class="m-0 font-weight-bold text-info">Additional Products</h4>
                    <!-- BUTTON FOR MODAL -->
                    <button class="btn btn-info" data-toggle="modal" data-target="#addProductsModal">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table data-table" id="dataTable" width="100%" cellspacing="0"
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
                        <form action="">
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

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info">Add Service</button>
                    </div>
                </div>
            </div>
        </div> <!-- END OF MODAL FOR ADDITIONAL PRODUCTS -->


    </div>

    <!--
                    <script type="text/javascript">
                        $(document).ready(function() {
                            var table = $('.data-table').DataTable({
                                processing: true,
                                serverSide: true,
                                ajax: "",
                                columns: [{
                                        data: 'id',
                                        name: 'id'
                                    },
                                    {
                                        data: 'laundry_owner',
                                        name: 'laundry_owner'
                                    },

                                    {
                                        data: 'name',
                                        name: 'name'
                                    },

                                    {
                                        data: 'status',
                                        name: 'status',
                                        orderable: false,
                                        searchable: false
                                    },
                                ],

                            });


                        });
                    </script> -->
@endsection
