<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Application Status Update</title>
</head>

<body style="background-color: #f3f4f6; margin: 0; padding: 40px 20px; font-family: Arial, sans-serif; color: #374151;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f3f4f6;">
        <tr>
            <td align="center">
                <table width="480" cellpadding="0" cellspacing="0" border="0"
                    style="max-width: 480px; background-color: white; border-radius: 12px; overflow: hidden;">

                    <!-- Header -->
                    <tr>
                        <td style="text-align: center; padding: 30px 30px 0;">
                            <div style="margin-bottom: 20px;">
                                <div style="display: inline-block;">
                                    <img src="https://admission.myprojects.uz/favicon.ico" alt="Logo"
                                        width="48" height="48" style="display: block;">
                                </div>
                                <div style="font-size: 24px; font-weight: 600; color: #111827;">EduAdmit</div>
                            </div>
                        </td>
                    </tr>

                    <!-- Main Content -->
                    <tr>
                        <td style="padding: 20px 30px 30px; text-align: center;">
                            <h1 style="font-size: 24px; font-weight: 600; color: #111827; margin: 0 0 16px;">
                                Hello {{ $user->first_name .' '. $user->last_name }}!
                            </h1>

                            <!-- Status Badge -->
                            <div style="margin-bottom: 24px;">
                                <span style="display: inline-block; padding: 8px 16px; background-color: {{ $statusColor }}; color: white; border-radius: 20px; font-size: 14px; font-weight: 500;">
                                    {{ $statusTitle }}
                                </span>
                            </div>

                            <p style="font-size: 16px; color: #6b7280; margin: 0 0 32px; line-height: 1.5;">
                                {{ $statusMessage }}
                            </p>

                            <!-- Admin Comment (shown only for resubmission) -->
                            @if($showComment && $adminComment)
                            <div style="background-color: #fef3c7; border-left: 4px solid #f59e0b; padding: 16px; margin: 24px 0; text-align: left; border-radius: 4px;">
                                <h3 style="font-size: 16px; font-weight: 600; color: #92400e; margin: 0 0 8px;">
                                    Admin Comments:
                                </h3>
                                <p style="font-size: 14px; color: #92400e; margin: 0; line-height: 1.4;">
                                    {{ $adminComment }}
                                </p>
                            </div>
                            @endif

                            <!-- Action Button -->
                            <table cellpadding="0" cellspacing="0" border="0" align="center" style="margin-bottom: 32px;">
                                <tr>
                                    <td style="background-color: #2563EB; border-radius: 8px;">
                                        <a href="{{ url('/applicant/dashboard') }}"
                                            style="display: inline-block; padding: 12px 24px; color: #ffffff; text-decoration: none; font-weight: 500; font-size: 16px; border-radius: 8px;">
                                            View Application
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size: 14px; color: #9ca3af; margin: 0 0 20px;">
                                If you have any questions, please contact our admissions team.
                            </p>

                            <div style="font-size: 14px; color: #6b7280; margin-bottom: 20px;">
                                Best regards,<br>
                                EduAdmit Admissions Team
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="padding: 20px 30px; text-align: center; font-size: 12px; color: #9ca3af; background-color: #f9fafb; border-top: 1px solid #e5e7eb;">
                            © {{ date('Y') }} EduAdmit. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>