const { default: axios } = require("axios");

require("./bootstrap");

// ==================================== ORDERS ==================================== //
$("#orderForm input").on("change", function () {
    const radioChecked = $(
        "input[name=customerState]:checked",
        "#orderForm"
    ).val();
    if (radioChecked == "registered") {
        console.log("registered");
        $("#unregisteredName").addClass("d-none");
        $("#registeredName").removeClass("d-none");
    } else {
        console.log("unregistered");
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
        if (response === "true") {
            swal({
                icon: "success",
                title: "Success!",
                text: "The order has been created!",
                buttons: false,
            }).then((response) => {
                const csrfToken = $("#csrfToken").val();
                const userId = $("#orderingCustomerId").val();
                const fname = $("#fname").val();
                const mname = $("#mname").val();
                const lname = $("#lname").val();
                const totalPrice = Number($("#totalPrice").html());
                const totalTime = Number($("#totalTime").html());
                const commodity = $("#laundryCommodity").val();
                const formData = new FormData();
                formData.append("csrf-token", csrfToken);
                formData.append("user_id", userId);
                formData.append("first_name", fname);
                formData.append("middle_name", mname);
                formData.append("last_name", lname);
                formData.append("total_price", totalPrice);
                formData.append("total_time", totalTime);
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
