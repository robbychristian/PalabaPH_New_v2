@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-2 h-screen">
        <div class="col-span-1 h-full">
            <div class="h-full bg-center bg-cover" style="background-image: url('{{ asset('images/feedback.jpg') }}')"></div>
        </div>
        <div class="col-span-1 h-full">
            <div class="flex flex-col px-3 h-full">
                <div class="text-9xl text-gray-200">
                    Send us a Feedback!
                </div>
                <div class="text-base text-gray-400 px-3">Your feedback would greatly help us in further improving!</div>

                <div class="flex justify-center h-full m-3">
                    <div class="border-2 border-gray-500 h-full w-[60vh] rounded-md shadow-md">
                        <div class="flex justify-center">
                            <div class="text-xl">Feedback Form</div>
                        </div>

                        <div class="flex justify-center my-5">
                            <div class="w-[90%]">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">Rating</label>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rating" id="inlineRadio1"
                                                value="1">
                                            <label class="form-check-label" for="inlineRadio1">1</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rating" id="inlineRadio2"
                                                value="2">
                                            <label class="form-check-label" for="inlineRadio2">2</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rating" id="inlineRadio2"
                                                value="3">
                                            <label class="form-check-label" for="inlineRadio2">3</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rating" id="inlineRadio2"
                                                value="4">
                                            <label class="form-check-label" for="inlineRadio2">4</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rating" id="inlineRadio2"
                                                value="5">
                                            <label class="form-check-label" for="inlineRadio2">5</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="category" class="col-form-label">Category</label>
                                    </div>
                                    <div class="col-auto">
                                        <select name="category" id="category" class="form-select">
                                            <option value="Quality Service">Quality Service</option>
                                            <option value="Affordable">Affordable</option>
                                            <option value="Improvements">Improvements</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-8 my-2">
                                    <div class="col-span-2">
                                        <label for="" class="col-form-label">Comment</label>
                                    </div>
                                    <div class="col-span-6">
                                        <textarea name="" id="comment" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="flex w-full my-2">
                                    <button class="btn btn-primary w-full" id="submitFeedback">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let ratingStatus = false
        let commentStatus = false
        $("#submitFeedback").click(() => {
            const rating = $("input[type=radio][name=rating]:checked").val()
            const category = $("#category").find(':selected').text()
            const comment = $("#comment").val()
            if (rating) {
                ratingStatus = true
            } else {
                ratingStatus = false
            }
            if (comment == '') {
                commentStatus = false
            } else {
                commentStatus = true
            }

            if (ratingStatus == false || commentStatus == false) {
                swal({
                    icon: 'error',
                    title: "Error!",
                    text: "Some forms are not properly filled!",
                    buttons: false,
                })
            } else {
                swal({
                    icon: "success",
                    title: "Feedback Submitted!",
                    text: "Your feedback has been submitted!",
                    buttons: false
                }).then(() => {
                    const formdata = new FormData()
                    formdata.append('laundry_id', '{{ $laundry_id }}')
                    formdata.append('user_id', '{{ Auth::guard('customer')->user()->id }}')
                    formdata.append('comment', comment)
                    formdata.append('category', category)
                    formdata.append('status', 'Pending')
                    formdata.append('rating', rating)
                    axios.post('/customer/submitfeedback', formdata)
                        .then(response => {
                            location.reload()
                        })
                })
            }
        })
    </script>
@endsection
