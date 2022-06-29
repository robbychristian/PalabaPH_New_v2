@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-end align-items-center">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRiderModal">Add Rider</button>
        </div>
        <div class="d-none" id="laundryId">{{ $laundry_id }}</div>
        <!-- Modal -->
        <div class="modal fade" id="addRiderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Rider</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">First Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="riderFname" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Middle Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="riderMname" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Last Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="riderLname" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Contact No.:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="contactNo" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Email:</label>
                                <div class="col-sm-10">
                                    <input type="email" id="riderEmail" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Password:</label>
                                <div class="col-sm-10">
                                    <input type="password" id="riderPass" id="pass" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Confirm</label>
                                <div class="col-sm-10">
                                    <input type="password" id="riderCpass" class="form-control">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addRiderButton">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact #</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all_riders as $rider)
                    <tr>
                        <td>{{ $rider->first_name }} {{ $rider->middle_name }} {{ $rider->last_name }}</td>
                        <td>{{ $rider->email }}</td>
                        <td>{{ $rider->contact_no }}</td>
                        <td>
                            <button class="btn btn-warning" data-toggle="modal"
                                data-target="#editRiderModal{{ $rider->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                            <button class="btn btn-danger" id="deleteRider{{ $rider->id }}">
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
                    <script></script>
                    <div class="modal fade" id="editRiderModal{{ $rider->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">First Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"
                                                    value="{{ $rider->first_name }}" id="fname{{ $rider->id }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Middle Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"
                                                    value="{{ $rider->middle_name }}" id="mname{{ $rider->id }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Last Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"
                                                    value="{{ $rider->last_name }}" id="lname{{ $rider->id }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Contact No.</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="cnum{{ $rider->id }}"
                                                    value="{{ $rider->contact_no }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="{{ $rider->email }}"
                                                    id="email{{ $rider->id }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control"
                                                    id="pass{{ $rider->id }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Confirm</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control"
                                                    id="cpass{{ $rider->id }}">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary"
                                        id="saveEditRider{{ $rider->id }}">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        $("#saveEditRider{{ $rider->id }}").click(function() {
                            const fname = $("#fname{{ $rider->id }}").val()
                            const mname = $("#mname{{ $rider->id }}").val()
                            const lname = $("#lname{{ $rider->id }}").val()
                            const cnum = $("#cnum{{ $rider->id }}").val()
                            const email = $("#email{{ $rider->id }}").val()
                            const pass = $("#pass{{ $rider->id }}").val()
                            const cpass = $("#cpass{{ $rider->id }}").val()
                            if (fname == '' || mname == '' || lname == '' || cnum == '' || email == '' || pass == '' || cpass ==
                                '') {
                                swal({
                                    icon: "error",
                                    title: "Error!",
                                    text: "Some fields are not properly filled!",
                                    buttons: false
                                })
                            } else if (pass != cpass) {
                                swal({
                                    icon: "error",
                                    title: "Error!",
                                    text: "Password does not match!",
                                    buttons: false
                                })
                            } else {
                                const formdata = new FormData()
                                formdata.append('id', '{{ $rider->id }}')
                                formdata.append('first_name', fname)
                                formdata.append('middle_name', mname)
                                formdata.append('last_name', lname)
                                formdata.append('contact_no', cnum)
                                formdata.append('email', email)
                                formdata.append('pass', pass)
                                axios.post('/editriders', formdata)
                                    .then(response => {
                                        location.reload()
                                    })
                            }
                        })

                        $("#deleteRider{{ $rider->id }}").click(function() {
                            swal({
                                icon: "warning",
                                title: "Delete Rider?",
                                text: "Are you sure you want to delete the rider?",
                                buttons: {
                                    cancel: "Cancel",
                                    true: "OK"
                                }
                            }).then(response => {
                                if (response == 'true') {

                                    const formdata = new FormData()
                                    formdata.append('id', '{{ $rider->id }}')
                                    axios.post('/deleteriders', formdata)
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
@endsection
