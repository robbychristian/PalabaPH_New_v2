@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-center font-weight-bold h3" style="color: #000">
            Manage Store
        </div>
        @forelse ($storeOwned as $store)
            <div class="row">
                <div class="col-sm-12 col-md-6 d-flex flex-column align-items-center card py-5">
                    {{-- START OF NAME TO CONTACT NO --}}
                    <div class="h4 font-weight-bold mb-4" style="color: #000; letter-spacing: -1.5px">Store Information</div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center rounded-circle">
                            <img class="img-fluid" src="{{ asset('images/PalabaPH-Icon.png') }}" alt="No image" />
                        </div>
                        <div class="col-sm-12 col-md-8 d-flex d-flex flex-column">
                            <div class="p"><span class="font-weight-bold mx-1" style="color: #000">Store
                                    Name:</span>
                                <span class="mx-1" style="color: #8C8B96">{{ $store->name }}</span>
                            </div>
                            <div class="p"><span class="font-weight-bold mx-1"
                                    style="color: #000">Address:</span>
                                <span class="mx-1" style="color: #8C8B96">
                                    {{ $store->street }},
                                    {{ Str::substr($store->barangay, 9, Str::of($store->barangay)->length()) }},
                                    {{ Str::substr($store->city, 6, Str::of($store->city)->length()) }},
                                    {{ Str::substr($store->state, 4, Str::of($store->state)->length()) }}
                                </span>
                            </div>
                            <div class="p"><span class="font-weight-bold mx-1"
                                    style="color: #000">Landline:</span>
                                <span class="mx-1" style="color: #8C8B96">
                                    {{ $store->landline }}
                                </span>
                            </div>
                            <div class="p"><span class="font-weight-bold mx-1" style="color: #000">Contact
                                    No.:</span>
                                <span class="mx-1" style="color: #8C8B96">
                                    {{ $store->phone }}
                                </span>
                            </div>
                        </div>
                    </div>
                    {{-- START OF NAME TO CONTACT NO --}}
                    {{-- START OF DESCRIPTION --}}
                    <div class="d-flex flex-column mb-3 align-items-center">
                        <div class="p" style="color: #000">Description:</div>
                        <div class="mx-2">{{ $store->description }}</div>
                    </div>
                    <div class="d-flex flex-row justify-content-center mb-3 align-items-center">
                        <div class="mx-2 p" style="color: #000">Type of Laundry Shop:</div>
                        <div class="mx-2">{{ $store->type_of_laundry }}</div>
                    </div>
                    <div class="d-flex flex-row justify-content-center mb-3 align-items-center">
                        <div class="p" style="color: #000">Time Open:</div>
                        <div class="mx-2" id="openingTime">
                            {{ $store->opening_time }}</div>
                    </div>
                    <div class="d-flex flex-row justify-content-center mb-3 align-items-center">
                        <div class="p" style="color: #000">Time Close:</div>

                        <div class="mx-2" id="closingTime">{{ $store->closing_time }}</div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 d-flex flex-column align-items-center card py-5">
                    <form class="col-sm-12 col-md-6 d-flex flex-column align-items-center" method="POST"
                        action="{{ route('client.storelaundry') }}">
                        @csrf
                        @method('POST')
                        <div class="h4 font-weight-bold " style="color: #000; letter-spacing: -1.5px">Service Types</div>
                        <div class="row my-2 d-flex justify-content-around">
                            <div class="col-xs-3 d-flex align-items-center"><input type="checkbox" value='true'
                                    name="self_service" id="">
                            </div>
                            <div class="col-xs-9 d-flex align-items-center">Self-Service (Walk Ins)</div>
                        </div>
                        <div class="row my-2 d-flex justify-content-around">
                            <div class="col-xs-3 d-flex align-items-center"><input type="checkbox" value='true'
                                    name="full_service" id="">
                            </div>
                            <div class="col-xs-9 d-flex align-items-center">Full-Service (Drop Offs)</div>
                        </div>
                        <div class="row my-2 d-flex justify-content-around">
                            <div class="col-xs-3 d-flex align-items-center"><input type="checkbox" value='true'
                                    name="pickup" id=""></div>
                            <div class="col-xs-9 d-flex align-items-center">Pick up and Deliveries</div>
                        </div>
                        <div class="row my-2 d-flex justify-content-around">
                            <div class="col-xs-3 d-flex align-items-center"><input type="checkbox" value='true'
                                    name="reservation" id="">
                            </div>
                            <div class="col-xs-9 d-flex align-items-center">Reservations</div>
                        </div>
                        <div class="h4 font-weight-bold mt-2 " style="color: #000; letter-spacing: -1.5px">Payment Methods
                        </div>
                        <div class="row my-2 d-flex justify-content-around">
                            <div class="col-xs-3 d-flex align-items-center">
                                <input type="checkbox" value='true' name="cash" id="">
                            </div>
                            <div class="col-xs-9 d-flex align-items-center">Cash</div>
                        </div>
                        <div class="row my-2 d-flex justify-content-around">
                            <div class="col-xs-3 d-flex align-items-center"><input type="checkbox" value='true'
                                    name="cashless" id=""></div>
                            <div class="col-xs-9 d-flex align-items-center">Cashless</div>
                        </div>
                        <div class="h4 font-weight-bold mt-2" style="color: #000; letter-spacing: -1.5px">GCash QR Code
                        </div>
                        <div class="d-flex">
                            <input type="file" name="gcash"
                                class="mt-1 px-3 py-2 border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                            @error('gcash')
                                {{ $message }}
                            @enderror
                        </div>
                </div>
            </div>
            {{-- Submit button --}}
            <div class="row d-flex justify-content-center my-5">
                <input type="number" value="{{ $store->laundry_id }}" class="d-none" name="laundry_id">
                <button type="submit" class="btn btn-primary w-50 p-2 font-weight-bold"
                    href="{{ route('client.storelaundry') }}">Publish
                    Laundry Shop</button>
            </div>
            </form>
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
        {{-- <div class="rounded-circle d-flex justify-content-center align-items-center">
            test
        </div> --}}
    </div>
@endsection
