@extends('layouts.master')

@section('content')
    <div class="d-flex mx-4 justify-content-center">
        <div class="h4 text-dark">View Feedbacks</div>
    </div>

    <div class="d-flex justify-content-center">
        <table class="table w-75">
            <thead>
                <tr>
                    <th scope="col">Rating</th>
                    <th scope="col">Name</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($feedbacks as $feedback)
                    <tr>
                        <th scope="row"><i class="fas fa-fw fa-star"></i>{{ $feedback->rating }}/5</th>
                        <td>{{ $feedback->first_name }} {{ $feedback->last_name }}</td>
                        <td>{{ $feedback->comment }}</td>
                        <td>
                            @if ($feedback->status == 'Reviewed')
                                <div class="btn-circle bg-success">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                            @else
                                <button class="btn btn-warning" data-toggle="modal"
                                    data-target="#replyModal{{ $feedback->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </button>
                            @endif
                        </td>
                    </tr>
                    {{-- MODAL FOR Reply --}}
                    <div class="modal fade" id="replyModal{{ $feedback->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><strong>Rating:</strong>
                                                <i class="fas fa-fw fa-star"></i> {{ $feedback->rating }}/5 </label>
                                            <br>
                                            <label for="exampleInputEmail1"><strong>Comment:</strong>
                                                {{ $feedback->comment }}</label>
                                        </div>
                                        <textarea class="form-control" id="reply{{ $feedback->id }}" rows="5" placeholder="Reply here..."></textarea>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="submitReply{{ $feedback->id }}">Save
                                        changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $("#submitReply{{ $feedback->id }}").click(function() {
                            const reply = $("#reply{{ $feedback->id }}").val()
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
                                    text: "Successfully replied to the feedback!",
                                    buttons: false
                                }).then(response => {
                                    const formdata = new FormData()
                                    formdata.append('id', "{{ $feedback->id }}")
                                    formdata.append('reply', reply)
                                    formdata.append('notif_token', "{{ $feedback->notif_token }}")
                                    axios.post('/replytofeedback', formdata)
                                        .then(response => {
                                            location.reload()
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
