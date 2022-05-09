@extends('layouts.app')

@section('content')
    <div class="w-full flex flex-col items-center justify-center bg-sky-300 p-5">
        <div class="flex flex-col items-center p-4 bg-white" style="border-radius: 20px">
            <h1 class="h1 fw-bold mb-3 text-uppercase">Client Registration</h1>

            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!--------------Laundry Owner Information------------->
                <h1 class="h4 p-2 text-center fw-bold">Laundry Owner Information</h1>
                <div class="row px-3">
                    <div class="col-md-4 mb-3">
                        <label for="" class="fw-bold">First Name</label>
                        <input value="{{ old('fname') }}" type="text" name="fname"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('fname')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="" class="fw-bold">Middle Name</label>
                        <input value="{{ old('mname') }}" type="text" name="mname"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('mname')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="" class="fw-bold">Last Name</label>
                        <input value="{{ old('lname') }}" type="text" name="lname"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('lname')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="row px-3">
                    <div class="col-md-4 mb-3">
                        <label for="" class="fw-bold">Birthday</label>
                        <input value="{{ old('bday') }}" type="text" name="bday"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('bday')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="" class="fw-bold">Cellphone Number</label>
                        <input value="{{ old('cnum') }}" type="text" name="cnum"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('cnum')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="" class="fw-bold">Phone Number</label>
                        <input value="{{ old('pnum') }}" type="text" name="pnum"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('pnum')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="row px-3">
                    <div class="col-md-12 mb-3">
                        <label for="" class="fw-bold">Email</label>
                        <input value="{{ old('email') }}" type="email" name="email"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="row px-3">
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">Password</label>
                        <input value="{{ old('pwd') }}" type="password" name="pwd"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('pwd')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">Confirm Password</label>
                        <input value="{{ old('confpw') }}" type="password" name="confpw"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('confpw')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <!-------------- End of Laundry Owner Information------------->

                <!--------------Laundry Owner's Address------------->
                <h1 class="h4 p-2 text-center mt-3 fw-bold">Laundry Shop's Information</h1>
                <div class="row px-3">
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">Laundry Shop Name</label>
                        <input value="{{ old('laundryName') }}" type="text" name="laundryName"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('laundryName')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">Type of Laundry Shop</label>
                        <select value="{{ old('typeLaundry') }}" name="typeLaundry"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                            <option value="Full Service">Full Service</option>
                            <option value="Self Service">Self Service</option>
                            <option value="Hybrid Service">Hybrid Service</option>
                        </select>
                        @error('typeLaundry')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="" class="fw-bold">Description of Laundry Shop</label>
                        <textarea rows="4" name="description" value="{{ old('description') }}"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"></textarea>
                        @error('description')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">Opening Time</label>
                        <input type="time" name="openingtime"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                        @error('openingtime')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">Closing Time</label>
                        <input type="time" name="closingtime"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                        @error('closingtime')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="row px-3">
                    <div class="col-md-4 mb-3">
                        <label for="" class="fw-bold">Region</label>
                        <select id="region" name="region"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"></select>
                        @error('region')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="" class="fw-bold">State/Province</label>
                        <select id="province" name="province"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"></select>
                        @error('province')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="" class="fw-bold">City</label>
                        <select id="city" name="city"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"></select>
                        @error('city')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="row px-3">
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">Barangay</label>
                        <select id="barangay" name="barangay"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"></select>
                        @error('barangay')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">House No. / Street</label>
                        <input value="{{ old('houseNo') }}" type="text" name="houseNo"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('houseNo')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <!--------------End of Laundry Owner's Address------------->

                <!--------------Laundry Shop Information------------->

                <!--------------End of Laundry Shop Information------------->


                <!--------------Laundry Shop Documents------------->
                <h1 class="h4 p-2 text-center mt-3 fw-bold">Laundry Shop Documents</h1>
                <div class="row px-3">
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">BIR Certificate of Registration</label>
                        <input type="file" name="bir"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('bir')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">Business Permit / Mayor Permit</label>
                        <input type="file" name="business"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('business')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="row px-3">
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">DTI Business Registration</label>
                        <input type="file" name="dti"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('dti')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">Valid ID of Laundry Owner</label>
                        <input type="file" name="valid_id"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('valid_id')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <!--------------End of Laundry Shop Documents------------->


                <div class="d-flex justify-content-center align-items-center flex-column mb-3">
                    <div class="check-box mb-3 mt-3 ">
                        <input type="checkbox" name="" id="" class="mt-1 px-3 py-2 bg-white border">
                        <label for="" class="fw-bold">I have read and agree to the terms and conditions</label>
                    </div>
                    <button class="btn btn-block text-white btn-lg " style="background-color: #FFD580"
                        type="submit">Register</button>
                </div>


            </form>

            {{-- <select id="region"></select> ito na yung fields na kailangan for API ng address. Need nalang ng styling
            <select id="province"></select>
            <select id="city"></select>
            <select id="barangay"></select> --}}
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
    <script src="{{ asset('js/loc.js') }}"></script>
@endsection
