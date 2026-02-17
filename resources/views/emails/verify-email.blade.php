<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Verify Your Email Address</title>
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
                                    <img src="{{ asset('images/logo.png') }}" alt="Logo"
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
                                {{ __('notifications.verify_email_title') }}
                            </h1>

                            <p style="font-size: 16px; color: #6b7280; margin: 0 0 32px;">
                                {{ __('notifications.verify_email_click') }}
                            </p>

                            <table cellpadding="0" cellspacing="0" border="0" align="center"
                                style="margin-bottom: 32px;">
                                <tr>
                                    <td style="background-color: #2563EB; border-radius: 8px;">
                                        <a href="{{ $verificationUrl }}"
                                            style="display: inline-block; padding: 9px 20px; color: #ffffff; text-decoration: none; font-weight: 500; font-size: 16px; border-radius: 8px;">
                                            {{ __('notifications.verify_email_button') }}
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size: 14px; color: #9ca3af; margin: 0 0 20px;">
                                {{ __('notifications.no_account_action') }}
                            </p>

                            <div style="font-size: 14px; color: #6b7280; margin-bottom: 20px;">
                                {{ __('notifications.regards') }}<br>
                                {{ config('app.name') }} {{ __('notifications.team') }}
                            </div>

                            <div
                                style="font-size: 12px; color: #6b7280; padding: 12px; background-color: #f9fafb; border-radius: 6px; word-break: break-word;">
                                {{ __('notifications.trouble_clicking_verify') }}
                                <br>
                                <a href="{{ $verificationUrl }}" style="color: #3b82f6; text-decoration: none;">{{
                                    $verificationUrl }}</a>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="padding: 20px 30px; text-align: center; font-size: 12px; color: #9ca3af; background-color: #f9fafb; border-top: 1px solid #e5e7eb;">
                            © {{ date('Y') }} {{ config('app.name') }}. {{ __('notifications.all_rights_reserved') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>