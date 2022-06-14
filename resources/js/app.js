import moment from "moment";
import swal from "sweetalert";
const { default: axios } = require("axios");

require("./bootstrap");

// ==================================== ORDERS ==================================== //

let checked = "";

$("#orderForm input").on("change", function () {
    const radioChecked = $(
        "input[name=customerState]:checked",
        "#orderForm"
    ).val();
    if (radioChecked == "registered") {
        checked = "registered";
        console.log("registered");
        $("#unregisteredName").addClass("d-none");
        $("#registeredName").removeClass("d-none");
    } else {
        console.log("unregistered");
        checked = "unregistered";
        $("#registeredName").addClass("d-none");
        $("#unregisteredName").removeClass("d-none");
    }
});

$("#cashRecepitSubmit").on("click", function () {
    swal({
        icon: "warning",
        title: "Warning!",
        text: "Are you sure you want to submit the receipt?",
        buttons: {
            cancel: "Cancel",
            true: "OK",
        },
    }).then((response) => {
        const csrfToken = $("#csrfToken").val();
        if (response === "true") {
            swal({
                icon: "success",
                title: "Success!",
                text: "The order has been created!",
                buttons: false,
            }).then((response) => {
                const numberOfRows = $("#numberOfRows").val();
                const laundryId = $("#laundryId").val();
                let userId = "";
                let fname = "";
                let mname = "";
                let lname = "";
                if (checked == "registered") {
                    userId = $("#orderingCustomerId").val();
                    fname = $("#registeredFname" + userId).html();
                    mname = $("#registeredMname" + userId).html();
                    lname = $("#registeredLname" + userId).html();
                } else if (checked == "unregistered") {
                    fname = $("#fname").val();
                    mname = $("#mname").val();
                    lname = $("#lname").val();
                }
                // const userId = $("#orderingCustomerId").val();
                // const fname = $("#fname").val();
                // const mname = $("#mname").val();
                // const lname = $("#lname").val();
                for (let i = 1; i <= numberOfRows; i++) {
                    const machineTimer = Number($("#machineTimer" + i).html());
                    const machineId = $("#machineCount" + i).html();
                    const timeEnd = moment().add(machineTimer, "m");
                    console.log(machineTimer);
                    const machineService = $("#machineService" + i).val();
                    const machineFormData = new FormData();
                    machineFormData.append("id", machineId);
                    machineFormData.append("user_id", userId);
                    machineFormData.append("first_name", fname);
                    machineFormData.append("middle_name", mname);
                    machineFormData.append("last_name", lname);
                    machineFormData.append("machine_service", machineService);
                    machineFormData.append("time_end", timeEnd);
                    machineFormData.append("csrf-token", csrfToken);

                    axios
                        .post("/changemachinestate", machineFormData)
                        .then((response) => {
                            console.log(response.data);
                        });
                }
                const totalPrice = Number($("#totalPrice").html());
                const totalTime = Number($("#totalTime").html());
                const segregationType = $("#laundrySegregation").val();
                const commodity = $("#laundryCommodity").val();
                const formData = new FormData();
                formData.append("csrf-token", csrfToken);
                formData.append("laundry_id", laundryId);
                formData.append("user_id", userId);
                formData.append("first_name", fname);
                formData.append("middle_name", mname);
                formData.append("last_name", lname);
                formData.append("total_price", totalPrice);
                formData.append("total_time", totalTime);
                formData.append("segregation_type", segregationType);
                formData.append("type_of_commodity", commodity);
                formData.append("mode_of_payment", "cash");
                axios
                    .post("/submitorder", formData, {
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    })
                    .then((response) => {
                        console.log(response.data);
                    });
            });
        }
    });
});

