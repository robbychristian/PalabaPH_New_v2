@extends('layouts.app')

@section('content')
    <div class="flex justify-center mt-4 w-full">
        <div class="text-2xl">
            Laundries
        </div>
    </div>
    <div class="flex justify-center">
        <div class="h-full grid grid-cols-4 space-x-4">
            @foreach ($laundries as $laundry)
                <div class="col-span-1 my-5">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('storage/laundry_img_pics/' . $laundry->user_id . '/' . $laundry->laundry_img) }}"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="text-xl font-bold">{{ $laundry->name }}</h5>
                            <div class="my-2">
                                <p class="text-xs text-gray-400"><span
                                        id="openTime{{ $laundry->laundry_id }}">{{ $laundry->opening_time }}</span> - <span
                                        id="closeTime{{ $laundry->laundry_id }}">{{ $laundry->closing_time }}</span></p>
                                <p class="text-xs text-gray-400">{{ $laundry->type_of_laundry }}</p>
                                <p class="text-xs text-gray-400">{{ $laundry->phone }}</p>
                            </div>
                            <div class="flex justify-end w-full space-x-1">

                                <a href="{{ route('customer.laundry', $laundry->laundry_id) }}"
                                    class="btn btn-primary">Order</a>
                                <button data-bs-toggle="modal" data-bs-target="#Modal"
                                    class="bg-green-500 flex justify-center items-center p-2 rounded-md text-white cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                    </svg>
                                </button>

                                <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Support</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body w-full">
                                                <div class="flex justify-around w-full">
                                                    <a href="/customer/feedback/{{ $laundry->laundry_id }}"
                                                        class="btn btn-success">Send Feedback</a>
                                                    <a href="/customer/complaints/{{ $laundry->laundry_id }}"
                                                        class="btn btn-danger">Send Complaint</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(() => {
                        const openTime = $("#openTime{{ $laundry->laundry_id }}").html()
                        const closeTime = $("#closeTime{{ $laundry->laundry_id }}").html()
                        const formattedOpen = moment(openTime).format('h:mm A')
                        const formattedClose = moment(closeTime).format('h:mm A')
                        $("#openTime{{ $laundry->laundry_id }}").text(formattedOpen)
                        $("#closeTime{{ $laundry->laundry_id }}").text(formattedClose)
                    })
                </script>
            @endforeach
        </div>
    </div>
@endsection
