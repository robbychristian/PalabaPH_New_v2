@extends('layouts.master')

@section('content')
    <div class="d-flex mx-4 justify-content-center">
        <div class="h4 text-dark">View Complaints</div>
    </div>

    <div class="px-5">
        <table id="complaintsTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($complaints as $complaint)
                    <tr>
                        <td class="w-25">
                            <img src="{{ asset('images/Gcash_QR.jpg') }}" class="img-fluid h-25 w-50">
                        </td>
                        <td>{{ $complaint->first_name . ' ' . $complaint->last_name }}</td>
                        <td class="font-weight-bold">{{ $complaint->category }}</td>
                        <td>{{ $complaint->comment }}</td>
                        <td id="date{{ $complaint->id }}">{{ $complaint->created_at }}</td>
                        <td>
                            @if ($complaint->status == 'Pending')
                                <button class="btn-warning btn-circle" style="border: 0" data-toggle="tooltip"
                                    id="reviewButton{{ $complaint->id }}" data-placement="top" title="To review">
                                    <i class="fa fa-search"></i>
                                </button>
                                <script>
                                    $("#reviewButton{{ $complaint->id }}").click(() => {
                                        const formdata = new FormData()
                                        formdata.append('id', '{{ $complaint->id }}')
                                        axios.post('/toreview', formdata)
                                            .then(response => {
                                                swal({
                                                    icon: 'success',
                                                    title: "Complaints being Reviewed!",
                                                    text: "The current complaint has now being reviewed!",
                                                    buttons: false
                                                }).then(() => {
                                                    location.reload()
                                                })
                                            })
                                    })
                                </script>
                            @elseif ($complaint->status == 'Review')
                                <button class="btn btn-warning" data-toggle='modal'
                                    data-target="#replyModal{{ $complaint->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </button>
                            @else
                                <div class="btn-circle bg-success">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                            @endif
                        </td>
                        <div class="modal fade" id="replyModal{{ $complaint->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reply to Complaints</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><strong>Comment:</strong>
                                                    {{ $complaint->comment }}</label>
                                                <textarea class="form-control" id="reply{{ $complaint->id }}" rows="5" placeholder="Reply here..."></textarea>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary"
                                            id="submitReply{{ $complaint->id }}">Save
                                            changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $("#submitReply{{ $complaint->id }}").click(function() {
                                const reply = $('#reply{{ $complaint->id }}').val();
                                if (reply == '') {
                                    swal({
                                        icon: "error",
                                        title: "Error!",
                                        text: "The reply is empty!",
                                        buttons: false
                                    })
                                } else {
                                    swal({
                                        icon: "success",
                                        title: "Reply Sent!",
                                        text: "Successfully replied to the complaint!",
                                        buttons: false
                                    }).then(response => {
                                        const formdata = new FormData()
                                        formdata.append('id', "{{ $complaint->id }}")
                                        formdata.append('reply', reply)
                                        formdata.append('notif_token', "{{ $complaint->notif_token }}")
                                        axios.post('/replytocomplaints', formdata)
                                            .then(response => {
                                                location.reload()
                                            })
                                    })
                                }
                            })
                        </script>
                    </tr>
                    <script>
                        $(document).ready(() => {
                            const date = $("#date{{ $complaint->id }}").text()
                            const formattedDate = moment(date).format("LL")
                            $("#date{{ $complaint->id }}").html(formattedDate)
                        })
                    </script>
                @empty
                @endforelse
            </tbody>
    </div>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        $(document).ready(function() {
            $('#complaintsTable').DataTable();
        });
    </script>
@endsection
