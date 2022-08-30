<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #invoice-POS {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding: 2mm;
            margin: 0 auto;
            width: 44mm;
            background: #fff;
        }

        #invoice-POS ::selection {
            background: #f31544;
            color: #fff;
        }

        #invoice-POS ::moz-selection {
            background: #f31544;
            color: #fff;
        }

        #invoice-POS h1 {
            font-size: 1.5em;
            color: #222;
        }

        #invoice-POS h2 {
            font-size: 0.9em;
        }

        #invoice-POS h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        #invoice-POS p {
            font-size: 0.7em;
            color: #666;
            line-height: 1.2em;
        }

        #invoice-POS #top,
        #invoice-POS #mid,
        #invoice-POS #bot {
            /* Targets all id with &#39;
 col-&#39;
 */
            border-bottom: 1px solid #eee;
        }

        #invoice-POS #top {
            min-height: 100px;
        }

        #invoice-POS #mid {
            min-height: 80px;
        }

        #invoice-POS #bot {
            min-height: 50px;
        }

        #invoice-POS #top .logo {
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
            background-size: 60px 60px;
        }

        #invoice-POS .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }

        #invoice-POS .info {
            display: block;
            margin-left: 0;
        }

        #invoice-POS .title {
            float: right;
        }

        #invoice-POS .title p {
            text-align: right;
        }

        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
        }

        #invoice-POS .tabletitle {
            font-size: 0.5em;
            background: #eee;
        }

        #invoice-POS .service {
            border-bottom: 1px solid #eee;
        }

        #invoice-POS .item {
            width: 24mm;
        }

        #invoice-POS .itemtext {
            font-size: 0.5em;
        }

        #invoice-POS #legalcopy {
            margin-top: 5mm;
        }
    </style>
</head>

<body>

    <div id="invoice-POS">

        <center id="top">
            {{-- <div class="logo"></div> --}}
            <div class="info">
                <h2>{{ $laundry_info->name }}</h2>
            </div>
            <!--End Info-->
        </center>
        <!--End InvoiceTop-->

        <div id="mid">
            <div class="info">
                <h2>Contact Info</h2>
                <p>
                    Address : {{ $laundry_info->street }}, {{ Str::substr($laundry_info->barangay, 0, 9) }}, {{ Str::substr($laundry_info->city, 0, 6) }}</br>
                    Landline No. : {{ $laundry_info->landline }}</br>
                    Contact No. : {{ $laundry_info->phone }}</br>
                </p>
            </div>
        </div>
        <!--End Invoice Mid-->

        <div id="bot">

            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>Item</h2>
                        </td>
                        <td class="Hours">
                            
                        </td>
                        <td class="Rate">
                            <h2>Value</h2>
                        </td>
                    </tr>

                    <tr class="service">
                        <td class="tableitem">
                            <p class="itemtext">Name</p>
                        </td>
                        <td class="tableitem" colspan="2">
                            <p class="itemtext">{{ $order->first_name }} {{ $order->last_name }}</p>
                        </td>
                    </tr>

                    <tr class="service">
                        <td class="tableitem">
                            <p class="itemtext">Segregation Type</p>
                        </td>
                        <td class="tableitem" colspan="2">
                            <p class="itemtext">{{ $order->segregation_type }}</p>
                        </td>
                    </tr>

                    <tr class="service">
                        <td class="tableitem">
                            <p class="itemtext">Commodity Type</p>
                        </td>
                        <td class="tableitem" colspan="2">
                            <p class="itemtext">{{ $order->commodity_type }}</p>
                        </td>
                    </tr>


                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate">
                            <h2>Mode of Payment</h2>
                        </td>
                        <td class="payment">
                            <h2>{{ $order->mode_of_payment }}</h2>
                        </td>
                    </tr>

                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate">
                            <h2>Total</h2>
                        </td>
                        <td class="payment">
                            <h2>P{{ $order->total_price }}</h2>
                        </td>
                    </tr>

                </table>
            </div>
            <!--End Table-->

            <div id="legalcopy">
                <p class="legal"><strong>Thank you for your business!</strong>  {{ $laundry_info->name }} appreciates your service.
                </p>
            </div>

        </div>
        <!--End InvoiceBot-->
    </div>
    <!--End Invoice-->

</body>

</html>
