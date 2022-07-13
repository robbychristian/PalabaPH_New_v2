@extends('layouts.master')

@section('content')
    <div class="d-flex mx-4 justify-content-center">
        <div class="h4 text-dark">View Sales</div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="card" style="width: 80%;">
            <div class="card-body">
                @foreach ($sales as $info)
                    <div class="row">
                        <div class="col-4 my-4">
                            <div class="d-flex">
                                <div class="h5 font-weight-bold">First Name: &nbsp; </div>
                                <div class="h5">{{ $info->first_name }}</div>
                            </div>
                        </div>
                        <div class="col-4 my-4">
                            <div class="d-flex">
                                <div class="h5 font-weight-bold">Middle Name: &nbsp; </div>
                                <div class="h5">{{ $info->middle_name }}</div>
                            </div>
                        </div>
                        <div class="col-4 my-4">
                            <div class="d-flex">
                                <div class="h5 font-weight-bold">Last Name: &nbsp; </div>
                                <div class="h5">{{ $info->last_name }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 my-4">
                            <div class="d-flex">
                                <div class="h5 font-weight-bold">Total Time: &nbsp; </div>
                                <div class="h5">{{ $info->total_time }} minutes</div>
                            </div>
                        </div>
                        <div class="col-4 my-4">
                            <div class="d-flex">
                                <div class="h5 font-weight-bold">Total Price: &nbsp; </div>
                                <div class="h5">P{{ $info->total_price }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 my-4">
                            <div class="d-flex">
                                <div class="h5 font-weight-bold">Mode Of Payment: &nbsp; </div>
                                <div class="h5">{{ $info->mode_of_payment }}</div>
                            </div>
                        </div>
                        <div class="col-4 my-4">
                            <div class="d-flex">
                                <div class="h5 font-weight-bold">Commodity Type: &nbsp; </div>
                                <div class="h5">{{ $info->commodity_type }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 my-4">
                            <div class="d-flex">
                                <div class="h5 font-weight-bold">Date Issued: &nbsp; </div>
                                <div class="h5" id="createdAt">{{ $info->created_at }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" id="backBtn">Back</button>
                    </div>

                    <script>
                        $(document).ready(function() {
                            const createdAt = $("#createdAt").html()
                            const formattedCreatedAt = moment(createdAt).format('LL | hh:mmA')

                            $("#createdAt").text(formattedCreatedAt)
                        })

                        $("#backBtn").click(function() {
                            history.back()
                        })
                    </script>
                @endforeach
            </div>
        </div>
    </div>
@endsection
