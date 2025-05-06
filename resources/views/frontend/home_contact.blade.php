<!doctype html>
<html lang="en-US">

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    {{-- SEO --}}
    <meta name="description" content="SRDC - Sara Research & Development Center">
    <meta name="keywords" content="SRDC, Sara Research, Matrix Bricks">
    <meta name="author" content="SRDC">
    <meta name="robots" content="index, follow">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Responsive Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SRDC | New Contact Enquiry Details</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif !important;
        }

        a:hover {
            text-decoration: underline !important;
        }
    </style>
</head>

<body style="margin: 0px; background-color: #f2f3f8;">
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="font-family: 'Inter', sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px; margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr><td style="height:80px;">&nbsp;</td></tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width:670px;background:#fff; border-radius:3px; text-align:center; box-shadow:0 6px 18px rgba(0,0,0,.06);">
                                <tr><td style="height:40px;">&nbsp;</td></tr>

                                <tr>
                                    <td style="text-align:center; padding:0 35px;">
                                        <img width="220px" height="100px" src="{{ asset('frontend/assets/images/home/logo.webp') }}" alt="SRDC Logo" title="SRDC Logo">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:30px 35px;">
                                        {{-- <h2 style="color:#1e1e2d; font-weight:600; margin-bottom:20px; font-size:24px; text-decoration: underline;">
                                            Contact Enquiry Details
                                        </h2> --}}
                                        <p style="font-size:16px; line-height:24px; text-align:left;">
                                            <strong>First Name:</strong> {{ $f_name }}
                                        </p>
                                        <p style="font-size:16px; line-height:24px; text-align:left;">
                                            <strong>Last Name:</strong> {{ $l_name }}
                                        </p>
                                        <p style="font-size:16px; line-height:24px; text-align:left;">
                                            <strong>Email:</strong> {{ $email }}
                                        </p>
                                        <p style="font-size:16px; line-height:24px; text-align:left;">
                                            <strong>Phone:</strong> {{ $phone }}
                                        </p>
                                        <p style="font-size:16px; line-height:24px; text-align:left;">
                                            <strong>Service:</strong> {{ $service }}
                                        </p>
                                        <p style="font-size:16px; line-height:24px; text-align:left;">
                                            <strong>Country:</strong> {{ $country }}
                                        </p>
                                        <p style="font-size:16px; line-height:24px; text-align:left;">
                                            <strong>Message:</strong>{{ e($user_message) }}
                                        </p>
                                    </td>
                                </tr>

                                <tr><td style="height:40px;">&nbsp;</td></tr>
                            </table>
                        </td>
                    </tr>
                    <tr><td style="height:20px;">&nbsp;</td></tr>
                    <tr>
                        <td style="text-align:center;">
                            <p style="font-size:16px; color:#555; line-height:18px; margin:0;">
                                &copy; 2025 SARA Research & Development Centre (SRDC). All rights reserved.
                            </p>
                        </td>
                    </tr>
                    <tr><td style="height:80px;">&nbsp;</td></tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
