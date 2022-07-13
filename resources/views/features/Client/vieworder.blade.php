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
            <div class="card-header text-primary font-weight-bold h5">Machines Occupied</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" width="100%" cellspacing="0" style="color:#464646 !important">
                        <thead>
                            <tr>
                                <th>Machine</th>
                                <th>Occupied By</th>
                                <th>Status</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($machines as $machine)
                                @if ($machine->machine_status === 'pending')
                                    <span class="d-none"
                                        id="machineOccupancyId{{ $machine->id }}">{{ $machine->id }}</span>
                                    <span class="d-none"
                                        id="machineId{{ $machine->machine_id }}">{{ $machine->machine_id }}</span>
                                    <tr>
                                        <th>{{ $machine->machine_name }} <span class="d-none"
                                                id="machineService{{ $machine->id }}">{{ $machine->machine_service }}</span>
                                        </th>
                                        <th>{{ $machine->first_name }} {{ $machine->middle_name }}
                                            {{ $machine->last_name }}</th>
                                        <th>
                                            @if ($machine->machine_status === 'pending')
                                                On Going
                                            @else
                                                Done
                                            @endif
                                        </th>
                                        <th id="machineTimer{{ $machine->id }}"></th>
                                        <th id="numOfDryMachine" class="d-none">0</th>
                                    </tr>
                                    <script>
                                        let dryMachineCount{{ $machine->id }} = 0;
                                        const countdown{{ $machine->id }} = setInterval(() => {
                                            const machineService = $("#machineService{{ $machine->id }}").html()
                                            if (machineService === 'Wash') {
                                                const machineOccupancyId = $("#machineOccupancyId{{ $machine->id }}").html()
                                                const machineId = $("#machineId{{ $machine->machine_id }}").html()
                                                const timeStart = moment()
                                                const timeEnd = moment('{{ $machine->time_end }}')
                                                const timeDiff = moment(timeEnd).diff(timeStart, 's')
                                                const duration = moment.duration(timeEnd.diff(timeStart))
                                                const durationMinutes = duration.minutes()
                                                const durationSeconds = duration.seconds()
                                                $("#machineTimer{{ $machine->id }}").text(durationMinutes + ":" + durationSeconds)
                                                if (durationMinutes <= 0 && durationSeconds <= 0) {
                                                    const formdata = new FormData()
                                                    formdata.append('machine_occupancy_id', machineOccupancyId);
                                                    formdata.append('machine_id', machineId);
                                                    console.log(machineOccupancyId)
                                                    axios.post('/closemachinestate', formdata)
                                                        .then(response => {
                                                            location.reload();
                                                        })
                                                    clearInterval(countdown{{ $machine->id }})
                                                }
                                            } else if (machineService === "Dry") {
                                                dryMachineCount{{ $machine->id }} += 1;
                                                $("#numOfDryMachine").text(dryMachineCount{{ $machine->id }});
                                                $("#machineTimer{{ $machine->id }}").append(
                                                    "<button type='button' class='btn btn-warning' id='startCount" +
                                                    {{ $machine->id }} +
                                                    "'>Start Timer</button>"
                                                )
                                                clearInterval(countdown{{ $machine->id }})
                                                $("#startCount" + {{ $machine->id }}).on('click', function() {
                                                    const machineId = $("#machineId{{ $machine->id }}").html()
                                                    const machineOccupancyId = "{{ $machine->id }}"
                                                    const machineTimer = "{{ $machine->machine_timer }}"
                                                    const timeEnd = moment().add(machineTimer, "m");
                                                    const machineFormData = new FormData()
                                                    machineFormData.append('id', machineOccupancyId)
                                                    machineFormData.append('time_end', timeEnd)
                                                    // console.log(machineFormData);
                                                    // console.log(machineTimer);
                                                    // console.log(timeEnd);
                                                    axios.post('/updatedrymachinetime', machineFormData)
                                                        .then(response => {
                                                            location.reload();
                                                        })
                                                })
                                            } else {
                                                const machineOccupancyId = $("#machineOccupancyId{{ $machine->id }}").html()
                                                const machineId = $("#machineId{{ $machine->machine_id }}").html()
                                                const timeStart = moment()
                                                const timeEnd = moment('{{ $machine->time_end }}')
                                                const timeDiff = moment(timeEnd).diff(timeStart, 's')
                                                const duration = moment.duration(timeEnd.diff(timeStart))
                                                const durationMinutes = duration.minutes()
                                                const durationSeconds = duration.seconds()
                                                $("#machineTimer{{ $machine->id }}").text(durationMinutes + ":" + durationSeconds)
                                                if (durationMinutes <= 0 && durationSeconds <= 0) {
                                                    const formdata = new FormData()
                                                    formdata.append('machine_occupancy_id', machineOccupancyId);
                                                    formdata.append('machine_id', machineId);
                                                    console.log(machineId)
                                                    axios.post('/closemachinestate', formdata)
                                                        .then(response => {
                                                            location.reload()
                                                        })
                                                    clearInterval(countdown{{ $machine->id }})
                                                }
                                            }
                                        }, 1000);
                                    </script>
                                @elseif($machine->machine_status === 'Queued')
                                    <span class="d-none"
                                        id="machineOccupancyId{{ $machine->id }}">{{ $machine->id }}</span>
                                    <span class="d-none"
                                        id="machineId{{ $machine->machine_id }}">{{ $machine->machine_id }}</span>
                                    <tr>
                                        <th>{{ $machine->machine_name }} <span class="d-none"
                                                id="machineService{{ $machine->id }}">{{ $machine->machine_service }}</span>
                                        </th>
                                        <th>{{ $machine->first_name }} {{ $machine->middle_name }}
                                            {{ $machine->last_name }}</th>
                                        <th>
                                            @if ($machine->machine_status === 'pending')
                                                On Going
                                            @else
                                                Queued
                                            @endif
                                        </th>
                                        <th id="machineTimer{{ $machine->id }}">
                                            <button type="button" class="btn btn-warning"
                                                id="startCount{{ $machine->id }}">
                                                @if ($machine->machine_service === 'Wash')
                                                    Start Timer
                                                @else
                                                    On Going
                                                @endif
                                            </button>
                                            <button type="button" class="btn btn-danger"
                                                id="cancelMachineQueue{{ $machine->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path
                                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                </svg>
                                            </button>
                                        </th>
                                        <th id="numOfDryMachine" class="d-none">0</th>
                                    </tr>
                                    <script>
                                        $("#startCount{{ $machine->id }}").on('click', function() {
                                            swal({
                                                icon: "warning",
                                                title: "Warning!",
                                                text: "Are you sure you want to start the machine?",
                                                buttons: {
                                                    cancel: "Cancel",
                                                    true: "OK"
                                                }
                                            }).then(response => {
                                                if (response == 'true') {
                                                    swal({
                                                        icon: "success",
                                                        title: "Machine Started!",
                                                        text: "The machine has been removed from the queue!",
                                                        buttons: false
                                                    }).then(response => {
                                                        const machineId = $("#machineId{{ $machine->machine_id }}").html()
                                                        const machineOccupancyId = "{{ $machine->id }}"
                                                        const machineTimer = "{{ $machine->machine_timer }}"
                                                        const timeEnd = moment().add(machineTimer, 'm')
                                                        const queuedFormData = new FormData()
                                                        queuedFormData.append('id', machineOccupancyId)
                                                        queuedFormData.append('machine_id', machineId)
                                                        queuedFormData.append('time_end', timeEnd)

                                                        axios.post('/updateQueuedWashStatus', queuedFormData)
                                                            .then(response => {
                                                                location.reload()
                                                            })
                                                    })
                                                }
                                            })
                                        })

                                        $("#cancelMachineQueue{{ $machine->id }}").click(function() {
                                            swal({
                                                icon: "warning",
                                                title: "Cancel Queue?",
                                                text: "Are you sure you want to cancel the queued machine?",
                                                buttons: {
                                                    cancel: "Cancel",
                                                    true: "OK"
                                                }
                                            }).then(response => {
                                                if (response == 'true') {
                                                    swal({
                                                        icon: "success",
                                                        title: "Queue Cancelled!",
                                                        text: "The queued machine has been successfully voided!",
                                                        buttons: false
                                                    }).then(response => {
                                                        const formdata = new FormData()
                                                        formdata.append('id', "{{ $machine->id }}")
                                                        axios.post('/deletemachine', formdata)
                                                            .then(response => {
                                                                console.log(response.data)
                                                                location.reload();
                                                            })
                                                    })
                                                }
                                            })
                                        })
                                    </script>
                                @endif
                            @endforeach
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
                        <a class="nav-item nav-link" id="nav-dropOff-tab" data-toggle="tab" href="#nav-dropOff"
                            role="tab" aria-controls="nav-dropOff" aria-selected="false">Drop Offs (Full-Service)</a>
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
                                        <th>Name</th>
                                        <th>Laundry Status</th>
                                        <th>Segregation</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Total Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($walkIns as $walkIn)
                                        <tr>
                                            <th>{{ $walkIn->first_name }} {{ $walkIn->middle_name }}
                                                {{ $walkIn->last_name }}</th>
                                            <th>{{ $walkIn->status }}</th>
                                            <th>{{ $walkIn->segregation_type }}</th>
                                            <th>
                                                @if ($walkIn->mode_of_payment === 'cash')
                                                    Cash
                                                @else
                                                    Cashless
                                                @endif
                                            </th>
                                            <th>{{ $walkIn->payment_status }}</th>
                                            <th>P{{ $walkIn->total_price }}</th>
                                            <th><button class="btn btn-primary btn-sm btn-circle"
                                                    id="updatePayment{{ $walkIn->id }}">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-credit-card-2-back-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0V4zm11.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2zM0 11v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1H0z" />
                                                    </svg>

                                                </button>
                                                <button class="btn btn-warning btn-sm btn-circle"
                                                    id="updateLaundryStatus{{ $walkIn->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-bag-check-fill"
                                                        viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                                                    </svg>
                                                </button>
                                                <button class="btn btn-danger btn-sm btn-circle"
                                                    id="deleteOrder{{ $walkIn->id }}"><i
                                                        class="fas fa-trash"></i></button>
                                            </th>
                                        </tr>

                                        <script>
                                            $("#updatePayment{{ $walkIn->id }}").on('click', function() {
                                                swal({
                                                    icon: "warning",
                                                    title: "Update Payment Status?",
                                                    text: "Are you sure you want to update the payment status?",
                                                    buttons: {
                                                        cancel: "Cancel",
                                                        true: "OK"
                                                    }
                                                }).then(response => {
                                                    if (response == 'true') {
                                                        const formdata = new FormData()
                                                        formdata.append('id', "{{ $walkIn->id }}")
                                                        axios.post('/updatepaymentstatus', formdata)
                                                            .then(response => {
                                                                location.reload()
                                                            })
                                                    }
                                                })
                                            })

                                            $("#updateLaundryStatus{{ $walkIn->id }}").on('click', function() {
                                                swal({
                                                    icon: "warning",
                                                    title: "Update Order Status?",
                                                    text: "Are you sure you want to update the order status?",
                                                    buttons: {
                                                        cancel: "Cancel",
                                                        true: "OK"
                                                    }
                                                }).then(response => {
                                                    if (response == 'true') {
                                                        const formdata = new FormData()
                                                        formdata.append("id", '{{ $walkIn->id }}')
                                                        formdata.append('user_id', "{{ $walkIn->user_id }}")
                                                        axios.post('/updatelaundrystatus', formdata)
                                                            .then(respomse => {
                                                                location.reload()
                                                            })
                                                    }
                                                })
                                            })
                                            $("#deleteOrder{{ $walkIn->id }}").click(function() {
                                                swal({
                                                    icon: "warning",
                                                    title: "Delete Order?",
                                                    text: "Are you sure you want to delete the order?",
                                                    buttons: {
                                                        cancel: "Cancel",
                                                        true: "OK"
                                                    }
                                                }).then(response => {
                                                    if (response == 'true') {
                                                        const formdata = new FormData()
                                                        formdata.append('id', '{{ $walkIn->id }}')
                                                        axios.post('/deleteorder', formdata)
                                                            .then(response => {
                                                                location.reload()
                                                            })
                                                    }
                                                })
                                            })
                                        </script>
                                    @endforeach
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
                                        <th>Name</th>
                                        <th>Laundry Status</th>
                                        <th>Segregation</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Total Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dropOffs as $dropOff)
                                        <tr>
                                            <th>{{ $dropOff->first_name }} {{ $dropOff->middle_name }}
                                                {{ $dropOff->last_name }}</th>
                                            <th>{{ $dropOff->status }}</th>
                                            <th>{{ $dropOff->segregation_type }}</th>
                                            <th>
                                                @if ($dropOff->mode_of_payment === 'cash')
                                                    Cash
                                                @else
                                                    Cashless
                                                @endif
                                            </th>
                                            <th>{{ $dropOff->payment_status }}</th>
                                            <th>P{{ $dropOff->total_price }}</th>
                                            <th><button class="btn btn-primary btn-sm btn-circle"
                                                    id="updatePayment{{ $dropOff->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-credit-card-2-back-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0V4zm11.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2zM0 11v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1H0z" />
                                                    </svg>
                                                </button>
                                                <button class="btn btn-warning btn-sm btn-circle"
                                                    id="updateLaundryStatus{{ $dropOff->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-bag-check-fill"
                                                        viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                                                    </svg>
                                                </button>
                                                <button class="btn btn-danger btn-sm btn-circle"
                                                    id="deleteOrder{{ $dropOff->id }}"><i
                                                        class="fas fa-trash"></i></button>
                                            </th>
                                        </tr>

                                        <script>
                                            $("#updatePayment{{ $dropOff->id }}").on('click', function() {
                                                swal({
                                                    icon: "warning",
                                                    title: "Update Payment Status?",
                                                    text: "Are you sure you want to update the payment status?",
                                                    buttons: {
                                                        cancel: "Cancel",
                                                        true: "OK"
                                                    }
                                                }).then(response => {
                                                    if (response == 'true') {
                                                        const formdata = new FormData()
                                                        formdata.append('id', "{{ $dropOff->id }}")
                                                        axios.post('/updatepaymentstatus', formdata)
                                                            .then(response => {
                                                                location.reload()
                                                            })
                                                    }
                                                })
                                            })

                                            $("#updateLaundryStatus{{ $dropOff->id }}").on('click', function() {
                                                swal({
                                                    icon: "warning",
                                                    title: "Update Order Status?",
                                                    text: "Are you sure you want to update the order status?",
                                                    buttons: {
                                                        cancel: "Cancel",
                                                        true: "OK"
                                                    }
                                                }).then(response => {
                                                    if (response == 'true') {
                                                        const formdata = new FormData()
                                                        formdata.append("id", '{{ $dropOff->id }}')
                                                        formdata.append("user_id", '{{ $dropOff->user_id }}')
                                                        axios.post('/updatelaundrystatus', formdata)
                                                            .then(response => {
                                                                location.reload()
                                                            })
                                                    }
                                                })
                                            })
                                            $("#deleteOrder{{ $dropOff->id }}").click(function() {
                                                swal({
                                                    icon: "warning",
                                                    title: "Delete Order?",
                                                    text: "Are you sure you want to delete the order?",
                                                    buttons: {
                                                        cancel: "Cancel",
                                                        true: "OK"
                                                    }
                                                }).then(response => {
                                                    if (response == 'true') {
                                                        const formdata = new FormData()
                                                        formdata.append('id', '{{ $dropOff->id }}')
                                                        axios.post('/deleteorder', formdata)
                                                            .then(response => {
                                                                location.reload()
                                                            })
                                                    }
                                                })
                                            })
                                        </script>
                                    @endforeach
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
                                        <th>Name</th>
                                        <th>Laundry Status</th>
                                        <th>Segregation</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Total Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pickUps as $pickUp)
                                        <tr>
                                            <th>{{ $pickUp->first_name }} {{ $pickUp->middle_name }}
                                                {{ $pickUp->last_name }}</th>
                                            <th>{{ $pickUp->status }}</th>
                                            <th>{{ $pickUp->segregation_type }}</th>
                                            <th>
                                                @if ($pickUp->mode_of_payment === 'cash')
                                                    Cash
                                                @else
                                                    Cashless
                                                @endif
                                            </th>
                                            <th>{{ $pickUp->payment_status }}</th>
                                            <th>P{{ $pickUp->total_price }}</th>
                                            <th><button class="btn btn-primary btn-sm btn-circle"
                                                    id="updatePayment{{ $pickUp->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-credit-card-2-back-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0V4zm11.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2zM0 11v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1H0z" />
                                                    </svg>
                                                </button>
                                                <button class="btn btn-warning btn-sm btn-circle"
                                                    id="updateLaundryStatus{{ $pickUp->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-bag-check-fill"
                                                        viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                                                    </svg>
                                                </button>
                                                <button class="btn btn-danger btn-sm btn-circle"><i
                                                        class="fas fa-trash"></i></button>
                                            </th>
                                        </tr>

                                        <script>
                                            $("#updatePayment{{ $pickUp->id }}").on('click', function() {
                                                swal({
                                                    icon: "warning",
                                                    title: "Update Payment Status?",
                                                    text: "Are you sure you want to update the payment status?",
                                                    buttons: {
                                                        cancel: "Cancel",
                                                        true: "OK"
                                                    }
                                                }).then(response => {
                                                    if (response == 'true') {
                                                        const formdata = new FormData()
                                                        formdata.append('id', "{{ $pickUp->id }}")
                                                        axios.post('/updatepaymentstatus', formdata)
                                                            .then(response => {
                                                                location.reload()
                                                            })
                                                    }
                                                })
                                            })

                                            $("#updateLaundryStatus{{ $pickUp->id }}").on('click', function() {
                                                swal({
                                                    icon: "warning",
                                                    title: "Update Order Status?",
                                                    text: "Are you sure you want to update the order status?",
                                                    buttons: {
                                                        cancel: "Cancel",
                                                        true: "OK"
                                                    }
                                                }).then(response => {
                                                    const formdata = new FormData()
                                                    formdata.append("id", '{{ $pickUp->id }}')
                                                    formdata.append("user_id", '{{ $pickUp->user_id }}')
                                                    axios.post('/updatelaundrystatus', formdata)
                                                        .then(respomse => {
                                                            location.reload()
                                                        })
                                                })
                                            })
                                            $("#deleteOrder{{ $pickUp->id }}").click(function() {
                                                swal({
                                                    icon: "warning",
                                                    title: "Delete Order?",
                                                    text: "Are you sure you want to delete the order?",
                                                    buttons: {
                                                        cancel: "Cancel",
                                                        true: "OK"
                                                    }
                                                }).then(response => {
                                                    if (response == 'true') {
                                                        const formdata = new FormData()
                                                        formdata.append('id', '{{ $pickUp->id }}')
                                                        axios.post('/deleteorder', formdata)
                                                            .then(response => {
                                                                location.reload()
                                                            })
                                                    }
                                                })
                                            })
                                        </script>
                                    @endforeach
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
                                        <th>Name</th>
                                        <th>Laundry Status</th>
                                        <th>Segregation</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Total Price</th>
                                        <th>Actions</th>
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
