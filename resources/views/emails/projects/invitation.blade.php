<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Project Bidding Invitation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body
    style="margin: 0; padding: 40px 16px; font-family: sans-serif; background: linear-gradient(to bottom right, #dbeafe, #ffffff, #eff6ff);">
    <div
        style="max-width: 90%; margin: 0 auto; background-color: #ffffff; box-shadow: 0 4px 20px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden; padding: 32px;">

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

        <!-- Title -->
        <h2 style="font-size: 22px; font-weight: bold; color: #1f2937; text-align: center; margin-bottom: 24px;">
            You're Invited to Bid on a Project
        </h2>

        <!-- Message -->
        <p
            style="font-size: 14px; color: #374151; line-height: 1.6; margin-bottom: 24px;  border-top: 1px solid #e5e7eb;  padding-top: 16px">
            Dear <strong>{{ $name }}</strong>,
            <br><br>
            You are invited to submit a proposal for the following project opportunity under
            <strong>{{ $partner }}</strong>. We value your expertise and believe your team is well-suited to
            deliver exceptional results for this initiative.
            <br><br>
            The project involves key deliverables outlined in the following section. You are encouraged to review the
            scope and requirements carefully and submit your most competitive and comprehensive bid.
            <br><br>
            Access to additional documents and submission guidelines will be provided through the portal. Should you
            have any questions or require clarifications, please do not hesitate to contact our team.
            <br><br>
            Below are the key project details:
        </p>

        <!-- Project Summary -->
        <div
            style="background-color: #f3f4f6; padding: 16px; border-radius: 6px; font-size: 14px; margin-bottom: 24px;">
            <p><strong>Project Name:</strong> {{ $proj_name }}</p>
            <p><strong>Due Date:</strong> {{ $proj_due_date }}</p>
            @if ($proj_walkthrough_date)
                <p><strong>Walkthrough Date:</strong> {{ $proj_walkthrough_date }}</p>
            @endif
            <p><strong>Address:</strong><br>
                {{ $proj_address }}<br>
                {{ $proj_city }}, {{ $proj_state }} {{ $proj_zip }}
            </p>
        </div>

        <!-- Project Stages (Optional) -->
        {{-- @if (!empty($stage_subject))
            <div style="margin-bottom: 24px;">
                <p style="font-size: 14px; font-weight: bold; color: #111827;">Project Stages</p>
                <ul style="font-size: 14px; color: #374151; padding-left: 20px;">
                    @foreach ($stage_subject as $index => $subject)
                        @php
                            $rawDescription = $stage_descriptions[$index] ?? 'No description provided.';
                            $plainText = strip_tags($rawDescription);
                            $charLimit = 500;
                        @endphp

                        <li>
                            <strong>{{ $subject }}:</strong><br>

                            @if (strlen($plainText) > $charLimit)
                                @php
                                    $trimmed = substr($plainText, 0, $charLimit);
                                    // Avoid cutting mid-word
                                    $trimmed = substr($trimmed, 0, strrpos($trimmed, ' '));
                                @endphp

                                <p style="margin: 0;">
                                    {{ $trimmed }}... <em style="color: #2563eb;">[Read more in portal]</em>
                                </p>
                            @else
                                {!! $rawDescription !!}
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <!-- CTA Button -->
        <div style="text-align: center; margin-bottom: 24px;">
            <a href="{{ $projectLink }}"
                style="display: block; padding: 12px 24px; background-color: #2563eb; color: #ffffff; font-weight: 600; text-decoration: none; border-radius: 6px;">
                View Project & Submit Bid
            </a>
        </div>

        <!-- Footer Message -->
        <p style="font-size: 14px; color: #6b7280; margin-bottom: 16px;">
            Please ensure to submit your bid before the deadline. For any concerns or document requests, feel free to
            contact us.
        </p>

        <!-- Footer -->
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
