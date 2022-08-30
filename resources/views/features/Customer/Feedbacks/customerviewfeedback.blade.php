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
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->name }}</td>
                                <td>{{ $feedback->category }}</td>
                                <td>{{ $feedback->comment }}</td>
                                <td>
                                    @if ($feedback->status == 'Pending')
                                        <span class="text-yellow-500">{{ $feedback->status }}</span>
                                    @else
                                        <span class="text-green-500">{{ $feedback->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($feedback->reply != null)
                                        {{ $feedback->reply }}
                                    @else
                                        No Reply Yet!
                                    @endif
                                </td>
                                <td>
                                    <div class="flex justify-start ml-1 text-yellow-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                    </div>
                                    <span>{{ $feedback->rating }}/5</span>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
