<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Reset Your Password</title>
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
                                    <div style="font-size: 24px; font-weight: 600; color: #111827;">{{ config('app.name') }}</div>
                                </div>
                            </td>
                        </tr>

                        <!-- Main Content -->
                        <tr>
                            <td style="padding: 20px 30px 30px; text-align: center;">
                                <h1 style="font-size: 24px; font-weight: 600; color: #111827; margin: 0 0 16px;">
                                    Reset Your Password
                                </h1>

                                <p style="font-size: 16px; color: #6b7280; margin: 0 0 20px;">
                                    We received a request to reset your password for your {{ config('app.name') }} account.
                                </p>

                                <p style="font-size: 16px; color: #6b7280; margin: 0 0 32px;">
                                    Please click the button below to reset your password.
                                </p>

                                <table cellpadding="0" cellspacing="0" border="0" align="center"
                                    style="margin-bottom: 32px;">
                                    <tr>
                                        <td style="background-color: #2563EB; border-radius: 8px;">
                                            <a href="{{ $actionUrl }}"
                                                style="display: inline-block; padding: 9px 20px; color: #ffffff; text-decoration: none; font-weight: 500; font-size: 16px; border-radius: 8px;">
                                                Reset Password
                                            </a>
                                        </td>
                                    </tr>
                                </table>

                                <!-- Security Notice -->
                                <div style="background-color: #fef3c7; border-left: 4px solid #f59e0b; padding: 16px; margin: 20px 0; text-align: left; border-radius: 6px;">
                                    <p style="font-size: 14px; color: #92400e; margin: 0; font-weight: 500;">
                                        <strong>Security Notice:</strong>
                                    </p>
                                    <p style="font-size: 14px; color: #92400e; margin: 8px 0 0 0;">
                                        This password reset link will expire in {{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire', 60) }} minutes. If you didn't request this password reset, please ignore this email.
                                    </p>
                                </div>

                                <p style="font-size: 14px; color: #9ca3af; margin: 0 0 20px;">
                                    If you did not request a password reset, no further action is required.
                                </p>

                                <div style="font-size: 14px; color: #6b7280; margin-bottom: 20px;">
                                    Regards,<br>
                                    {{ config('app.name') }} Team
                                </div>

                                <div
                                    style="font-size: 12px; color: #6b7280; padding: 12px; background-color: #f9fafb; border-radius: 6px; word-break: break-word;">
                                    If you're having trouble clicking the "Reset Password" button, copy and paste the
                                    URL below into your web browser:
                                    <br>
                                    <a href="{{ $actionUrl }}" style="color: #3b82f6; text-decoration: none;">{{
                                        $actionUrl }}</a>
                                </div>
                            </td>
                        </tr>

                        <!-- Footer -->
                        <tr>
                            <td
                                style="padding: 20px 30px; text-align: center; font-size: 12px; color: #9ca3af; background-color: #f9fafb; border-top: 1px solid #e5e7eb;">
                                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>