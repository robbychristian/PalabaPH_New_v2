@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-2 h-screen">
        <div class="col-span-1 h-full">
            <div class="flex flex-col px-3 h-full">
                <div class="text-9xl text-gray-200">
                    Have a Complaint?
                </div>
                <div class="text-base text-gray-400 px-3 mt-3">Sorry for the inconvinience that we have caused. Submit a form
                    to
                    relay your complaint!</div>

                <div class="flex justify-center h-full m-3">
                    <div class="border-2 border-gray-500 h-full w-[60vh] rounded-md shadow-md">
                        <div class="flex justify-center">
                            <div class="text-xl font-bold">Complaints Form</div>
                        </div>

                        <div class="flex justify-center my-5">
                            <div class="w-[90%]">
                                <div class="grid grid-cols-8 my-2">
                                    <div class="col-span-2">
                                        <label for="category" class="col-form-label">Category</label>
                                    </div>
                                    <div class="col-span-6">
                                        <select name="category" id="category" class="form-select">
                                            <option value="Back Job">Back Job</option>
                                            <option value="Missing Items">Missing Items</option>
                                            <option value="Improper Handling">Improper Handling</option>
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
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" id="complaintFile">
                                    <label class="input-group-text" for="complaintFile">Upload</label>
                                </div>
                                <div class="flex w-full my-2">
                                    <button class="btn btn-primary w-full" id="submitComplaint">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-1 h-full">
            <div class="h-full bg-center bg-cover" style="background-image: url('{{ asset('images/complaint.jpg') }}')">
            </div>
        </div>
    </div>

    <script>
        let categoryStatus = false
        let commentStatus = false
        let file = {}
        let fileName = ''
        $("#complaintFile").change((e) => {
            file = e.target.files[0]
            fileName = e.target.files[0].name
        })
        $("#submitComplaint").click(() => {
            const category = $("#category").find(':selected').text()
            const comment = $("#comment").val()
            if (comment == '') {
                commentStatus = false
            } else {
                commentStatus = true
            }


            if (commentStatus == false) {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Some forms are not properly filled!",
                    buttons: false
                })
            } else {
                swal({
                    icon: "success",
                    title: "Complaints Submitted!",
                    text: "Your complaint has been submitted! It might take awhile to process.",
                    buttons: false
                }).then(() => {
                    const formdata = new FormData()
                    formdata.append('comment', comment)
                    formdata.append('category', category)
                    formdata.append('status', "Pending")
                    formdata.append('laundry_id', "{{ $laundry_id }}")
                    formdata.append('user_id', "{{ Auth::guard('customer')->user()->id }}")
                    formdata.append('complaint_image', file)
                    axios.post('/customer/submitcomplaints', formdata)
                        .then(response => {
                            location.reload()
                        })
                })
            }
        })
    </script>
@endsection
