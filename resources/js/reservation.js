const moment = require("moment");
import axios from "axios";
import swal from "sweetalert";

$("#addTimeSlotButton").click(function () {
    const timeStart = $("#slotTimeStart").val();
    const timeEnd = $("#slotTimeEnd").val();
    const openingTime = $("#openingTime").val();
    const closingTime = $("#closingTime").val();
    // FORMATTED and for FORMDATA
    const formattedTimeStart = moment(`2018-06-15 ${timeStart}`).format(
        "LL HH:mm"
    );
    const formattedTimeEnd = moment(`2018-06-15 ${timeEnd}`).format("LL HH:mm");
    const formattedOpeningTime = moment(openingTime).format("LL HH:mm");
    const formattedClosingTime = moment(closingTime).format("LL HH:mm");
    const laundryId = $("#laundryId").val();

    //STATE OF TIME
    let timeStartValid = false;
    let timeEndValid = false;
    let slotValid = false;

    if (
        moment(formattedTimeStart).isAfter(formattedOpeningTime) &&
        moment(formattedTimeStart).isBefore(formattedClosingTime)
    ) {
        timeStartValid = true;
        console.log("Time Start Valid");
    } else {
        timeStartValid = false;
        console.log("Time Start Invalid");
    }

    if (
        moment(formattedTimeEnd).isBefore(formattedClosingTime) &&
        moment(formattedTimeEnd).isAfter(formattedOpeningTime)
    ) {
        timeEndValid = true;
        console.log("Time End Valid");
    } else {
        timeEndValid = false;
        console.log("Time End Invalid");
    }

    if (moment(formattedTimeStart).isBefore(formattedTimeEnd)) {
        slotValid = true;
        console.log("Time End Valid");
    } else {
        slotValid = false;
        console.log("Time End Invalid");
    }

    if (timeStartValid == true && timeEndValid == true && slotValid == true) {
        swal({
            icon: "warning",
            title: "Add Time Slot?",
            text: "Are you sure you want to add a time slot?",
            buttons: {
                cancel: "Cancel",
                true: "OK",
            },
        }).then((response) => {
            if (response == "true") {
                const formdata = new FormData();
                formdata.append("laundry_id", laundryId);
                formdata.append(
                    "time_start",
                    moment(formattedTimeStart).format("HH:mmA")
                );
                formdata.append(
                    "time_end",
                    moment(formattedTimeEnd).format("HH:mmA")
                );
                swal({
                    icon: "success",
                    title: "Time Slot Added!",
                    text: "The time slot has been added!",
                    buttons: false,
                }).then((response) => {
                    axios.post("/addtimeslot", formdata).then((response) => {
                        location.reload();
                    });
                });
            }
        });
    } else {
        swal({
            icon: "error",
            title: "Error!",
            text: "Invalid Time to set a time slot!",
            buttons: false,
        });
    }
});
