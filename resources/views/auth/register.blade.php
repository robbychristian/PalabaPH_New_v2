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
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="" class="fw-bold">Middle Name</label>
                        <input value="{{ old('mname') }}" type="text" name="mname"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('mname')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="" class="fw-bold">Last Name</label>
                        <input value="{{ old('lname') }}" type="text" name="lname"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('lname')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row px-3">
                    <div class="col-md-4 mb-3">
                        <label for="" class="fw-bold">Birthday</label>
                        <input value="{{ old('bday') }}" type="date" name="bday"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('bday')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="" class="fw-bold">Cellphone Number</label>
                        <input value="{{ old('cnum') }}" type="text" name="cnum"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('cnum')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="" class="fw-bold">Phone Number</label>
                        <input value="{{ old('pnum') }}" type="text" name="pnum"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('pnum')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row px-3">
                    <div class="col-md-12 mb-3">
                        <label for="" class="fw-bold">Email</label>
                        <input value="{{ old('email') }}" type="email" name="email"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row px-3">
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">Password</label>
                        <input value="{{ old('pwd') }}" type="password" name="pwd"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('pwd')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">Confirm Password</label>
                        <input value="{{ old('confpw') }}" type="password" name="confpw"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('confpw')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
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
                            <div class="text-danger">
                                {{ $message }}
                            </div>
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
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="" class="fw-bold">Description of Laundry Shop</label>
                        <textarea rows="4" name="description" value="{{ old('description') }}"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"></textarea>
                        @error('description')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">Opening Time</label>
                        <input type="time" name="openingtime"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                        @error('openingtime')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">Closing Time</label>
                        <input type="time" name="closingtime"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                        @error('closingtime')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="" class="fw-bold">Laundry Shop Image</label>
                        <input type="file" name="laundry_img"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('laundry_img')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row px-3">
                    <div class="col-md-4 mb-3">
                        <label for="" class="fw-bold">Region</label>
                        <select id="region" name="region"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"></select>
                        @error('region')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="" class="fw-bold">State/Province</label>
                        <select id="province" name="province"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"></select>
                        @error('province')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="" class="fw-bold">City</label>
                        <select id="city" name="city"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"></select>
                        @error('city')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row px-3">
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">Barangay</label>
                        <select id="barangay" name="barangay"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"></select>
                        @error('barangay')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">House No. / Street</label>
                        <input value="{{ old('houseNo') }}" type="text" name="houseNo"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('houseNo')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
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
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">Business Permit / Mayor Permit</label>
                        <input type="file" name="business"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('business')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row px-3">
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">DTI Business Registration</label>
                        <input type="file" name="dti"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('dti')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="fw-bold">Valid ID of Laundry Owner</label>
                        <input type="file" name="valid_id"
                            class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        @error('valid_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <!--------------End of Laundry Shop Documents------------->


                <div class="d-flex justify-content-center align-items-center flex-column mb-3">
                    <div class="check-box mb-3 mt-3 ">
                        <input type="checkbox" name="" id="" class="mt-1 px-3 py-2 bg-white border">
                        <label for="" class="fw-bold">I have read and agree to the <span>
                                <button class="text-blue-500 underline font-bold hover:text-blue-700 duration-75"
                                    type="button" data-bs-toggle="modal" data-bs-target="#termsModal">terms and
                                    conditions</button>
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        Launch demo modal
                                      </button> --}}
                            </span></label>
                    </div>
                    <button class="btn btn-block text-white btn-lg " style="background-color: #FFD580"
                        type="submit">Register</button>
                </div>


            </form>
            {{-- <select id="region"></select> ito na yung fields na kailangan for API ng address. Need nalang ng styling
            <select id="province"></select>
            <select id="city"></select>
            <select id="barangay"></select> --}}
            <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Terms and Condition</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="fw-bold mb-3">
                                PALABA PH PRIVACY POLICY
                            </div>
                            <div class="mb-3">
                                This outlines our practices for collecting, using, and disclosing
                                Personal Information we receive from users. Kindly read this
                                guideline thoroughly. The collection and use of your Personal
                                Information are only for the purpose of providing and improving
                                the application. By using the application, you consent to the
                                collection and use of the information you give in accordance with
                                this policy.
                            </div>
                            <div class="fw-bold mb-3">
                                DATA MANAGEMENT OF APPLICATION
                            </div>
                            <div class="mb-3">
                                We advise you in advance that we may ask you to give us with some of your personal
                                information when you are use our application. This information can be used to contact and
                                identify you. The types of information that may be collected include but are not limited to
                                your name, email address, cellphone number, city of residency, and profile picture, as well
                                as the inclusion to your own username and password.
                            </div>
                            <div class="fw-bold mb-3">
                                SECURITY
                            </div>
                            <div class="mb-3">
                                We place a high value on the security of your Personal Information, but please keep in mind
                                that no method of transmission over the Internet, or system of electronic storage, is
                                guaranteed to be completely secure. While we make every effort to secure your Personal
                                Information via the use of commercially reasonable safeguards, we cannot guarantee its
                                ultimate security.
                            </div>
                            <div class="fw-bold mb-3">
                                PALABA PH TERMS OF USAGE
                            </div>
                            <div class="mb-3">
                                Before using our application, please take the time to carefully read the following terms and
                                conditions.
                                Acceptance and compliance with these terms are required for access to and use of all the
                                services included within the application. All users, from laundry shop owners in addition to
                                their riders and not to mention the customer who use the application provided service
                                features are subject to these terms.

                                You agree to be bound by these said terms by accessing or using our application. You may not
                                access these aforementioned services if you disagree with any element or aspects of these
                                terms.
                            </div>
                            <div class="fw-bold mb-3">
                                CLIENT REGISTRATION AGREEMENT
                            </div>
                            <div class="mb-3">
                                Palaba PH requires you to send business permits and valid ID’s to validate the legitimacy of
                                your laundry shop. You are responsible for any information you send via the registration.
                                Any type of fraud or falsification of documents will be immediately blocked in using the
                                system. The business permits and valid ID’s are subject for approval of the admin.
                            </div>
                            <div class="fw-bold mb-3">
                                PALABA PH AND THE PARTNER LAUNDRY SHOPS
                            </div>
                            <div class="mb-3">
                                Palaba PH’s administration has no relations and control over the partner laundry shop’s
                                promotion, and accepts no responsibility for, the content, policies and actions of the
                                laundry shops. Additionally, you acknowledge and agree that the administrators of Palaba PH
                                shall not be responsible or liable, directly or indirectly, for any damage or loss caused or
                                alleged to be caused by the partner laundry shops of the Palaba PH.
                            </div>
                            <div class="fw-bold mb-3">
                                CONTRACT DOWNLOAD
                            </div>
                            <div class="mb-3">
                                Agreeing upon this <span class="text-primary">terms and condition</span> will proceed in
                                downloading the terms and condition PDF.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
    <script src="{{ asset('js/loc.js') }}"></script>
@endsection
