@extends('layouts.app')

@section('content')
    <div class="h-full pb-8">
        <div class="flex justify-center bg-center h-48"
            style="background-image: url('{{ asset('storage/laundry_img_pics/' . $laundry->user_id . '/' . $laundry->laundry_img) }}')">
        </div>
        <div class="mx-6 my-2">
            <div class="text-3xl font-bold">{{ $laundry->name }}</div>
            <div class="text-base text-gray-400"><span
                    id="openTime{{ $laundry->laundry_id }}">{{ $laundry->opening_time }}</span> - <span
                    id="closeTime{{ $laundry->laundry_id }}">{{ $laundry->closing_time }}</span></div>
            <div class="text-base">{{ Str::substr($laundry->city, 6) }}, Brgy.{{ Str::substr($laundry->barangay, 9) }},
                {{ $laundry->street }}</div>
        </div>
        {{-- MAIN SERVICES --}}
        <hr class="my-8">
        <div class="flex items-center flex-col w-full">
            <div class="text-2xl mb-4">Main Services</div>
            <div class="flex justify-center w-[90%] mt-2">

                <div class="grid grid-cols-2 w-full gap-x-4">
                    @forelse ($main_services as $main_service)
                        <div class="cols-span-1 w-[90%]">
                            <div class="flex w-full">
                                <div class="flex flex-col items-start w-full">
                                    <div class="text-lg">
                                        {{ $main_service->main_serv_name }}
                                    </div>
                                    <div class="text-base text-gray-400">
                                        P{{ $main_service->main_serv_price }} - {{ $main_service->main_serv_max_kg }}KG
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="btn btn-primary" id="mainServ{{ $main_service->id }}">Add to Cart</div>
                                </div>
                            </div>
                        </div>

                        <script>
                            $("#mainServ{{ $main_service->id }}").click(() => {
                                const formdata = new FormData()
                                formdata.append('laundry_id', "{{ $laundry->laundry_id }}")
                                formdata.append('user_id', "{{ Auth::guard('customer')->user()->id }}")
                                formdata.append('item_name', '{{ $main_service->main_serv_name }}')
                                formdata.append('item_price', '{{ $main_service->main_serv_price }}')
                                axios.post('/customer/addtocart', formdata)
                                    .then(response => {
                                        console.log(response.data)
                                        swal({
                                            icon: "success",
                                            title: "Item Added!",
                                            text: "The item has been added to the cart!",
                                            buttons: false,
                                        })
                                    })
                            })
                        </script>
                    @empty
                        <div class="cols-span-2 w-[90%]">
                            <div class="flex justify-center">
                                <div class="text-lg">
                                    No Services yet!
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Additional Services --}}
        <hr class="my-8">
        <div class="flex items-center flex-col w-full">
            <div class="text-2xl mb-4">Additional Services</div>
            <div class="flex justify-center w-[90%] mt-2">
                <div class="grid grid-cols-2 w-full gap-x-4">
                    @forelse ($additional_services as $additional_service)
                        <div class="cols-span-1 w-[90%]">
                            <div class="flex w-full">
                                <div class="flex flex-col items-start w-full">
                                    <div class="text-lg">{{ $additional_service->add_serv_name }}</div>
                                    <div class="text-base text-gray-500">P{{ $additional_service->add_serv_price }}</div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="btn btn-primary" id="addServ{{ $additional_service->id }}">Add to Cart
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $("#addServ{{ $additional_service->id }}").click(() => {
                                const formdata = new FormData()
                                formdata.append('laundry_id', "{{ $laundry->laundry_id }}")
                                formdata.append('user_id', "{{ Auth::guard('customer')->user()->id }}")
                                formdata.append('item_name', '{{ $additional_service->add_serv_name }}')
                                formdata.append('item_price', '{{ $additional_service->add_serv_price }}')
                                axios.post('/customer/addtocart', formdata)
                                    .then(response => {
                                        console.log(response.data)
                                        swal({
                                            icon: "success",
                                            title: "Item Added!",
                                            text: "The item has been added to the cart!",
                                            buttons: false,
                                        })
                                    })
                            })
                        </script>
                    @empty
                        <div class="cols-span-2 w-[90%]">
                            <div class="flex justify-center">
                                <div class="text-lg">
                                    No Services yet!
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- ADDITIONAL PRODUCTS --}}
        <hr class="my-8">
        <div class="flex items-center flex-col w-full">
            <div class="text-2xl mb-4">Additional Products</div>
            <div class="flex justify-center w-[90%] mt-2">
                <div class="grid grid-cols-2 w-full gap-x-4">
                    @forelse ($additional_products as $additional_product)
                        <div class="cols-span-1 w-[90%]">
                            <div class="flex w-full">
                                <div class="flex flex-col items-start w-full">
                                    <div class="text-lg">
                                        {{ $additional_product->add_prod_name }}
                                    </div>
                                    <div class="text-base text-gray-400">
                                        P{{ $additional_product->add_prod_price }}
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="btn btn-primary" id="addProd{{ $additional_product->id }}">
                                        Add to Cart
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $("#addProd{{ $additional_product->id }}").click(() => {
                                const formdata = new FormData()
                                formdata.append('user_id', "{{ Auth::guard('customer')->user()->id }}")
                                formdata.append('laundry_id', "{{ $laundry->laundry_id }}")
                                formdata.append('item_name', '{{ $additional_product->add_prod_name }}')
                                formdata.append('item_price', '{{ $additional_product->add_prod_price }}')
                                axios.post('/customer/addtocart', formdata)
                                    .then(response => {
                                        console.log(response.data)
                                        swal({
                                            icon: "success",
                                            title: "Item Added!",
                                            text: "The item has been added to the cart!",
                                            buttons: false,
                                        })
                                    })
                            })
                        </script>
                    @empty
                        <div class="cols-span-2 w-[90%]">
                            <div class="flex justify-center">
                                <div class="text-lg">
                                    No Services yet!
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        {{-- MACHINES --}}
        <hr class="my-8">
        <div class="flex items-center flex-col w-full">
            <div class="text-2xl mb-4">Machines</div>
            <div class="flex justify-center w-[90%] mt-2">
                <div class="grid grid-cols-2 w-full gap-x">
                    @forelse ($machines as $machine)
                        <div class="cols-span-1 w-[90%]">
                            @if ($machine->status == 0)
                                <div class="col mb-4">
                                    <div class="card h-100 bg-success text-white" id="M{{ $machine->id }}">
                                        <div class="card-body ">
                                            <h2 class="card-title d-flex justify-content-center align-items-center">
                                                {{ $machine->machine_name }}
                                            </h2>
                                            <div class="card-footer text-center" style="background-color: transparent;">
                                                <span class="badge badge-success"
                                                    id="machineAvailability{{ $machine->id }}">Available</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col mb-4">
                                    <div class="card h-100 bg-success text-white" id="M{{ $machine->id }}">
                                        <div class="card-body ">
                                            <h2 class="card-title d-flex justify-content-center align-items-center">
                                                {{ $machine->machine_name }}
                                            </h2>
                                            <div class="card-footer text-center" style="background-color: transparent;">
                                                <span class="badge badge-success"
                                                    id="machineAvailability{{ $machine->id }}">Available</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
        <a href="{{ route('customer.cart', $laundry->id) }}">
            <div class="sticky bottom-3 float-right mr-10 bg-sky-900 p-3 rounded-full text-white cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart"
                    viewBox="0 0 16 16">
                    <path
                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
            </div>
        </a>
    </div>

    <script>
        $(document).ready(() => {
            const openTime = $("#openTime{{ $laundry->laundry_id }}").html()
            const closeTime = $("#closeTime{{ $laundry->laundry_id }}").html()
            const formattedOpen = moment(openTime).format('h:mm A')
            const formattedClose = moment(closeTime).format('h:mm A')
            $("#openTime{{ $laundry->laundry_id }}").text(formattedOpen)
            $("#closeTime{{ $laundry->laundry_id }}").text(formattedClose)
        })
    </script>
@endsection