$("#cashlessRecepitSubmit").on("click", function () {
    swal({
        icon: "warning",
        title: "Warning!",
        text: "Are you sure you want to submit the receipt?",
        buttons: {
            cancel: "Cancel",
            true: "OK",
        },
    }).then((response) => {
        const csrfToken = $("#csrfToken").val();
        if (response === "true") {
            swal({
                icon: "success",
                title: "Success!",
                text: "The order has been created!",
                buttons: false,
            }).then((response) => {
                const numberOfRows = $("#numberOfRows").val();
                const laundryId = $("#laundryId").val();
                let userId = "";
                let fname = "";
                let mname = "";
                let lname = "";
                if (checked == "registered") {
                    userId = $("#orderingCustomerId").val();
                    fname = $("#registeredFname" + userId).html();
                    mname = $("#registeredMname" + userId).html();
                    lname = $("#registeredLname" + userId).html();
                } else if (checked == "unregistered") {
                    fname = $("#fname").val();
                    mname = $("#mname").val();
                    lname = $("#lname").val();
                }
                // const userId = $("#orderingCustomerId").val();
                // const fname = $("#fname").val();
                // const mname = $("#mname").val();
                // const lname = $("#lname").val();
                for (let i = 1; i <= numberOfRows; i++) {
                    const machineTimer = Number($("#machineTimer" + i).html());
                    const machineId = $("#machineCount" + i).html();
                    const timeEnd = moment().add(machineTimer, "m");
                    console.log(machineTimer);
                    const machineService = $("#machineService" + i).val();
                    const machineFormData = new FormData();
                    machineFormData.append("id", machineId);
                    machineFormData.append("user_id", userId);
                    machineFormData.append("first_name", fname);
                    machineFormData.append("middle_name", mname);
                    machineFormData.append("last_name", lname);
                    machineFormData.append("machine_service", machineService);
                    machineFormData.append("time_end", timeEnd);
                    machineFormData.append("csrf-token", csrfToken);

                    axios
                        .post("/changemachinestate", machineFormData)
                        .then((response) => {
                            console.log(response.data);
                        });
                }
                const totalPrice = Number($("#totalPrice").html());
                const totalTime = Number($("#totalTime").html());
                const segregationType = $("#laundrySegregation").val();
                const commodity = $("#laundryCommodity").val();
                const formData = new FormData();
                formData.append("csrf-token", csrfToken);
                formData.append("laundry_id", laundryId);
                formData.append("user_id", userId);
                formData.append("first_name", fname);
                formData.append("middle_name", mname);
                formData.append("last_name", lname);
                formData.append("total_price", totalPrice);
                formData.append("total_time", totalTime);
                formData.append("segregation_type", segregationType);
                formData.append("type_of_commodity", commodity);
                formData.append("mode_of_payment", "cashless");
                axios
                    .post("/submitorder", formData, {
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    })
                    .then((response) => {
                        console.log(response.data);
                    });
            });
        }
    });
});

$("#addRiderButton").on("click", function () {
    const laundryId = $("#laundryId").html();
    const fname = $("#riderFname").val();
    const mname = $("#riderMname").val();
    const lname = $("#riderLname").val();
    const cnum = $("#contactNo").val();
    const email = $("#riderEmail").val();
    const pass = $("#riderPass").val();
    const cpass = $("#riderCpass").val();

    if (
        fname === "" ||
        mname === "" ||
        lname === "" ||
        cnum === "" ||
        email === "" ||
        pass === "" ||
        cpass === ""
    ) {
        swal({
            icon: "error",
            title: "Error!",
            text: "Some fields are not filled!",
            buttons: false,
        });
    } else if (pass !== cpass) {
        swal({
            icon: "error",
            title: "Error!",
            text: "Password does not match!",
            buttons: false,
        });
    } else {
        swal({
            icon: "warning",
            title: "Warning!",
            text: "Are you sure you want to add this rider?",
            buttons: {
                cancel: "Cancel",
                true: "OK",
            },
        }).then((response) => {
            if (response === "true") {
                swal({
                    icon: "success",
                    title: "Success!",
                    text: "The rider has been added",
                    buttons: false,
                }).then((response) => {
                    const formdata = new FormData();
                    formdata.append("laundry_id", laundryId);
                    formdata.append("first_name", fname);
                    formdata.append("middle_name", mname);
                    formdata.append("last_name", lname);
                    formdata.append("contact_no", cnum);
                    formdata.append("email", email);
                    formdata.append("password", pass);
                    axios
                        .post("/addriders", formdata)
                        .then((response) => {
                            console.log(response.data);
                        })
                        .catch((e) => {
                            console.log(e);
                        });
                });
            }
        });
    }
});
