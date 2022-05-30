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
                                @if ($machine->status === 1)
                                    <span class="d-none"
                                        id="machineId{{ $machine->machine_id }}">{{ $machine->machine_id }}</span>
                                    <tr>
                                        <th>{{ $machine->machine_name }} <span class="d-none"
                                                id="machineService{{ $machine->id }}">{{ $machine->machine_service }}</span>
                                        </th>
                                        <th>{{ $machine->first_name }} {{ $machine->middle_name }}
                                            {{ $machine->last_name }}</th>
                                        <th>
                                            @if ($machine->status === 1)
                                                On Going
                                            @else
                                                Done
                                            @endif
                                        </th>
                                        <th id="machineTimer{{ $machine->id }}"></th>
                                        <th id="numOfDryMachine" class="d-none">0</th>
                                    </tr>
                                    <script>
                                        let dryMachineCount = 0;
                                        const countdown{{ $machine->id }} = setInterval(() => {
                                            const machineService = $("#machineService{{ $machine->id }}").html()
                                            if (machineService === 'Wash') {
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
                                                    formdata.append('machine_id', machineId);
                                                    console.log(machineId)
                                                    axios.post('/closemachinestate', formdata)
                                                        .then(response => {
                                                            console.log(response.data);
                                                        })
                                                    clearInterval(countdown{{ $machine->id }})
                                                }
                                            } else if (machineService === "Dry") {
                                                dryMachineCount = dryMachineCount + 1;
                                                $("#numOfDryMachine").text(dryMachineCount);
                                                $("#machineTimer{{ $machine->id }}").append(
                                                    "<button type='button' class='btn btn-warning' id='startCount" + dryMachineCount +
                                                    "'>Start Timer</button>"
                                                )
                                                clearInterval(countdown{{ $machine->id }})
                                                $("#startCount" + dryMachineCount).on('click', function() {
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
                                        </tr>
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
                                        </tr>
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
                                        </tr>
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
