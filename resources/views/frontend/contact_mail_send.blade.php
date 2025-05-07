<div style="font-family: Arial, sans-serif; color: #333; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9;">
    <div style="text-align: center; margin-bottom: 30px;">
        <img src="{{ asset('frontend/assets/images/home/logo.webp') }}" alt="SRDC Logo" title="SRDC Logo" style="width: 220px; height: auto;">
    </div>

    <h2 style="text-align: center; color: #2c3e50;">New Contact Form Enquiry</h2>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <tr>
            <td style="padding: 8px 0;"><strong>Name:</strong></td>
            <td>{{ $first_name }} {{ $last_name }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 0;"><strong>Email:</strong></td>
            <td>{{ $email }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 0;"><strong>Phone:</strong></td>
            <td>{{ $phone }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 0;"><strong>Company:</strong></td>
            <td>{{ $company }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 0;"><strong>Designation:</strong></td>
            <td>{{ $designation }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 0;"><strong>Website:</strong></td>
            <td><a href="{{ $website }}" target="_blank" style="color: #007bff;">{{ $website }}</a></td>
        </tr>
        <tr>
            <td style="padding: 8px 0;"><strong>Address:</strong></td>
            <td>{{ $address }}</td>
        </tr>

        <tr>
            <td style="padding: 8px 0;"><strong>City:</strong></td>
            <td>{{ $city }}</td>
        </tr>

        <tr>
            <td style="padding: 8px 0;"><strong>State:</strong></td>
            <td>{{ $state }}</td>
        </tr>

        <tr>
            <td style="padding: 8px 0;"><strong>Postal:</strong></td>
            <td>{{ $postal }}</td>
        </tr>

        <tr>
            <td style="padding: 8px 0;"><strong>Country:</strong></td>
            <td>{{ $country }}</td>
        </tr>

        <tr>
            <td style="padding: 8px 0;"><strong>Interest:</strong></td>
            <td>{{ $interest }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 0; vertical-align: top;"><strong>Message:</strong></td>
            <td style="white-space: pre-wrap;"> {{ e($user_message) }}</td>
        </tr>
    </table>
    <hr>

    <div style="margin-top: 30px; text-align: center; color: #555;">
        <p style="font-size:16px; color:#555; line-height:18px; margin:0;">
            &copy; 2025 SARA Research & Development Centre (SRDC). All rights reserved.
        </p>
    </div>
</div>
