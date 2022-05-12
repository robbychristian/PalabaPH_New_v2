import axios from "axios";
import swal from "sweetalert";

if (typeof jQuery === "undefined") {
    var script = document.createElement("script");
    script.src = "http://code.jquery.com/jquery-latest.min.js";
    script.type = "text/javascript";
    document.getElementsByTagName("head")[0].appendChild(script);
}

$("#submitbtn").on("click", function () {
    const number = $("#quantity").val();
    if (number.match(/^\d+$/)) {
        swal("there is a number");
    } else {
        swal("walang number");
    }
});
