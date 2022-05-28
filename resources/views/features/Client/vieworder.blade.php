@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="back mb-4">
            <a href="{{ route('client.manageindividual', $laundry->id) }}" class="text-gray-900"
                style="text-decoration: none;">
                <i class="fas fa-chevron-left"></i> Back</a>
        </div>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View Order</h1>
        </div>

        {{-- FIRST SECTION --}}
        <div class="card shadow-card mb-3 mt-3">
            <div class="card-header text-primary font-weight-bold h5">Machine Availbility</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" width="100%" cellspacing="0" style="color:#464646 !important">
                        <thead>
                            <tr>
                                <th>Machine</th>
                                <th>Current User</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- END OF FIRST SECTION --}}


        {{-- SECOND SECTION --}}
        <div class="card">
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-walkIn-tab" data-toggle="tab" href="#nav-walkIn"
                            role="tab" aria-controls="nav-walkIn" aria-selected="true">Walk Ins (Self-Service)</a>
                        <a class="nav-item nav-link" id="nav-dropOff-tab" data-toggle="tab" href="#nav-dropOff" role="tab"
                            aria-controls="nav-dropOff" aria-selected="false">Drop Offs (Full-Service)</a>
                        <a class="nav-item nav-link" id="nav-pickup-tab" data-toggle="tab" href="#nav-pickup" role="tab"
                            aria-controls="nav-pickup" aria-selected="false">Pick Up and Deliveries</a>
                        <a class="nav-item nav-link" id="nav-reservation-tab" data-toggle="tab" href="#nav-reservation"
                            role="tab" aria-controls="nav-reservation" aria-selected="false">Reservation</a>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    {{-- WALK-IN TAB --}}
                    <div class="tab-pane mt-3 fade show active" id="nav-walkIn" role="tabpanel"
                        aria-labelledby="nav-walkIn-tab">
                        <div class="table-responsive">
                            <table class="table" width="100%" cellspacing="0" style="color:#464646 !important">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Services</th>
                                        <th>Date</th>
                                        <th>Laundry Status</th>
                                        <th>Payment Status</th>
                                        <th>Assigned Machine</th>
                                        <th>Weight (KG)</th>
                                        <th>Price</th>
                                        <th>Load Count</th>
                                        <th>Payment Method</th>
                                        <th>Timer Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div> {{-- END OF WALK-IN TAB --}}

                    {{-- DROP-OFF TAB --}}
                    <div class="tab-pane mt-3 fade" id="nav-dropOff" role="tabpanel" aria-labelledby="nav-dropOff-tab">
                        <div class="table-responsive">
                            <table class="table" width="100%" cellspacing="0" style="color:#464646 !important">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Services</th>
                                        <th>Date</th>
                                        <th>Laundry Status</th>
                                        <th>Payment Status</th>
                                        <th>Assigned Machine</th>
                                        <th>Weight (KG)</th>
                                        <th>Price</th>
                                        <th>Service Type</th>
                                        <th>Payment Method</th>
                                        <th>Timer Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div> {{-- END OF DROP-OFF TAB --}}

                    {{-- PICK-UP TAB --}}
                    <div class="tab-pane mt-3 fade" id="nav-pickup" role="tabpanel" aria-labelledby="nav-pickup-tab">
                        <div class="table-responsive">
                            <table class="table" width="100%" cellspacing="0" style="color:#464646 !important">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Services</th>
                                        <th>Date</th>
                                        <th>Laundry Status</th>
                                        <th>Payment Status</th>
                                        <th>Assigned Machine</th>
                                        <th>Weight (KG)</th>
                                        <th>Price</th>
                                        <th>Service Type</th>
                                        <th>Delivery Status</th>
                                        <th>Delivery Address</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>{{-- END OF PICK-UP TAB --}}

                    {{-- RESERVATION TAB --}}
                    <div class="tab-pane mt-3 fade" id="nav-reservation" role="tabpanel"
                        aria-labelledby="nav-reservation-tab">
                        <div class="table-responsive">
                            <table class="table" width="100%" cellspacing="0" style="color:#464646 !important">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Services</th>
                                        <th>Date</th>
                                        <th>Laundry Status</th>
                                        <th>Payment Status</th>
                                        <th>Assigned Machine</th>
                                        <th>Weight (KG)</th>
                                        <th>Price</th>
                                        <th>Service Type</th>
                                        <th>Timer Status</th>
                                        <th>Reservation Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>{{-- END OF RESERVATION TAB --}}
                </div>
            </div>
        </div> {{-- END OF SECOND SECTION --}}

    </div>
@endsection
