<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP for Document Download</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            padding-bottom: 10px;
        }
        .email-header h2 {
            margin: 0;
            color:rgb(4, 4, 4);
        }
        .email-content {
            font-size: 16px;
            line-height: 1.5;
            margin-top: 20px;
        }

        .otp-box {
            font-size: 18px;
            color: #fff;
            background-color: rgb(10, 10, 10);
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin: 20px 0;
            display: inline-block;       /* Shrink box to content width */
            width: auto;                 /* Allow content to define width */
            max-width: 100%;             /* Prevent overflow if content is long */
        }

        .email-footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">

        <div class="d-flex justify-content-center my-3">
            <img width="220px" height="100px" src="{{ asset('frontend/assets/images/home/logo.webp') }}" alt="SRDC Logo" title="SRDC Logo">
        </div><br><br>

        <div class="email-header">
            <h2>Your OTP for Brochure Download</h2>
        </div>
        <div class="email-content">
            <p>Hello Customer,</p>
            <p>We received a request to download the brochure. Use the One-Time Password (OTP) below to complete the process:</p>
            <div style="text-align: center;">
                <div class="otp-box">
                    Your OTP is <strong>{{ $otp }}</strong>
                </div>
            </div>

            <p>This OTP is valid for 5 minutes. If you did not request this, please ignore this email.</p>
        </div>
        <hr><br>
        <div class="email-footer">
            <p style="font-size:16px; color:#555; line-height:18px; margin:0;">
                &copy; 2025 SARA Research & Development Centre (SRDC). All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
