{{-- @component('mail::message')
    Click Below to Verify your account!

    <a href="https://palabaph.com/verifyemail/{{ $email }}/{{ $data }}">
        Verify
    </a>


    Thanks,<br>
    {{ config('app.name') }}
@endcomponent --}}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    {{-- <link rel="icon" sizes="" href="https://yt3.ggpht.com/a-/AN66SAzzGZByUtn6CpHHJVIEOuqQbvAqwgPiKy1RTw=s900-mo-c-c0xffffffff-rj-k-no" type="image/jpg" /> --}}
    <title>Email Warning</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            color: #404040;
        }

        .center {
            text-align: center;
        }

        .tight {
            padding: 15px 30px;
        }

        td {
            padding: 20px 50px 30px 50px;
        }

        td.notification {
            padding: 10px 50px 30px 50px;
        }

        small,
        .small {
            font-size: 12px;
        }

        .footer {
            padding: 15px 30px;
        }

        .footer p {
            font-size: 12px;
            margin: 0;
            color: #606060;
        }

        a,
        a:hover,
        a:visited {
            color: #000000;
            text-decoration: underline;
        }

        h1,
        h2 {
            font-size: 22px;
            color: #404040;
            font-weight: normal;
        }

        p {
            font-size: 15px;
            color: #606060;
        }

        .general {
            background-color: white;
        }

        .notification h1 {
            font-size: 26px;
            color: #000000;
            font-weight: normal;
        }

        .notification p {
            font-size: 18px;
        }

        .notification p.small {
            font-size: 14px;
        }

        .icon {
            width: 32px;
            height: 32px;
            line-height: 32px;
            display: inline-block;
            text-align: center;
            border-radius: 16px;
            margin-right: 10px;
        }

        .failure {
            border-top: 20px #b02020 solid;
            background-color: #db9c9b;
        }

        .critical {
            border-top: 20px #c05050 solid;
            background-color: #e2afae;
        }

        .warning {
            border-top: 20px #c08040 solid;
            background-color: #e0c4aa;
        }

        .healthy {
            border-top: 20px #80c080 solid;
            background-color: #c6e2c3;
        }

        .information {
            border-top: 20px #50a0c0 solid;
            background-color: #b5d5e2;
        }

        .failure p {
            color: #3d120f;
        }

        .critical p {
            color: #3d211f;
        }

        .warning p {
            color: #44311c;
        }

        .healthy p {
            color: #364731;
        }

        .information p {
            color: #273c47;
        }

        .failure .icon {
            background-color: #b02020;
            color: #ffffff;
        }

        .critical .icon {
            background-color: #c05050;
            color: #ffffff;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .warning .icon {
            background-color: #c08040;
            color: #ffffff;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .healthy .icon {
            background-color: #80c080;
            color: #ffffff;
        }

        .information .icon {
            background-color: #50a0c0;
            color: #ffffff;
            font-family: Georgia, "Times New Roman", Times, serif;
            font-style: italic;
        }

        .content {
            width: 600px;
        }

        @media only screen and (max-width: 600px) {
            .content {
                width: 100%;
            }
        }

        @media only screen and (max-width: 400px) {
            td {
                padding: 15px 25px;
            }

            h1,
            h2 {
                font-size: 20px;
            }

            p {
                font-size: 13px;
            }

            small,
            .small {
                font-size: 11px;
            }

            td.notification {
                text-align: center;
                padding: 10px 25px 15px 25px;
            }

            .notification h1 {
                font-size: 22px;
            }

            .notification p {
                font-size: 16px;
            }

            .notification p.small {
                font-size: 12px;
            }

            .icon {
                display: block;
                margin: 0 auto 10px auto;
            }
        }
    </style>
</head>

<body style="margin: 0; padding: 0">
    <table style="border: none" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 15px 0">
                <table style="border: none; margin-left: auto; margin-right: auto" cellpadding="0" cellspacing="0" width="600" class="content">
                    <!-- Start: Small header text in pale grey email background -->
                    <tr>
                        <td class="center tight small"><a href="https://palabaph.com" target="_blank">PalabaPH</a> Mailer System</td>
                    </tr>
                    <!-- End: Small header text in pale grey email background -->

                    <!-- Start: White block with text content -->
                    <tr>
                        <td class="general center">
                            <h1>PalabaPH</h1>
                            <p>This email is generated through the PalabaPH Web Application.</p>
                            <p class="small">The email contains vital information about your account</p>
                        </td>
                    </tr>
                    <!-- End: White block with text content -->

                    <!-- Start: Critical Notification -->
                    <tr>
                        <td class="healthy notification">
                            <h1><span class="icon">&excl;</span>Email Verification</h1>
                            <p>This email is for verifying your email used in your account</p>
                            <a href="https://palabaph.com/verifyemail/{{ $email }}/{{ $data }}" class="small">Click here to verify your account!</a>
                        </td>
                    </tr>
                    <!-- End: Critical Notification -->
                    <!-- End: White block with text content -->

                    <!-- Start: Footer block in pale grey email background -->
                    {{-- <tr>
                        <td class="footer">
                            <table style="border: none" id="attribution">
                                <tr>
                                    <td><a href="https://silverback.systems/" target="_blank"><img src="data&colon;image/png;base64,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" alt="Silverback Systems Services Ltd" /></a>
                                    <td>Template Provided Courtesy of <a href="https://silverback.systems/" target="_blank">Silverback Systems Services Ltd</a></td>
                                </tr>
                            </table>
                            <p> <a href="https://www.solarwinds.com/">Any Links</a> | <a href="https://www.solarwinds.com/">Another Link</a> </p>
                        </td>
                    </tr> --}}
                    <!-- End: Footer block in pale grey email background -->
                </table>
            </td>
        </tr>
    </table>
</body>

</html>