@extends('layouts.master')

@section('content')
    <script src="{{ asset('js/reservation.js') }}" defer></script>
    <div class="d-flex mx-4 justify-content-between">
        <div class="h4 text-dark">View Time Slots</div>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addReservationModal">Add Slot</button>
    </div>

    {{-- MODAL FOR ADDING SLOTS --}}
    <input type="text" class="d-none" id="openingTime" value="{{ $laundry_info[0]->opening_time }}">
    <input type="text" class="d-none" id="closingTime" value="{{ $laundry_info[0]->closing_time }}">
    <div class="modal fade" id="addReservationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="text" id="laundryId" value="{{ $laundry_id }}" class='d-none'>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Time Start</label>
                            <div class="col-sm-9">
                                <input type="time" class="form-control" id="slotTimeStart">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Time End</label>
                            <div class="col-sm-9">
                                <input type="time" class="form-control" id="slotTimeEnd">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addTimeSlotButton">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mx-4 my-2">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Slot</th>
                    <th scope="col">Time Start</th>
                    <th scope="col">Time End</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($time_slots as $time_slot)
                    <tr>
                        <th scope="row">1</th>
                        <td id="timeStartRow{{ $time_slot->id }}">{{ $time_slot->time_start }}</td>
                        <td id="timeEndRow{{ $time_slot->id }}">{{ $time_slot->time_end }}</td>
                        <td>
                            <button class="btn btn-danger" id="timeSlotDelete{{ $time_slot->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd"
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    <script>
                        // $(document).ready(function() {
                        //     const timeStart = moment($("#timeStartRow{{ $time_slot->id }}").html()).format('h:mmA')
                        //     const timeEnd = moment($("#timeEndRow{{ $time_slot->id }}").html()).format('h:mmA')

                        //     $("#timeStartRow{{ $time_slot->id }}").text(timeStart)
                        //     $("#timeEndRow{{ $time_slot->id }}").text(timeEnd)
                        // })
                        $("#timeSlotDelete{{ $time_slot->id }}").click(function() {
                            swal({
                                icon: "warning",
                                title: "Delete Time Slot?",
                                text: "Are you sure you want to delete this time slot?",
                                buttons: {
                                    cancel: "Cancel",
                                    true: "OK"
                                }
                            }).then(response => {
                                if (response == 'true') {
                                    swal({
                                        icon: "success",
                                        title: "Time Slot Deleted!",
                                        text: "The time slot has been deleted!",
                                        buttons: false
                                    }).then(response => {
                                        const formdata = new FormData()
                                        formdata.append('id', "{{ $time_slot->id }}")
                                        axios.post('/deletetimeslot', formdata)
                                            .then(response => {
                                                location.reload()
                                            })
                                    })
                                }
                            })
                        })
                    </script>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex mx-4 justify-content-between">
        <div class="h4 text-dark">View Reservations</div>
    </div>
    <table class="table mx-4">
        <thead>
            <tr>
                <th scope="col">Machine</th>
                <th scope="col">User</th>
                <th scope="col">Reservation Date</th>
                <th scope="col">Time Start</th>
                <th scope="col">Time End</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <th scope="row">{{ $reservation->machine_name }}</th>
                    <td>{{ $reservation->reservation_date }}</td>
                    <td>{{ $reservation->first_name }} {{ $reservation->last_name }}</td>
                    <td>{{ $reservation->time_start }}</td>
                    <td>{{ $reservation->time_end }}</td>
                    <td>
                        <button class="btn btn-success" id="successReservation{{ $reservation->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                            </svg>
                        </button>
                        <button class="btn btn-danger" id="cancelReservation{{ $reservation->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </button>
                    </td>
                </tr>
                <script>
                    $("#cancelReservation{{ $reservation->id }}").click(function() {
                        swal({
                            icon: "warning",
                            title: "Cancel Reservation?",
                            text: "Are you sure you want to cancel the reservation?",
                            buttons: {
                                cancel: "Cancel",
                                true: "OK"
                            }
                        }).then(response => {
                            if (response == 'true') {
                                const formdata = new FormData()
                                formdata.append('id', '{{ $reservation->id }}')
                                axios.post('/cancelreservation', formdata)
                                    .then(response => {
                                        swal({
                                            icon: "success",
                                            title: "Reservation Cancelled!",
                                            text: "The reservation has been cancelled!",
                                            buttons: false,
                                        }).then(response => {
                                            location.reload()
                                        })
                                    })
                            }
                        })
                    })

                    $("#successReservation{{ $reservation->id }}").click(function() {
                        swal({
                            icon: "warning",
                            title: "Process the Reservation?",
                            text: "Are you sure you want to process the reservation?",
                            buttons: {
                                cancel: "Cancel",
                                true: "OK"
                            }
                        }).then(response => {
                            if (response == 'true') {
                                swal({
                                    icon: "success",
                                    title: "Successfully Processed!",
                                    text: "The reservation has pushed through!",
                                    buttons: false
                                }).then(response => {
                                    const formdata = new FormData()
                                    formdata.append('id', "{{ $reservation->id }}")
                                    axios.post('/processreservation', formdata)
                                        .then(response => {
                                            location.reload()
                                        })
                                })
                            }
                        })
                    })
                </script>
            @endforeach
        </tbody>
    </table>
@endsection
