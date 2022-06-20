@extends('layouts.master')

@section('content')
    <div class="container d-flex justify-content-center align-items-center w-100">
        <div class="card w-100 h-100">
            <div class="d-flex justify-content-center py-3 px-5">
                <div class="h3">Edit Main Service</div>
            </div>
            <form action="/submiteditmainservice" id="editForm" method="POST" class="py-3 px-5">
                @csrf
                <input type="text" id="service_id" name="id" value="{{ $service_id }}" class="d-none">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Service Name:</label>
                    <div class="col-sm-9 justify-content-start">
                        <input type="text" name="name" class="form-control" id="staticEmail"
                            value="{{ $laundry_info[0]->main_serv_name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Max KG:</label>
                    <div class="col-sm-9 justify-content-start">
                        <input type="text" name="kg" class="form-control" id="staticEmail"
                            value="{{ $laundry_info[0]->main_serv_max_kg }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Service Price:</label>
                    <div class="col-sm-9 justify-content-start">
                        <input type="text" name="price" class="form-control" id="staticEmail"
                            value="{{ $laundry_info[0]->main_serv_price }}">
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
