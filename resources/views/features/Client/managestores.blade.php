@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        <div class="back mb-4">
            <a href="{{ url('/home') }}" class="text-gray-900" style="text-decoration: none;">
                <i class="fas fa-chevron-left"></i> Back</a>
        </div>

        <div class="d-flex justify-content-center font-weight-bold h3" style="color: #000">
            Store Management
        </div>

        @forelse ($storeOwned as $store)
            @if ($store->is_published == 0)
                <form method="POST" action="{{ route('client.storelaundry') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card">
                        <div class="card-body">
                            {{-- FIRST ROW --}}
                            <div class="row">
                                {{-- STORE INFORMATION --}}
                                <div class="col-sm-12 mb-2">
                                    <div class="card border-0">
                                        <div class="card-header font-weight-bold text-center text-primary">Store Information
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                {{-- LOGO --}}
                                                <div class="col-md-3 rounded-circle mb-3">
                                                    <img class="img-fluid d-block mr-auto ml-auto"
                                                        src="https://palabaph.com/PalabaPH_New_v2-main/storage/app/laundry_img_pics/{{ Auth::user()->id }}/{{ $store->laundry_img }}"
                                                        alt="No image" width="200" />
                                                    <div class="custom-file mt-3">
                                                        <input type="file" class="custom-file-input" name='fileLogo'
                                                            id="fileLogo">
                                                        <label class="custom-file-label" for="fileLogo"
                                                            id="fileLogoName">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                                {{-- DETAILS --}}
                                                <div class="col-md-9 d-flex justify-content-center flex-column">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="manage-store-content mb-2"><strong
                                                                    class="mr-2">Store
                                                                    Name:</strong>
                                                                {{ $store->name }}</div>
                                                            <div class="manage-store-content mb-2"><strong
                                                                    class="mr-2">Address:</strong>
                                                                {{ $store->street }},
                                                                {{ Str::substr($store->barangay, 9, Str::of($store->barangay)->length()) }},
                                                                {{ Str::substr($store->city, 6, Str::of($store->city)->length()) }},
                                                                {{ Str::substr($store->state, 4, Str::of($store->state)->length()) }}
                                                            </div>
                                                            <div class="manage-store-content mb-2"><strong
                                                                    class="mr-2">Landline:</strong>
                                                                {{ $store->landline }}</div>
                                                            <div class="manage-store-content mb-2"><strong
                                                                    class="mr-2">Contact
                                                                    Info:</strong>
                                                                {{ $store->phone }}</div>
                                                            <div class="manage-store-content mb-2 text-justify"><strong
                                                                    class="mr-2">Description:</strong>
                                                                {{ $store->description }}</div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="manage-store-content mb-2"><strong
                                                                    class="mr-2">Type
                                                                    of
                                                                    Laundry Shop:</strong>
                                                                {{ $store->type_of_laundry }}</div>
                                                            <div class="manage-store-content mb-2"><strong class="mr-2">
                                                                    Opening Hours;</strong>
                                                                {{ date('h:i A', strtoTime($store->opening_time)) }}
                                                            </div>
                                                            <div class="manage-store-content mb-2"><strong class="mr-2">
                                                                    Closing Hours</strong>
                                                                {{ date('h:i A', strtoTime($store->closing_time)) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> {{-- END OF DETAILS --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>{{-- END OF STORE INFORMATION --}}
                            </div> {{-- END OF FIRST ROW --}}
                            {{-- SECOND ROW --}}
                            <div class="row">
                                {{-- SERVICE TYPES --}}
                                <div class="col-md-6">
                                    <div class="card border-0">
                                        <div class="card-header font-weight-bold text-primary text-center">Services Types
                                            (Accomodations)
                                        </div>
                                        <ul class="list-group list-group-flush border-0">
                                            <li class="list-group-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="self-servce"
                                                        name="self_service" value="true">
                                                    <label class="custom-control-label" for="self-servce">Self-Service
                                                        (Walk-Ins)</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="full-service"
                                                        name="full_service" value="true">
                                                    <label class="custom-control-label" for="full-service">Full Service
                                                        (Drop
                                                        Offs)</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="pickup"
                                                        name="pickup" value="true">
                                                    <label class="custom-control-label" for="pickup">Pickup and
                                                        Deliveries</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="reservations"
                                                        name="reservation" value="true">
                                                    <label class="custom-control-label"
                                                        for="reservations">Reservations</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>{{-- END OF SERVICE TYPES --}}

                                {{-- PAYMENT METHODS --}}
                                <div class="col-md-6">
                                    <div class="card border-0">
                                        <div class="card-header font-weight-bold text-primary text-center">Payment Methods
                                        </div>
                                        <ul class="list-group list-group-flush border-0">
                                            <li class="list-group-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="cash"
                                                        name="cash" value="true">
                                                    <label class="custom-control-label" for="cash">Cash</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="cashless"
                                                        name="cashless" value="true">
                                                    <label class="custom-control-label" for="cashless">Cashless</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <label for="">GCash QR Code</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="gcashFile"
                                                        name="gcash">
                                                    <label class="custom-file-label" for="gcashFile"
                                                        id="gcashFileName">Choose file</label>
                                                </div>
                                                @error('gcash')
                                                    {{ $message }}
                                                @enderror
                                            </li>
                                        </ul>
                                    </div>
                                </div>{{-- END OF PAYMENT METHODS --}}
                            </div> {{-- END OF SECOND ROW --}}
                            <div class="row d-flex justify-content-center my-3">
                                <input type="number" value="{{ $store->laundry_id }}" class="d-none"
                                    name="laundry_id">
                                <button type="submit" class="btn btn-primary w-50 p-2 font-weight-bold"
                                    href="{{ route('client.storelaundry') }}">Publish
                                    Laundry Shop</button>
                            </div>
                </form>
    </div>
    </div>
@else
    <form method="POST" action="{{ route('client.storelaundry') }}" id="editForm" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="card">
            <div class="card-body">
                {{-- FIRST ROW --}}
                <div class="row">
                    {{-- STORE INFORMATION --}}
                    <div class="col-sm-12 mb-2">
                        <div class="card border-0">
                            <div class="card-header font-weight-bold text-center text-primary">Store
                                Information
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    {{-- LOGO --}}
                                    <div class="col-md-3 rounded-circle mb-3">
                                        <img class="img-fluid d-block mr-auto ml-auto"
                                            src="https://palabaph.com/PalabaPH_New_v2-main/storage/app/laundry_img_pics/{{ Auth::user()->id }}/{{ $store->laundry_img }}"
                                            alt="No image" width="200" />
                                        <div class="custom-file mt-3">
                                            <input type="file" class="custom-file-input" name="fileLogo"
                                                id="fileLogo">
                                            <label class="custom-file-label" for="fileLogo" id="fileLogoName">Choose
                                                file</label>
                                        </div>
                                    </div>
                                    {{-- DETAILS --}}
                                    <div class="col-md-9 d-flex justify-content-center flex-column">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="manage-store-content mb-2"><strong class="mr-2">Store
                                                        Name:</strong>
                                                    {{ $store->name }}</div>
                                                <div class="manage-store-content mb-2"><strong
                                                        class="mr-2">Address:</strong>
                                                    {{ $store->street }},
                                                    {{ Str::substr($store->barangay, 9, Str::of($store->barangay)->length()) }},
                                                    {{ Str::substr($store->city, 6, Str::of($store->city)->length()) }},
                                                    {{ Str::substr($store->state, 4, Str::of($store->state)->length()) }}
                                                </div>
                                                <div class="manage-store-content mb-2"><strong
                                                        class="mr-2">Landline:</strong>
                                                    {{ $store->landline }}</div>
                                                <div class="manage-store-content mb-2"><strong class="mr-2">Contact
                                                        Info:</strong>
                                                    {{ $store->phone }}</div>
                                                <div class="manage-store-content mb-2 text-justify"><strong
                                                        class="mr-2">Description:</strong>
                                                    {{ $store->description }}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="manage-store-content mb-2"><strong class="mr-2">Type
                                                        of
                                                        Laundry Shop:</strong>
                                                    {{ $store->type_of_laundry }}</div>
                                                <div class="manage-store-content mb-2"><strong class="mr-2">
                                                        Opening Hours;</strong>
                                                    {{ date('h:i A', strtoTime($store->opening_time)) }}
                                                </div>
                                                <div class="manage-store-content mb-2"><strong class="mr-2">
                                                        Closing Hours</strong>
                                                    {{ date('h:i A', strtoTime($store->closing_time)) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div> {{-- END OF DETAILS --}}
                                </div>
                            </div>
                        </div>
                    </div>{{-- END OF STORE INFORMATION --}}
                </div> {{-- END OF FIRST ROW --}}
                {{-- SECOND ROW --}}
                <div class="row">
                    {{-- SERVICE TYPES --}}
                    <div class="col-md-6">
                        <div class="card border-0">
                            <div class="card-header font-weight-bold text-primary text-center">Services Types
                                (Accomodations)
                            </div>
                            <ul class="list-group list-group-flush border-0">
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="self-servce"
                                            name="self_service" value="true"
                                            @if ($store->self_service == 1) checked @endif>
                                        <label class="custom-control-label" for="self-servce">Self-Service
                                            (Walk-Ins)</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="full-service"
                                            name="full_service" value="true"
                                            @if ($store->full_service == 1) checked @endif>
                                        <label class="custom-control-label" for="full-service">Full Service
                                            (Drop
                                            Offs)</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="pickup"
                                            name="pickup" value="true"
                                            @if ($store->pick_up == 1) checked @endif>
                                        <label class="custom-control-label" for="pickup">Pickup and
                                            Deliveries</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="reservations"
                                            name="reservation" value="true"
                                            @if ($store->reservations == 1) checked @endif>
                                        <label class="custom-control-label" for="reservations">Reservations</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>{{-- END OF SERVICE TYPES --}}

                    {{-- PAYMENT METHODS --}}
                    <div class="col-md-6">
                        <div class="card border-0">
                            <div class="card-header font-weight-bold text-primary text-center">Payment Methods
                            </div>
                            <ul class="list-group list-group-flush border-0">
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input payment" id="cash"
                                            name="cash" value="true"
                                            @if ($store->cash == 1) checked @endif>
                                        <label class="custom-control-label" for="cash">Cash</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input payment" id="cashless"
                                            name="cashless" value="true"
                                            @if ($store->cashless == 1) checked @endif>
                                        <label class="custom-control-label" for="cashless">Cashless</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <label for="">GCash QR Code</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="gcashFile" name="gcash">
                                        <label class="custom-file-label" for="gcashFile" id="gcashFileName">Choose
                                            file</label>
                                    </div>
                                    @error('gcash')
                                        {{ $message }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                    </div>{{-- END OF PAYMENT METHODS --}}
                </div> {{-- END OF SECOND ROW --}}
                <div class="row d-flex justify-content-center my-3">
                    <input type="number" value="{{ $store->laundry_id }}" class="d-none" name="laundry_id">
                    <button type="button" class="btn btn-primary w-50 p-2 font-weight-bold" id="submitEditLaundry">Edit
                        Laundry Shop</button>
                </div>
    </form>
    </div>
    </div>
    <script>
        $("#submitEditLaundry").click(function() {
            if ($('#editForm input:checked').length > 0) {
                swal({
                    icon: "success",
                    title: "Laundry Edited!",
                    text: "The laundry shop has been successfully edited!",
                    buttons: false,
                }).then(() => {
                    $("#editForm").submit()
                })
            } else {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please make sure you check at least one box in both accomodations and payment method!",
                    buttons: false
                })
            }
        })
    </script>
    @endif
@empty
    <div class="container">
        <div class="card">
            <div class="card-header text-dark">
                Nothing to publish!
            </div>
            <div class="card-body text-dark">
                Add more stores to be published!
            </div>
        </div>
    </div>
    @endforelse

    <script src="{{ asset('js/time.js') }}"></script>
    <script>
        $('#fileLogo').change(function(e) {
            var fileName = e.target.files[0].name;
            $('#fileLogoName').html(fileName);
        });
        $('#gcashFile').change(function(e) {
            var fileName = e.target.files[0].name;
            $('#gcashFileName').html(fileName);
        });
    </script>
    {{-- <div class="rounded-circle d-flex justify-content-center align-items-center">
            test
        </div> --}}
    </div>
@endsection
