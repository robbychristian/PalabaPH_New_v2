@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-center font-weight-bold h3" style="color: #000">
            Order Management
        </div>

        {{-- ADD ORDER --}}
        <div class="card mt-3">
            <div class="card-header text-primary font-weight-bold h5">Add Order</div>
            <div class="card-body">
                <form action="">
                    @csrf
                    <div class="row">
                        {{-- FIRST COLUMN --}}
                        <div class="col-md-4">

                            <div class="form-group row">
                                <label class="col-sm-6 col-md-5 col-form-label text-xl-right font-weight-bold">Customer
                                    Name</label>
                                <div class="col-sm-6 col-md-7">
                                    <input type="text" class="form-control" value="{{ old('custname') }}"
                                        name="custname">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    class="col-sm-6 col-md-5 col-form-label text-xl-right font-weight-bold">Service</label>
                                <div class="col-sm-6 col-md-7">
                                    <select class="form-control" name="service">
                                        <option disabled selected hidden>Service</option>
                                        <option value="Wash" {{ old('service') == 'Wash' ? 'selected' : '' }}>Wash
                                        </option>
                                        <option value="Dry" {{ old('service') == 'Dry' ? 'selected' : '' }}>Dry</option>
                                        <option value="Fold" {{ old('service') == 'Fold' ? 'selected' : '' }}>Fold
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-6 col-md-5 col-form-label text-xl-right font-weight-bold">Date</label>
                                <div class="col-sm-6 col-md-7">
                                    <input type="text" class="form-control" value="{{ old('date') }}" name="date">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    class="col-sm-6 col-md-5 col-form-label text-xl-right font-weight-bold">Weight(KG)</label>
                                <div class="col-sm-6 col-md-7">
                                    <input type="text" class="form-control" value="{{ old('weight') }}" name="weight">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-6 col-md-5 col-form-label text-xl-right font-weight-bold">Loads</label>
                                <div class="col-sm-6 col-md-7">
                                    <input type="text" class="form-control" value="{{ old('loads') }}" name="loads">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-6 col-md-5 col-form-label text-xl-right font-weight-bold">Customer
                                    ID</label>
                                <div class="col-sm-6 col-md-7">
                                    <input type="text" class="form-control" value="{{ old('custID') }}" name="custID">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-6 col-md-5 col-form-label text-xl-right font-weight-bold">Service
                                    Type</label>
                                <div class="col-sm-6 col-md-7">
                                    <select class="form-control" name="servType">
                                        <option disabled selected hidden>Service Type</option>
                                        <option value="Walk Ins" {{ old('servType') == 'Walk Ins' ? 'selected' : '' }}>
                                            Walk Ins
                                            (Self-Service)</option>
                                        <option value="Drop Off" {{ old('servType') == 'Drop Off' ? 'selected' : '' }}>
                                            Drop Off
                                            (Full-Service)</option>
                                        <option value="Pick up" {{ old('servType') == 'Pick up' ? 'selected' : '' }}>
                                            Pickup and
                                            Deliveries</option>
                                        <option value="Reservation"
                                            {{ old('servType') == 'Reservation' ? 'selected' : '' }}>
                                            Reservation</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-6 col-md-5 col-form-label text-xl-right font-weight-bold">Payment
                                    Method</label>
                                <div class="col-sm-6 col-md-7">
                                    <select class="form-control" name="payMethod">
                                        <option disabled selected hidden>Payment Method</option>
                                        <option value="Cash" {{ old('payMethod') == 'Cash' ? 'selected' : '' }}>Cash
                                        </option>
                                        <option value="">Default select</option>
                                        <option value="">Default select</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    class="col-sm-6 col-md-5 col-form-label text-xl-right font-weight-bold">Segregation</label>
                                <div class="col-sm-6 col-md-7">
                                    <select class="form-control" name="segregation">
                                        <option disabled selected hidden>Segregation</option>
                                        <option value="Whites" {{ old('segregation') == 'Whites' ? 'selected' : '' }}>
                                            Whites</option>
                                        <option value="Colored" {{ old('segregation') == 'Colored' ? 'selected' : '' }}>
                                            Colored</option>

                                    </select>
                                </div>
                            </div>
                        </div>{{-- END OF FIRST COLUMN --}}

                        {{-- SECOND COLUMN --}}
                        <div class="col-md-4">
                            {{-- DELIVERIES --}}
                            <div class="form-deliveries">
                                <div class="font-weight-bold text-center mb-3">For Deliveries</div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-6 col-md-5 col-form-label text-xl-right font-weight-bold">Delivery/Pickup
                                        Address</label>
                                    <div class="col-sm-6 col-md-7">
                                        <input type="text" class="form-control" value="{{ old('delivAddr') }}"
                                            name="delivAddr">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-6 col-md-5 col-form-label text-xl-right font-weight-bold">Cellphone
                                        Number</label>
                                    <div class="col-sm-6 col-md-7">
                                        <input type="text" class="form-control" value="{{ old('cNum') }}" name="cnum">
                                    </div>
                                </div>
                            </div>

                            {{-- RESERVATIONS --}}
                            <div class="form-reservations">
                                <div class="font-weight-bold text-center mt-3 mb-3">For Reservations</div>
                                <div class="form-group row">
                                    <label class="col-sm-6 col-md-5 col-form-label text-xl-right font-weight-bold">Booking
                                        Date</label>
                                    <div class="col-sm-6 col-md-7">
                                        <input type="text" class="form-control" value="{{ old('bookDate') }}"
                                            name="bookDate">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-6 col-md-5 col-form-label text-xl-right font-weight-bold">Booking
                                        Time:</label>
                                    <div class="col-sm-6 col-md-7">
                                        <input type="text" class="form-control" value="{{ old('bookTime') }}"
                                            name="bookTime">
                                    </div>
                                </div>
                            </div>
                        </div> {{-- END OF SECOND COLUMN --}}

                        {{-- THIRD COLUMN --}}
                        <div class="col-md-4">di ko sure ano to</div> {{-- END OF THIRD COLUMN --}}
                    </div> {{-- END OF FIELDS --}}

                    <div class="d-flex justify-content-center align-items-center">
                        <button class="btn btn-primary" type="submit">Add Order</button>
                    </div>
                </form>
            </div>
        </div> {{-- END OF ADD ORDER --}}

        {{-- FIRST SECTION --}}
        <div class="row">
            <!--- CUSTOMER TABLE -->
            <div class="col-md-8">
                <div class="card shadow-card mb-3 mt-3">
                    <div class="card-header text-primary font-weight-bold h5">Customers</div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table main-serv-table" id="dataTable" width="100%" cellspacing="0"
                                style="color:#464646 !important">
                                <thead>
                                    <tr>
                                        <th>Customer ID</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Service Type</th>
                                        <th>Order Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--- END OF CUSTOMER TABLE -->

            <!--- MACHINE TABLE -->
            <div class="col-md-4">
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
            </div>
            <!--- END OF MACHINE TABLE -->
        </div> {{-- END OF FIRST SECTION --}}

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
                                        <th>Segregation</th>
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
                                        <th>Segregation</th>
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
                                        <th>Segregation</th>
                                        <th>Price</th>
                                        <th>Service Type</th>
                                        <th>Payment Method</th>
                                        <th>Timer Status</th>
                                        <th>Address</th>
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
                                        <th>Segregation</th>
                                        <th>Price</th>
                                        <th>Service Type</th>
                                        <th>Payment Method</th>
                                        <th>Timer Status</th>
                                        <th>Reservation Details</th>
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
