import axios from "axios";
import swal from "sweetalert";

if (typeof jQuery === "undefined") {
    var script = document.createElement("script");
    script.src = "http://code.jquery.com/jquery-latest.min.js";
    script.type = "text/javascript";
    document.getElementsByTagName("head")[0].appendChild(script);
}

let validQuantity = false;
let validThreshold = false;

$("#quantity").on("change", function () {
    const quantity = $("#quantity").val();
    if (!quantity.match(/^\d+$/)) {
        validQuantity = false;
        $("#quantity").addClass("is-invalid");
        $("#quantity").removeClass("is-valid");
    } else {
        validQuantity = true;
        $("#quantity").removeClass("is-invalid");
        $("#quantity").addClass("is-valid");
    }
});

$("#threshold").on("change", function () {
    const threshold = $("#threshold").val();
    if (!threshold.match(/^\d+$/)) {
        validThreshold = false;
        $("#threshold").addClass("is-invalid");
        $("#threshold").removeClass("is-valid");
    } else {
        validThreshold = true;
        $("#threshold").removeClass("is-invalid");
        $("#threshold").addClass("is-valid");
    }
});

$("#submitbtn").on("click", function () {
    const quantity = Number($("#quantity").val());
    const threshold = Number($("#threshold").val());
    if (validQuantity === false) {
        swal({
            icon: "error",
            title: "Invalid Input!",
            text: "Quantity should only be numbers!",
            buttons: false,
        });
    } else if (validThreshold === false) {
        swal({
            icon: "error",
            title: "Invalid Input!",
            text: "Threshold should only be numbers!",
            buttons: false,
        });
    } else if (quantity < threshold) {
        swal({
            icon: "error",
            title: "Invalid Input!",
            text: "Quantity should be greater than threshold!",
            buttons: false,
        });
    } else {
        swal({
            icon: "success",
            title: "Item added!",
            text: "Item has been added to your inventory!",
            buttons: false,
        }).then((response) => {
            $("#formItem").submit();
        });
    }
});
