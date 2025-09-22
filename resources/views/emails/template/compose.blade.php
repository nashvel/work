<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            color: #333;
        }

        .signature-table {
            width: 100%;
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 15px;
        }

        .signature-table td {
            vertical-align: top;
            padding: 10px;
        }

        .signature-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
        }

        .signature-info {
            padding-left: 15px;
        }
    </style>
</head>

<body>
    {{-- Email Body --}}
    <div style="font-family: Arial, sans-serif; color: #333; font-size: 15px; line-height: 1.6;">

        {{-- Actual Email Body --}}
        <div style="padding: 20px; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 6px;">
            {!! $body !!}
        </div>
    </div>


    {{-- Signature --}}
    <table width="100%" cellpadding="0" cellspacing="0"
        style="border-top: 1px solid #e0e0e0; padding-top: 20px; margin-top: 20px;">
        <tr>
            <td width="80" align="left" style="padding-top: 20px;">
                <img src="https://portal.hillbcs.com/assets/logo.png" alt="Signature" width="64" height="64"
                    style="border-radius: 50%; object-fit: cover;">
            </td>
            <td align="left"
                style="padding-left: 15px; padding-top: 20px; font-family: Arial, sans-serif; font-size: 14px; color: #333;">
                <strong>Douglas Hill (<i>Owner</i>)</strong><br>
                11350 Monier Park Pl., Rancho Cordova, California 95742<br>
                <a href="mailto:integrity.outsourcing.services@gmail.com"
                    style="color: #2563eb; text-decoration: none;">integrity.outsourcing.services@gmail.com</a>
            </td>
        </tr>
    </table>


</body>

</html>
