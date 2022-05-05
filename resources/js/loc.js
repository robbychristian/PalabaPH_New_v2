import {
    regions,
    provinces,
    cities,
    barangays,
} from "select-philippines-address";
import axios from "axios";

if (typeof jQuery === "undefined") {
    var script = document.createElement("script");
    script.src = "http://code.jquery.com/jquery-latest.min.js";
    script.type = "text/javascript";
    document.getElementsByTagName("head")[0].appendChild(script);
}

window.onload = function () {
    regions().then((response) => {
        const region = document.getElementById("region");
        response.map((item, id) => {
            const option = new Option(
                item.region_name,
                item.region_code + item.region_name
            );
            region.appendChild(option);
        });
        // console.log(response);
    });
};

$("#region").on("change", function () {
    $("#province").find("option").remove();
    $("#city").find("option").remove();
    $("#barangay").find("option").remove();
    const region = $("#region").val();
    const regionCode = region.substring(0, 2);
    const province = document.getElementById("province");
    console.log(regionCode);
    axios
        .get(
            "https://isaacdarcilla.github.io/philippine-addresses/province.json"
        )
        .then((response) => {
            const provinces = response.data;
            provinces.map((item, id) => {
                if (item.region_code == regionCode) {
                    const option = new Option(
                        item.province_name,
                        item.province_code + item.province_name
                    );
                    province.appendChild(option);
                }
            });
        });
});

$("#province").on("change", function () {
    $("#city").find("option").remove();
    $("#barangay").find("option").remove();
    const province = $("#province").val();
    const provinceCode = province.substring(0, 4);
    const city = document.getElementById("city");
    axios
        .get("https://isaacdarcilla.github.io/philippine-addresses/city.json")
        .then((response) => {
            const cities = response.data;
            console.log(provinceCode);
            cities.map((item, id) => {
                if (item.province_code == provinceCode) {
                    const option = new Option(
                        item.city_name,
                        item.city_code + item.city_name
                    );
                    city.appendChild(option);
                }
            });
        });
});

$("#city").on("change", function () {
    $("#barangay").find("option").remove();
    const city = $("#city").val();
    const cityCode = city.substring(0, 6);
    const barangay = document.getElementById("barangay");
    axios
        .get(
            "https://isaacdarcilla.github.io/philippine-addresses/barangay.json"
        )
        .then((response) => {
            const barangays = response.data;
            barangays.map((item, id) => {
                if (item.city_code == cityCode) {
                    const option = new Option(
                        item.brgy_name,
                        item.brgy_code + item.brgy_name
                    );
                    barangay.appendChild(option);
                }
            });
        });
});
