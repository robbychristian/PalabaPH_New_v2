@extends('layouts.master')

@if (Auth::user()->user_role == 1)
    @section('title', '| Client Management')
@else
    @section('title', '| ###')
@endif

@section('content')
    <div class="container-fluid">


        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Client Management</h1>
        </div>

        <div class="card shadow-card mb-3 mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table data-table" id="dataTable" width="100%" cellspacing="0"
                        style="color:#464646 !important">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Laundry Owner</th>
                                <th>Laundry Shop Name</th>
                                <th>Client Details</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.clientmanagement.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'laundry_owner',
                        name: 'laundry_owner'
                    },

                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                ],

            });


        });
    </script>

@endsection
