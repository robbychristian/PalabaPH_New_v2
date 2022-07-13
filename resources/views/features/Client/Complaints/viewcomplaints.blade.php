@extends('layouts.master')

@section('content')
    <div class="d-flex mx-4 justify-content-center">
        <div class="h4 text-dark">View Complaints</div>
    </div>

    <div class="d-flex justify-content-center">
        <table class="table w-75">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($complaints as $complaint)
                    <tr>
                        <th scope="row" class="w-25">
                            <img src="{{ asset('images/Gcash_QR.jpg') }}" class="img-fluid h-25 w-50">
                        </th>
                        <td>{{ $complaint->first_name }} {{ $complaint->last_name }}</td>
                        <td>{{ $complaint->comment }}</td>
                        <td>
                            <button class="btn btn-warning" data-toggle='modal'
                                data-target="#replyModal{{ $complaint->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                            {{-- <button class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd"
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg>
                            </button> --}}
                        </td>
                    </tr>

                    {{-- REPLY MODAL --}}
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
                                        id="submitReply{{ $complaint->id }}">Save changes</button>
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
                                            console.log(response.data)
                                        })
                                })
                            }
                        })
                    </script>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Nothing to show here</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
