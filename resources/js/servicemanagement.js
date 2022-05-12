import axios from "axios";
import swal from "sweetalert";

if (typeof jQuery === "undefined") {
    var script = document.createElement("script");
    script.src = "http://code.jquery.com/jquery-latest.min.js";
    script.type = "text/javascript";
    document.getElementsByTagName("head")[0].appendChild(script);
}

$("#submitService").on("click", () => {
    swal({
        icon: "warning",
        title: "Alert!",
        text: "Are you sure you want to add this service?",
        buttons: {
            cancel: "No",
            true: "Yes",
        },
    }).then((response) => {
        if (response === "true") {
            $("#addservice").submit();
        }
    });
});

$("#additionalServices").on("click", () => {
    swal({
        icon: "warning",
        title: "Alert!",
        text: "Are you sure you want to add this additional service?",
        buttons: {
            cancel: "No",
            true: "Yes",
        },
    }).then((response) => {
        if (response === "true") {
            $("#additionalService").submit();
        }
    });
});

$("#additionalProducts").on("click", () => {
    swal({
        icon: "warning",
        title: "Alert!",
        text: "Are you sure you want to add this additional service?",
        buttons: {
            cancel: "No",
            true: "Yes",
        },
    }).then((response) => {
        if (response === "true") {
            $("#additionalProduct").submit();
        }
    });
});
