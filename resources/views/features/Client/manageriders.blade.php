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
                        <td>@mdo</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
