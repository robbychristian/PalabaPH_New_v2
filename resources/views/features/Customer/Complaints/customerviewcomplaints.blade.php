@extends('layouts.app')

@section('content')
    <div class="w-full">
        <div class="flex justify-center">
            <div class="w-[90%] mt-3">

                <table id="complaintsTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Laundry Name</th>
                            <th>Category</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Reply</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($complaints as $complaint)
                            <tr>
                                <td>{{ $complaint->name }}</td>
                                <td>{{ $complaint->category }}</td>
                                <td>{{ $complaint->comment }}</td>
                                <td>
                                    @if ($complaint->status == 'Pending')
                                        <span class="text-yellow-500">{{ $complaint->status }}</span>
                                    @else
                                        <span class="text-green-500">{{ $complaint->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($complaint->reply != null)
                                        {{ $complaint->reply }}
                                    @else
                                        No Reply Yet!
                                    @endif
                                </td>
                                <td>
                                    <button class="rounded-full p-[0.40rem] bg-blue-500" data-bs-toggle='modal'
                                        data-bs-target="#image{{ $complaint->id }}">
                                        <span class="text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
                                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                <path
                                                    d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
                                            </svg>
                                        </span>
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="image{{ $complaint->id }}" tabindex="-1"
                                aria-labelledby="image{{ $complaint->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <img class="img-fluid"
                                                src="{{ asset('storage/complaints_image/' . Auth::guard('customer')->user()->id . '/' . $complaint->complaint_image) }}"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#complaintsTable').DataTable();
        });
    </script>
@endsection
