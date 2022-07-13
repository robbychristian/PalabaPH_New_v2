@extends('layouts.master')

@section('content')
    <div class="row mx-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('client.addmachine') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="text-primary font-weight-bold h5">Machine Management</div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Laundry Name</label>
                            <div class="col-sm-8">
                                <select name="laundry_id" class="form-control" id="">
                                    @foreach ($laundry as $info)
                                        <option value="{{ $info->id }}">{{ $info->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Machine Name</label>
                            <div class="col-sm-8">
                                <input type="text" name="machine_name" class="form-control" id="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Machine Service</label>
                            <div class="col-sm-8">
                                <select name="machine_service" class="form-control" id="">
                                    <option value="Wash">Wash</option>
                                    <option value="Dry">Dry</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Service Price</label>
                            <div class="col-sm-8">
                                <input type="text" name="price" class="form-control" id="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Max Kilos</label>
                            <div class="col-sm-8">
                                <input type="text" name="max_kg" class="form-control" id="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Timer</label>
                            <div class="col-sm-8">
                                <input type="text" name="timer" class="form-control" id="">
                            </div>
                        </div>
                        {{-- <div class="text-primary font-weight-bold h5">Machine Maintenance</div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Set Date:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="">
                            </div>
                        </div> --}}

                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-primary" type="submit">Add Machine</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md 6 justify-content-end w-100 d-flex h-25">
            <button class="btn btn-primary" data-toggle="modal" data-target="#machineMaintenanceTable">View Machine
                Maintenances</button>
        </div>
        <div class="modal fade" id="machineMaintenanceTable" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($maintenances as $maintenance)
                                    <tr>
                                        <th scope="row">{{ $maintenance->machine_name }}</th>
                                        <td>{{ $maintenance->description }}</td>
                                        <td>{{ $maintenance->maintenance_date }}</td>
                                        <td>
                                            <button class="btn-danger btn" id="deleteMaintenance{{ $maintenance->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>

                                    <script>
                                        $("#deleteMaintenance{{ $maintenance->id }}").click(function() {
                                            swal({
                                                icon: "warning",
                                                title: "Delete Maintenance?",
                                                text: "Are you sure want to delete the machine maintenance?",
                                                buttons: {
                                                    cancel: "Cancel",
                                                    true: "OK"
                                                }
                                            }).then(response => {
                                                if (response == 'true') {
                                                    swal({
                                                        icon: "success",
                                                        title: "Maintenance Deleted!",
                                                        text: "The machine maintenance has been deleted!",
                                                        buttons: false
                                                    }).then(response => {
                                                        const formdata = new FormData()
                                                        formdata.append('id', "{{ $maintenance->id }}")
                                                        formdata.append('machine_id', "{{ $maintenance->machine_id }}")
                                                        axios.post('/deletemachinemaintenance', formdata)
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card shadow-card mb-3 mt-3">
                <div class="card-body">
                    <div class="text-primary font-weight-bold h5">Machines</div>
                    <div class="table-responsive">
                        <table class="table" width="100%" cellspacing="0" style="color:#464646 !important">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Service</th>
                                    <th>Timer</th>
                                    <th>Price</th>
                                    <th>KG</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($machines as $machine)
                                    <tr>
                                        <td id="machineName{{ $machine->id }}">{{ $machine->machine_name }}</td>
                                        <td id="machineService{{ $machine->id }}">{{ $machine->machine_service }}
                                        </td>
                                        <td id="machineTimer{{ $machine->id }}">{{ $machine->timer }}</td>
                                        <td id="machinePrice{{ $machine->id }}">{{ $machine->price }}</td>
                                        <td id="machineKg{{ $machine->id }}">{{ $machine->max_kg }}</td>
                                        <td>
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#machineModal{{ $machine->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                            </button>
                                            <button class="btn btn-warning" data-toggle="modal"
                                                id="machineMaintenanceButton{{ $machine->id }}"
                                                data-target="#machineMaintenance{{ $machine->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                                                </svg>
                                            </button>
                                            <button class="btn btn-danger" id="deleteMachine{{ $machine->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- ====================== MODAL FOR EDITING THE MACHINE ==================== --}}
                                    {{-- ====================== MODAL FOR EDITING THE MACHINE ==================== --}}
                                    {{-- ====================== MODAL FOR EDITING THE MACHINE ==================== --}}

                                    <div class="modal fade" id="machineModal{{ $machine->id }}" tabindex="-1"
                                        aria-labelledby="machineModal" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit machine</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="editMachineForm{{ $machine->id }}"
                                                        action="{{ route('client.editmachine') }}" method="POST">
                                                        @csrf
                                                        <input name="machine_id" class="d-none"
                                                            value="{{ $machine->id }}" type="text">
                                                        <div class="form-group row">
                                                            <label for="staticEmail"
                                                                class="col-sm-2 col-form-label">Name</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="machine_name"
                                                                    id="machineName{{ $machine->id }}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="staticEmail"
                                                                class="col-sm-2 col-form-label">Service</label>
                                                            <div class="col-sm-10">
                                                                <select name="machine_service"
                                                                    id="machineService{{ $machine->id }}"
                                                                    class="form-control">
                                                                    <option value="Wash">Wash</option>
                                                                    <option value="Dry">Dry</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="staticEmail"
                                                                class="col-sm-2 col-form-label">Timer</label>
                                                            <div class="col-sm-10">
                                                                <input name="machine_timer" type="text"
                                                                    id="machineTime{{ $machine->id }}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="staticEmail"
                                                                class="col-sm-2 col-form-label">Price</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="machine_price"
                                                                    id="machinePrice{{ $machine->id }}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="staticEmail" class="col-sm-2 col-form-label">Max
                                                                KG</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="machine_kg"
                                                                    id="machineMaxKg{{ $machine->id }}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" id="editMachineButton{{ $machine->id }}"
                                                        class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ====================== MODAL FOR MACHINE MAINTENANCE THE MACHINE ==================== --}}
                                    {{-- ====================== MODAL FOR MACHINE MAINTENANCE THE MACHINE ==================== --}}
                                    {{-- ====================== MODAL FOR MACHINE MAINTENANCE THE MACHINE ==================== --}}

                                    <div class="modal fade" id="machineMaintenance{{ $machine->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Schedule Machine
                                                        Maintenance</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="editMachineForm{{ $machine->id }}"
                                                        action="{{ route('client.editmachine') }}" method="POST">
                                                        @csrf
                                                        <input name="machine_id" class="d-none"
                                                            value="{{ $machine->id }}" type="text">
                                                        <div class="form-group row">
                                                            <label for="staticEmail"
                                                                class="col-sm-4 col-form-label">Description</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="maintenance_description"
                                                                    id="maintenanceDescription{{ $machine->id }}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="staticEmail"
                                                                class="col-sm-4 col-form-label">Maintenance Date</label>
                                                            <div class="col-sm-8">
                                                                <input type="date" name="maintenance_date"
                                                                    id="maintenanceDate{{ $machine->id }}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" id="submitMaintenance{{ $machine->id }}"
                                                        class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        $(document).ready(function() {
                                            $("#maintenanceDate{{ $machine->id }}").attr('min', moment().format('YYYY-MM-DD'))
                                        })
                                        $("#editMachineButton{{ $machine->id }}").on('click', function() {
                                            const machineName = $("#machineName{{ $machine->id }}").val()
                                            const machineService = $("#machineService{{ $machine->id }}").val()
                                            const machineTime = $("#machineTime{{ $machine->id }}").val()
                                            const machinePrice = $("#machinePrice{{ $machine->id }}").val()
                                            const machineMaxKg = $("#machineMaxKg{{ $machine->id }}").val()

                                            if (machineName === '' || machineService === '' || machineTime === '' || machinePrice === '' ||
                                                machineMaxKg === '') {
                                                swal({
                                                    icon: "error",
                                                    title: "Error!",
                                                    text: "Some fields are empty!",
                                                    buttons: false
                                                })
                                            } else if (!$.isNumeric(machinePrice)) {
                                                swal({
                                                    icon: "error",
                                                    title: "Error!",
                                                    text: "Price should be numeric!",
                                                    buttons: false
                                                })
                                            } else if (!$.isNumeric(machineTime)) {
                                                swal({
                                                    icon: "error",
                                                    title: "Error!",
                                                    text: "Time should be numeric!",
                                                    buttons: false
                                                })
                                            } else if (!$.isNumeric(machineMaxKg)) {
                                                swal({
                                                    icon: "error",
                                                    title: "Error!",
                                                    text: "Max KG should be numeric!",
                                                    buttons: false
                                                })
                                            } else {
                                                swal({
                                                    icon: "success",
                                                    title: "Machine Edited!",
                                                    text: "Your machine has been updated!",
                                                    buttons: false
                                                }).then(response => {
                                                    $("#editMachineForm{{ $machine->id }}").submit()
                                                })
                                            }
                                        })

                                        $("#deleteMachine{{ $machine->id }}").on('click', function() {
                                            swal({
                                                icon: "warning",
                                                title: "Warning!",
                                                text: "Are you sure you want to delete the machine?",
                                                buttons: {
                                                    cancel: "Cancel",
                                                    true: "OK"
                                                }
                                            }).then(response => {
                                                if (response === 'true') {
                                                    swal({
                                                        icon: "success",
                                                        title: "Machine Deleted!",
                                                        text: "The selected machine has been deleted!",
                                                        buttons: false
                                                    }).then(response => {
                                                        const formdata = new FormData()
                                                        formdata.append('id', "{{ $machine->id }}}")
                                                        axios.post('/deletemachines', formdata)
                                                            .then(response => {
                                                                location.reload()
                                                            })
                                                    })
                                                }
                                            })
                                        })

                                        $("#submitMaintenance{{ $machine->id }}").on('click', function() {
                                            const maintenanceDate = moment($("#maintenanceDate{{ $machine->id }}").val()).format('LL')
                                            const maintenanceDesc = $('#maintenanceDescription{{ $machine->id }}').val();
                                            const formdata = new FormData()
                                            formdata.append("machine_id", '{{ $machine->id }}')
                                            formdata.append('description', maintenanceDesc)
                                            formdata.append("maintenance_date", maintenanceDate)

                                            if (maintenanceDate === '' || maintenanceDesc === '') {
                                                swal({
                                                    icon: "error",
                                                    title: "Error!",
                                                    text: "Please fill in the required fields!",
                                                    buttons: false
                                                })
                                            } else {
                                                axios.post('/addmachinemaintenance', formdata)
                                                    .then(response => {
                                                        if (response.data === 'success') {
                                                            location.reload()
                                                        } else {
                                                            swal({
                                                                icon: 'error',
                                                                title: "Error",
                                                                text: "An error occurred while submitting!",
                                                                buttons: false
                                                            })
                                                        }
                                                    })
                                                    .catch(e => {
                                                        console.log(e)
                                                    })
                                            }

                                        })
                                    </script>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
