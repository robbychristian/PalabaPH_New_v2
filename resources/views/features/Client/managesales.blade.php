@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sales Management</h1>
        </div>

        <div class="card shadow-card mb-3 mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table data-table" id="dataTable" width="100%" cellspacing="0"
                        style="color:#464646 !important">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Segregation</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                                <th>Total Price</th>
                                <th>Commodity</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('client.managesales') }}",
                    columns: [{
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'segregation_type',
                            name: 'segregation_type'
                        },

                        {
                            data: 'mode_of_payment',
                            name: 'mode_of_payment'
                        },
                        {
                            data: 'payment_status',
                            name: 'payment_status'
                        },
                        {
                            data: 'total_price',
                            name: 'total_price'
                        },
                        {
                            data: 'commodity_type',
                            name: 'commodity_type'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],

                });


            });
        </script>
    </div>
@endsection
