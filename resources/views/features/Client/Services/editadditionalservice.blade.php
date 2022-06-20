@extends('layouts.master')

@section('content')
    <div class="container d-flex justify-content-center align-items-center w-100">
        <div class="card w-100 h-100">
            <div class="d-flex justify-content-center py-3 px-5">
                <div class="h3">Edit Additional Service</div>
            </div>
            <form action="/submiteditadditionalservice" id="editForm" method="POST" class="py-3 px-5">
                @csrf
                <div class="form-group row h-75 w-100 d-flex justify-content-center">
                    <img src="{{ asset('/images/PalabaPH-Icon.png') }}" class="img-fluid h-25 w-25" alt="">
                </div>
                <input type="text" id="service_id" name="id" value="{{ $service_id }}" class="d-none">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Service Name:</label>
                    <div class="col-sm-9 justify-content-start">
                        <input type="text" name="name" class="form-control" id="staticEmail"
                            value="{{ $laundry_info[0]->add_serv_name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Price:</label>
                    <div class="col-sm-9 justify-content-start">
                        <input type="text" name="price" class="form-control" id="staticEmail"
                            value="{{ $laundry_info[0]->add_serv_price }}">
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <button type="button" id="submitEdit" class="btn-primary btn">Submit</button>
                </div>
            </form>
        </div>
        <script>
            $("#submitEdit").on('click', function() {
                swal({
                    icon: "warning",
                    title: "Edit Service?",
                    text: "Are you sure you want to edit this service?",
                    buttons: {
                        cancel: "Cancel",
                        true: "OK"
                    }
                }).then(response => {
                    if (response == 'true') {
                        swal({
                            icon: "success",
                            title: "Service Edited!",
                            text: "The service has been edited successfully!",
                            buttons: false
                        }).then(response => {
                            $("#editForm").submit();
                        })
                    }
                })
            })
        </script>
    </div>
@endsection
