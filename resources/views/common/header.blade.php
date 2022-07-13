<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->first_name }}
                    {{ Auth::user()->last_name }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('admin/img/undraw_profile.svg') }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <button class="dropdown-item" data-toggle="modal" data-target="#editLaundryInfo">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Edit Laundry Info
                </button>
                <button class="dropdown-item" data-toggle="modal" data-target="#changePasswordModal">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Change Password
                </button>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>

            </div>
        </li>

    </ul>
    {{-- EDIT LAUNDRY INFO MODAL --}}
    <div class="modal fade" id="editLaundryInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Laundry Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label text-dark">Landline</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="editLandline">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label text-dark">Contact No.</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="editContactNo">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label text-dark">Time Open</label>
                        <div class="col-sm-10">
                            <input type="time" id="editOpeningTime" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label text-dark">Time Close</label>
                        <div class="col-sm-10">
                            <input type="time" id="editClosingTime" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label text-dark">Description</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="editDescription">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitEditlaundry">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- CHANGE PASSWORD MODAL --}}
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Current Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="currPass">
                            <small class="text-danger d-none" id="currPassHelper">Incorrect Password</small>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label text-dark">New Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="newPass">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="confPass">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitEditPassword">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let laundryInfo = []
        let userInfo = []
        let currPassStatus = false
        $(document).ready(function() {
            const formdata = new FormData()
            formdata.append('user_id', '{{ Auth::user()->id }}')
            axios.post('/getlaundryinfo', formdata)
                .then(response => {
                    laundryInfo = response.data
                })

            const userFormdata = new FormData()
            userFormdata.append('id', "{{ Auth::user()->id }}")
            axios.post('/getpassword', userFormdata)
                .then(response => {
                    userInfo = response.data
                })
        })

        $("#submitEditlaundry").click(function() {
            const landline = $("#editLandline").val()
            const contactNo = $("#editContactNo").val()
            const openingTime = $("#editOpeningTime").val()
            const closingTime = $("#editClosingTime").val()
            const description = $("#editDescription").val()

            if (!$.isNumeric(landline)) {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Landline should be numeric only!",
                    buttons: false
                })
            } else if (!$.isNumeric(contactNo)) {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Contact Number should be numeric only!",
                    buttons: false
                })
            } else if (landline == '' || contactNo == '' || openingTime == '' || closingTime == '' || description ==
                '') {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Make sure that all fields are properly filled!",
                    buttons: false
                })
            } else {
                swal({
                    icon: "warning",
                    title: "Alert!",
                    text: "Are you sure you want to edit the laundry details?",
                    buttons: {
                        cancel: "Cancel",
                        true: "OK"
                    }
                }).then(response => {
                    if (response == 'true') {
                        swal({
                            icon: "success",
                            title: "Success!",
                            text: "Laundry Info has been edited!",
                            buttons: false
                        }).then(() => {
                            // console.log(laundryInfo[0])
                            const formdata = new FormData()
                            formdata.append('laundry_id', laundryInfo[0].laundry_id)
                            formdata.append('landline', landline)
                            formdata.append('contact_no', contactNo)
                            formdata.append('opening_time', openingTime)
                            formdata.append('closing_time', closingTime)
                            formdata.append('description', description)
                            axios.post('/editlaundryinfo', formdata)
                                .then(response => {
                                    location.reload()
                                })
                        })
                    }
                })
            }
        })

        $("#currPass").on('change', function() {
            const currPass = $("#currPass").val()
            const formdata = new FormData()
            formdata.append('id', "{{ Auth::user()->id }}")
            formdata.append('password', currPass)
            axios.post('/checkcurrentpassword', formdata)
                .then(response => {
                    if (response.data == 'error') {
                        $("#currPassHelper").removeClass('d-none')
                        $("#currPass").addClass('is-invalid')
                        $("#currPass").removeClass('is-valid')
                        currPassStatus = false
                    } else {
                        $("#currPassHelper").addClass('d-none')
                        $("#currPass").addClass('is-valid')
                        $("#currPass").removeClass('is-invalid')
                        currPassStatus = true
                    }
                })
        })

        $("#submitEditPassword").click(function() {
            const newPass = $("#newPass").val()
            const confPass = $("#confPass").val()
            if (newPass != confPass) {
                swal({
                    icon: "error",
                    title: "Password Mismatch!",
                    text: "Password and Confirm password should match!",
                    buttons: false
                })
            } else if (currPassStatus == false) {
                swal({
                    icon: "error",
                    title: "Wrong Current Password!",
                    text: "Please input your correct current password!",
                    buttons: false
                })
            } else {
                swal({
                    icon: "success",
                    title: "Success!",
                    text: "Password has been changed!",
                    buttons: false
                }).then(() => {
                    const formdata = new FormData()
                    formdata.append('id', "{{ Auth::user()->id }}")
                    formdata.append('password', newPass)
                    axios.post('/editpassword', formdata)
                        .then(response => {
                            location.reload()
                        })
                })
            }
        })
    </script>
</nav>
