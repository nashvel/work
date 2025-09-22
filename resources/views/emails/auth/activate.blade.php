<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Your Account Credentials</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body
    style="margin: 0; padding: 40px 16px; font-family: sans-serif; background: linear-gradient(to bottom right, #dbeafe, #ffffff, #eff6ff);">
    <div
        style="max-width: 600px; margin: 0 auto; background-color: #ffffff; box-shadow: 0 4px 20px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden; padding: 32px;">

        <!-- Logo -->
        <div style="text-align: center; margin-bottom: 24px;">
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0"
                style="margin: 0 auto;">
                <tr>
                    <td style="padding-right: 10px;">
                        <img src="https://hillbcs.com/wp-content/uploads/2024/11/logo-1.png"
                            alt="Hill Business Consulting Services" style="height: 66px; display: block;" />
                    </td>
                    @if ($partner == 'Plan Panther')
                        <td>
                            <img src="https://hillbcs.com/wp-content/uploads/2025/07/sSd5zL6Y8HTMn7xeyys1P8hdgia0dz7jyC7qsWcV.png"
                                alt="{{ $partner }}" style="height: 56px; display: block;" />
                        </td>
                    @endif
                </tr>
            </table>
        </div>


        <!-- Header -->
        <h2 style="font-size: 24px; font-weight: bold; color: #1f2937; text-align: center; margin-bottom: 16px;">
            Your Account is Now Actived
        </h2>
        <!-- Body Message -->
        <p
            style="font-size: 14px; color: #374151; line-height: 1.6; margin-bottom: 24px; border-top: 1px solid #e5e7eb;  padding-top: 16px">
            Dear <strong>{{ $name }}</strong>,
            <br><br>
            We’re pleased to inform you that your account has been successfully created and activated. You may now
            access the portal using the credentials provided below.
            <br><br>
            Through your dashboard, you will be able to manage your profile, explore available tools, and receive
            invitations to participate in project bidding opportunities.
            <br><br>
            For your security, we recommend changing your password after your first login.
        </p>


        <!-- Credentials -->
        <div
            style="background-color: #f9fafb; border: 1px solid #e5e7eb; padding: 16px; border-radius: 6px; font-size: 14px; margin-bottom: 24px;">
            <p><strong>Email Address:</strong> <span style="color: #1f2937;">{{ $email }}</span></p>
            <p><strong>Temporary Password:</strong> <span style="color: #1f2937;">{{ $password }}</span></p>
        </div>

        <!-- CTA Button -->
        <div style="text-align: center; margin-bottom: 24px;">
            <a href="{{ $loginUrl }}"
                style="display: inline-block; padding: 12px 24px; background: linear-gradient(to right, #2563eb, #4f46e5); color: #ffffff; font-weight: 600; text-decoration: none; border-radius: 6px;">
                Login to Your Account
            </a>
        </div>

        <!-- Support Info -->
        <p style="font-size: 14px; color: #6b7280; margin-bottom: 16px;">
            If you have any questions or need assistance, feel free to reach out to our support team anytime.
        </p>


        <p
            style="font-size: 12px; color: #9ca3af; text-align: center; border-top: 1px solid #e5e7eb; padding-top: 16px;">
            This is an automated message. This message was sent by Hill Business Consulting Services. If you believe you
            received this in error, contactus at
            <a href="mailto:support@hillbcs.com"
                style="color: #2563eb; text-decoration: underline;">support@hillbcs.com</a> |
            <a href="mailto:juan@planpanther.pro"
                style="color: #2563eb; text-decoration: underline;">juan@planpanther.pro</a>.
        </p>

    </div>
</body>

</html>
