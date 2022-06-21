@extends('layouts.master')

@if (Auth::user()->user_role == 1)
    @section('title', '| User Management')
@else
    @section('title', '| ###')
@endif

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">User Management</h1>
        </div>

        <div class="card shadow-card mb-3 mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table data-table" id="dataTable" width="100%" cellspacing="0"
                        style="color:#464646 !important">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Blocked</th>
                                <th>Date Joined</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->first_name }} {{ $customer->middle_name }}
                                        {{ $customer->last_name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>
                                        @if ($customer->is_blocked == 0)
                                            No
                                        @else
                                            Yes
                                        @endif
                                    </td>
                                    <td id="dateJoined{{ $customer->id }}">{{ $customer->created_at }}</td>
                                    <td>
                                        @if ($customer->is_blocked == 0)
                                            <button class="btn btn-warning" id="block{{ $customer->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-slash-circle" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path
                                                        d="M11.354 4.646a.5.5 0 0 0-.708 0l-6 6a.5.5 0 0 0 .708.708l6-6a.5.5 0 0 0 0-.708z" />
                                                </svg></button>
                                        @else
                                            <button class="btn btn-success" id="unblock{{ $customer->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-slash-circle" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path
                                                        d="M11.354 4.646a.5.5 0 0 0-.708 0l-6 6a.5.5 0 0 0 .708.708l6-6a.5.5 0 0 0 0-.708z" />
                                                </svg></button>
                                        @endif
                                        <button class="btn btn-danger" id="delete{{ $customer->id }}">
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
                                    $("#dateJoined{{ $customer->id }}").text(moment("{{ $customer->created_at }}").format('LL'))
                                    $("#block{{ $customer->id }}").click(function() {
                                        const formdata = new FormData()
                                        formdata.append('id', "{{ $customer->id }}")
                                        swal({
                                            icon: "warning",
                                            title: "Block User?",
                                            text: "Are you sure you want to block the customer?",
                                            buttons: {
                                                cancel: "Cancel",
                                                true: "OK"
                                            }
                                        }).then(response => {
                                            if (response == 'true') {
                                                swal({
                                                    icon: "success",
                                                    title: "Customer Blocked!",
                                                    text: "The customer has been blocked!",
                                                    buttons: false
                                                }).then(response => {
                                                    axios.post('/blockcustomer', formdata)
                                                        .then(response => {
                                                            location.reload()
                                                        })
                                                })
                                            }
                                        })
                                    })
                                    $("#unblock{{ $customer->id }}").click(function() {
                                        const formdata = new FormData()
                                        formdata.append('id', "{{ $customer->id }}")
                                        swal({
                                            icon: "warning",
                                            title: "Unblock User?",
                                            text: "Are you sure you want to block the customer?",
                                            buttons: {
                                                cancel: "Cancel",
                                                true: "OK"
                                            }
                                        }).then(response => {
                                            if (response == 'true') {
                                                swal({
                                                    icon: "success",
                                                    title: "Customer Unblocked!",
                                                    text: "The customer has been unblocked!",
                                                    buttons: false
                                                }).then(response => {
                                                    axios.post('/unblockcustomer', formdata)
                                                        .then(response => {
                                                            location.reload()
                                                        })
                                                })
                                            }
                                        })
                                    })
                                    $("#delete{{ $customer->id }}").click(function() {
                                        const formdata = new FormData()
                                        formdata.append('id', "{{ $customer->id }}");
                                        swal({
                                            icon: "warning",
                                            title: "Delete Customer?",
                                            text: "Are you sure you want to delete the customer?",
                                            buttons: {
                                                cancel: "Cancel",
                                                true: "OK"
                                            }
                                        }).then(response => {
                                            if (response == 'true') {
                                                swal({
                                                    icon: "success",
                                                    title: "Customer deleted!",
                                                    text: "The customer has been deleted!",
                                                    buttons: false,
                                                }).then(response => {
                                                    axios.post('/deletecustomer', formdata)
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
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
