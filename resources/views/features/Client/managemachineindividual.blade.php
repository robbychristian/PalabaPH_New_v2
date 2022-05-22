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
                                        <td>{{ $machine->machine_name }}</td>
                                        <td>{{ $machine->machine_service }}</td>
                                        <td>{{ $machine->timer }}</td>
                                        <td>{{ $machine->price }}</td>
                                        <td>{{ $machine->max_kg }}</td>
                                        <td>test</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
