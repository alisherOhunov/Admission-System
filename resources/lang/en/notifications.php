<?php

return [

    // Email Subjects
    'reset_password_subject'   => 'Reset Your Password - ',
    'verify_email_subject'     => 'Verify Your Email Address - ',
    'status_update_subject'    => 'Application Status Update - ',

    // Application Status: under_review
    'under_review_title'   => 'Application Under Review',
    'under_review_message' => 'Your application is currently being reviewed by our admissions team. We will notify you once a decision has been made.',

    // Application Status: accepted
    'accepted_title'   => 'Congratulations! Application Accepted',
    'accepted_message' => 'We are pleased to inform you that your application has been accepted. Welcome to our program!',

    // Application Status: rejected
    'rejected_title'   => 'Application Decision',
    'rejected_message' => 'After careful consideration, we regret to inform you that your application was not accepted at this time.',

    // Application Status: require_resubmit
    'require_resubmit_title'   => 'Application Requires Resubmission',
    'require_resubmit_message' => 'Your application requires some additional information or corrections. Please review the comments below and resubmit your application.',

    // Common email parts
    'hello'              => 'Hello',
    'regards'            => 'Regards,',
    'best_regards'       => 'Best regards,',
    'admissions_team'    => 'Admissions Team',
    'team'               => 'Team',
    'all_rights_reserved' => 'All rights reserved.',
    'admin_comments'     => 'Admin Comments:',
    'view_application'   => 'View Application',
    'contact_admissions' => 'If you have any questions, please contact our admissions team.',

    // Password reset email body
    'reset_password_title'   => 'Reset Your Password',
    'reset_password_request' => 'We received a request to reset your password for your :app account.',
    'reset_password_click'   => 'Please click the button below to reset your password.',
    'reset_password_button'  => 'Reset Password',
    'security_notice'        => 'Security Notice:',
    'security_notice_msg'    => "This password reset link will expire in :minutes minutes. If you didn't request this password reset, please ignore this email.",
    'no_action_required_reset' => 'If you did not request a password reset, no further action is required.',
    'trouble_clicking_reset' => 'If you\'re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:',

    // Verify email body
    'verify_email_title'   => 'Hello!',
    'verify_email_click'   => 'Please click the button below to verify your email address.',
    'verify_email_button'  => 'Verify Email Address',
    'no_account_action'    => 'If you did not create an account, no further action is required.',
    'trouble_clicking_verify' => 'If you\'re having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:',

];
