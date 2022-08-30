@extends('layouts.app')
@section('content')
    <div class="w-full h-full pb-8">
        <div class="flex justify-center mt-4 w-full">
            <div class="text-2xl">
                Cart
            </div>
        </div>

        <table id="receiptTable" class="hidden">
            <tbody>

            </tbody>
        </table>
        <table id="deleteTable" class="hidden">
            <tbody>

            </tbody>
        </table>

        <div class="hidden" id="totalPrice">0</div>
        <div id="numRows" class="hidden">0</div>

        <div class="flex justify-center w-full">
            <div class="h-full grid grid-cols-1 space-y-5 w-full">
                @forelse ($items as $item)
                    <div class="flex justify-center w-full">
                        {{-- START CARD --}}
                        <div class="flex card w-[20%] p-2">
                            {{-- <div class="flex justify-start">
                                <div class="text-xl">{{ $item->item_name }}</div>
                            </div> --}}
                            <div class="flex justify-end mb-3">
                                <button class="btn-danger" id="delete{{ $item->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex justify-start flex-col">
                                <div class="text-xl" id="itemName{{ $item->id }}">{{ $item->item_name }}</div>
                                <div class="text-sm text-gray-500">P<span
                                        id="itemPrice{{ $item->id }}">{{ $item->item_price }}</span></div>
                            </div>
                        </div>
                    </div>

                    <script>
                        $(document).ready(() => {
                            const price = parseInt($("#itemPrice{{ $item->id }}").text())
                            let totalPrice = parseInt($("#totalPrice").text())
                            const currVal = Number($("#numRows").text())

                            totalPrice = totalPrice + price
                            $("#totalPrice").html(totalPrice)

                            $("#numRows").html(currVal + 1)

                            const numRows = Number($("#numRows").text())

                            $("#receiptTable > tbody:last-child").append(
                                '<tr>' +
                                '<td id="name' + numRows + '">{{ $item->item_name }}</td>' +
                                '<td id="price' + numRows + '">{{ $item->item_price }}</td>' +
                                '<tr>'
                            )
                            $("#deleteTable > tbody:last-child").append(
                                '<tr>' +
                                '<td id="id' + numRows + '">{{ $item->id }}</td>' +
                                '<tr>'
                            )
                        })
                        $("#delete{{ $item->id }}").click(() => {
                            swal({
                                icon: "warning",
                                title: "Remove Item?",
                                text: "Are you sure you want to remove the item?",
                                buttons: {
                                    true: "OK",
                                    cancel: "Cancel"
                                }
                            }).then(response => {
                                if (response == 'true') {
                                    const formdata = new FormData()
                                    formdata.append('id', '{{ $item->id }}')
                                    axios.post('/customer/deleteitem', formdata)
                                        .then(() => {
                                            swal({
                                                icon: "success",
                                                title: "Item Removed!",
                                                text: "The item has been removed from your cart!",
                                                buttons: false
                                            }).then(() => {
                                                location.reload()
                                            })
                                        })
                                }
                            })
                        })
                    </script>
                @empty
                    <div class="flex justify-center">
                        <div class="card">
                            <div class="card-title text-blue-800">No items yet!</div>
                            <div class="text-base text-blue-800">Add an item in your laundry </div>
                        </div>
                    </div>
                @endforelse
                <div class="flex justify-center w-full space-x-2">
                    <button class="bg-blue-500 text-white w-[10%] hover:bg-blue-700 duration-150 rounded-md py-2" id="pickUpButton"
                        data-bs-toggle="modal" data-bs-target="#pickUpModal">
                        Pick-Up Location
                    </button>
                    <div class="modal fade" id="pickUpModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pick-Up</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-auto">
                                            <label for="inputPassword6" class="col-form-label">Location: </label>
                                        </div>
                                        <div class="col-auto">
                                            <div class="text-xs">{{ $address->street }},
                                                Barangay {{ Str::substr($address->barangay, 9) }},
                                                {{ Str::substr($address->city, 6) }}</div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center">

                                        <div class="col-auto">
                                            <label for="inputPassword6" class="col-form-label">Segregation: </label>
                                        </div>
                                        <div class="col-auto">
                                            <select class="border-2 border-gray-300" name="segregation" id="segregation">
                                                <option value="Whites">Whites</option>
                                                <option value="Mixed">Mixed</option>
                                                <option value="Delicates">Delicates</option>
                                                <option value="Colors">Colors</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                        class="px-2 py-1 rounded-md hover:bg-gray-800 bg-gray-600 text-white duration-150"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="button"
                                        class="px-2 py-1 rounded-md hover:bg-blue-700 bg-blue-500 text-white duration-150"
                                        id="submitPickup">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="bg-green-500 hover:bg-green-700 duration-150 rounded-md py-2 text-white w-[10%]" id="reservationButton"
                        data-bs-toggle="modal" data-bs-target="#reserveModal">
                        Reserve
                    </button>
                    <div class="modal fade" id="reserveModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Reservation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="grid grid-cols-4 my-2">
                                        <div class="col-span-1">
                                            <div class="text-base">Time Slot: </div>
                                        </div>
                                        <div class="col-span-3 w-full">
                                            <select id="timeslot" class="border-2 border-gray-300 w-full">
                                                @forelse ($time_slots as $time_slot)
                                                    <option>{{ $time_slot->time_start }} - {{ $time_slot->time_end }}</option>
                                                @empty
                                                    <option value="">No machines yet</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-4 my-2">
                                        <div class="col-span-1">
                                            <div class="text-base">Wash Machine: </div>
                                        </div>
                                        <div class="col-span-3 w-full">
                                            <select id="washMachine" class="border-2 border-gray-300 w-full">
                                                @forelse ($machines as $machine)
                                                    @if ($machine->machine_service == 'Wash')
                                                        <option value="{{ $machine->id }}">{{ $machine->machine_name }}</option>
                                                    @endif
                                                @empty
                                                    <option value="">No machines yet</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-4 my-2">
                                        <div class="col-span-1">
                                            <div class="text-base">Dry Machine: </div>
                                        </div>
                                        <div class="col-span-3 w-full">
                                            <select id="dryMachine" class="border-2 border-gray-300 w-full">
                                                @forelse ($machines as $machine)
                                                    @if ($machine->machine_service == 'Dry')
                                                        <option value="{{ $machine->id }}">{{ $machine->machine_name }}</option>
                                                    @endif
                                                @empty
                                                    <option value="">No machines yet</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                        class="px-2 py-1 rounded-md hover:bg-gray-800 bg-gray-600 text-white duration-150"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button"
                                        class="px-2 py-1 rounded-md hover:bg-blue-700 bg-blue-500 text-white duration-150"
                                        id="submitReservation">Save
                                        changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let numRows = ""
        let reservationCount = 0
        $(document).ready(() => {
            numRows = $("#numRows").text()

            if(numRows == 0) {
                $('#pickUpButton').prop('disabled', true)
                $('#pickUpButton').addClass('bg-gray-400')
                $('#pickUpButton').removeClass('hover:bg-blue-700')
                $('#reservationButton').prop('disabled', true)
                $('#reservationButton').addClass('bg-gray-400')
                $('#reservationButton').removeClass('hover:bg-green-700')
            }
        })

        $("#submitPickup").click(() => {
            swal({
                icon: "warning",
                title: "Submit Pick Up?",
                text: "Make sure that you have finalized your order!",
                buttons: {
                    cancel: "Cancel",
                    true: "OK"
                }
            }).then(response => {
                if (response == 'true') {
                    const totalPrice = $("#totalPrice").text()
                    const segregation = $("#segregation").find(':selected').text()
                    const formdata = new FormData()
                    formdata.append('laundry_id', "{{ $laundry_id }}")
                    formdata.append('user_id', "{{ Auth::guard('customer')->user()->id }}")
                    formdata.append('first_name', "{{ Auth::guard('customer')->user()->first_name }}")
                    formdata.append('middle_name', "{{ Auth::guard('customer')->user()->middle_name }}")
                    formdata.append('last_name', "{{ Auth::guard('customer')->user()->last_name }}")
                    formdata.append('total_price', totalPrice)
                    formdata.append('mode_of_payment', 'cashless')
                    formdata.append('commodity_type', 'Pick-up')
                    formdata.append('segregation_type', segregation)
                    formdata.append('status', 'Pending')
                    axios.post('/customer/submitpickup', formdata)
                        .then(response => {
                            for (let i = 1; i <= numRows; i++) {
                                const itemsFormdata = new FormData()
                                itemsFormdata.append('mobile_order_id', response.data)
                                itemsFormdata.append('item_name', $("#name" + i).text())
                                itemsFormdata.append('item_price', $("#price" + i).text())
                                axios.post('/customer/ordereditems', itemsFormdata)
                                    .then(() => {
                                        const deleteFormdata = new FormData()
                                        deleteFormdata.append('id', $("#id" + i).text())
                                        axios.post('/customer/deleteitem', deleteFormdata)
                                    })
                            }
                            swal({
                                icon: "success",
                                title: "Ordered Successfully!",
                                text: "Order successfully submitted!",
                                buttons: false,
                            }).then(() => {
                                location.reload()
                            })
                        })
                }
            })
        })

        $("#submitReservation").click(() => {
            swal({
                icon: "warning",
                title: "Submit Reservation?",
                text: "Are you sure you want to submit the reservation?",
                buttons: {
                    true: "OK",
                    cancel: "Cancel"
                }
            }).then(response => {
                if (response == 'true') {
                    const getAllReservationForm = new FormData();
                    const segregation = $("#segregationReservation").find(':selected')
                        .text()
                    const timeslot = $("#timeslot").find(':selected').text()
                    const washId = $("#washMachine").find(':selected').val()
                    const dryId = $("#dryMachine").find(':selected').val()
                    getAllReservationForm.append("laundry_id", "{{ $laundry_id }}")
                    axios.post('/api/getallreservation', getAllReservationForm)
                        .then(response => {
                            if (response.data.length != 0) {
                                const allReservation = response.data
                                allReservation.map((item, id) => {
                                    if( 
                                        timeslot.substring(0,7) == item.time_start &&
                                        timeslot.substring(10, 17) == item.time_end &&
                                        washId == item.machine_id &&
                                        moment().add(1, 'days').format('MM-DD-YYYY') == item.reservation_date
                                        ) {
                                            swal({
                                                icon: 'error',
                                                title: "Error!",
                                                text: "Washing Machine reservation slot is already occupied!",
                                                buttons: false
                                            })
                                        } else if (
                                            timeslot.substring(0,7) == item.time_start &&
                                            timeslot.substring(10, 17) == item.time_end &&
                                            dryId == item.machine_id &&
                                            moment().add(1, 'days').format('MM-DD-YYYY') == item.reservation_date
                                        ) {
                                            swal({
                                                icon: "error",
                                                title: "Error!",
                                                text: "Drying Machine reservation slot is already occupied!",
                                                buttons: false
                                            })
                                        } else {
                                            if (id == 1) {
                                                swal({
                                                    icon: 'success',
                                                    title: "Success!",
                                                    text: "The slot has been reserved! Please make sure you come on the given time frame!",
                                                    buttons: false
                                                }).then(() => {
                                                    const washReservation = new FormData()
                                                    washReservation.append('laundry_id', "{{ $laundry_id }}")
                                                    washReservation.append('user_id', '{{ Auth::guard("customer")->user()->id }}')
                                                    washReservation.append('machine_id', washId)
                                                    washReservation.append('reservation_date', moment().add(1, 'days').format("MM-DD-YYYY"))
                                                    washReservation.append('time_start', timeslot.substring(0, 7))
                                                    washReservation.append('time_end', timeslot.substring(10, 17))
                                                    washReservation.append('status', 'Pending');
                                                    axios.post('/api/createreservation', washReservation)
                                                        .then(response => {
                                                            console.log(response.data)
                                                        })

                                                    const dryReservation = new FormData()
                                                    dryReservation.append('laundry_id', "{{ $laundry_id }}")
                                                    dryReservation.append('user_id', "{{ Auth::guard('customer')->user()->id }}")
                                                    dryReservation.append('machine_id', dryId)
                                                    dryReservation.append('reservation_date', moment().add(1, 'days').format('MM-DD-YYYY'))
                                                    dryReservation.append('time_start', timeslot.substring(0, 7))
                                                    dryReservation.append('time_end', timeslot.substring(10, 17))
                                                    dryReservation.append('status', "Pending")
                                                    axios.post('/api/createreservation', dryReservation)
                                                        .then(response => {
                                                            location.reload()
                                                        })
                                                })
                                            }
                                        }
                                })
                            } else {
                                const allReservation = response.data
                                // console.log(washName)
                                // console.log(dryName)

                                swal({
                                    icon:'success',
                                    title: "Success!",
                                    text: "The slot has been reserved! Please make sure you come on the given time frame!",
                                    buttons: false
                                }).then(() => {
                                    const washReservation = new FormData()
                                    washReservation.append('laundry_id', "{{ $laundry_id }}")
                                    washReservation.append('user_id', '{{ Auth::guard("customer")->user()->id }}')
                                    washReservation.append('machine_id', washId)
                                    washReservation.append('reservation_date', moment().add(1, 'days').format("MM-DD-YYYY"))
                                    washReservation.append('time_start', timeslot.substring(0, 7))
                                    washReservation.append('time_end', timeslot.substring(10, 17))
                                    washReservation.append('status', "Pending")
                                    axios.post('/api/createreservation', washReservation)
                                        .then(response => {
                                            console.log(response.data)
                                        })

                                    const dryReservation = new FormData()
                                    dryReservation.append('laundry_id', "{{ $laundry_id }}")
                                    dryReservation.append('user_id', "{{ Auth::guard('customer')->user()->id }}")
                                    dryReservation.append('machine_id', dryId)
                                    dryReservation.append('reservation_date', moment().add(1, 'days').format('MM-DD-YYYY'))
                                    dryReservation.append('time_start', timeslot.substring(0, 7))
                                    dryReservation.append('time_end', timeslot.substring(10, 17))
                                    dryReservation.append('status', "Pending")
                                    axios.post('/api/createreservation', dryReservation)
                                        .then(response => {
                                            for (let i = 1; i <= numRows; i++) {
                                                const deleteFormdata = new FormData()
                                                deleteFormdata.append('id', $("#id" + i).text())
                                                axios.post('/customer/deleteitem', deleteFormdata)
                                            }
                                            location.reload()
                                        })
                                })
                            }
                        })
                }
            })
        })
    </script>
@endsection
