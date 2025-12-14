<?php

return [
    // ==========================================
    // ACCOUNT SETTINGS
    // ==========================================
    'title' => 'Account Settings',
    'description' => 'Manage your profile, security, and preferences.',
    
    'tabs' => [
        'profile' => 'Profile',
        'security' => 'Security',
        'two_factor' => 'Two-Factor Auth',
        'notifications' => 'Notifications',
        'sessions' => 'Sessions',
    ],
    
    // ==========================================
    // PROFILE
    // ==========================================
    'profile' => [
        'title' => 'Profile Information',
        'description' => 'Update your account\'s profile information.',
        'name' => 'Name',
        'email' => 'Email',
        'email_hint' => 'Email can be changed in the Security tab.',
        'save' => 'Save',
        'saving' => 'Saving...',
        'updated' => 'Profile updated successfully.',
    ],
    
    // ==========================================
    // SECURITY
    // ==========================================
    'security' => [
        'email_title' => 'Email Address',
        'email_current' => 'Your current email address is',
        'email_pending' => 'Pending email change to',
        'email_check_inbox' => 'Check your new email for verification link.',
        'email_change' => 'Change Email',
        
        'password_title' => 'Update Password',
        'password_description' => 'Ensure your account is using a long, random password to stay secure.',
        'password_current' => 'Current Password',
        'password_new' => 'New Password',
        'password_confirm' => 'Confirm Password',
        'password_update' => 'Update Password',
        'password_changed' => 'Password changed successfully.',
        'password_incorrect' => 'The provided password is incorrect.',
    ],
    
    // ==========================================
    // TWO FACTOR AUTH
    // ==========================================
    'two_factor' => [
        'title' => 'Two-Factor Authentication',
        'description' => 'Add additional security to your account using two-factor authentication.',
        
        'enabled' => 'Two-factor authentication is enabled.',
        'not_enabled' => 'Two-factor authentication is not enabled.',
        'recovery_remaining' => 'You have :count recovery codes remaining.',
        'enable_hint' => 'Enable 2FA to add an extra layer of security.',
        
        'enable' => 'Enable Two-Factor Authentication',
        'disable' => 'Disable 2FA',
        'view_codes' => 'View Recovery Codes',
        'regenerate_codes' => 'Regenerate Codes',
        'codes_regenerated' => 'Recovery codes regenerated successfully.',
        'disabled' => 'Two-factor authentication has been disabled.',
        
        'how_it_works' => 'How does 2FA work?',
        'explanation' => 'When enabled, you\'ll be prompted to enter a code from your authenticator app (like Google Authenticator) each time you log in. This ensures that even if someone has your password, they cannot access your account without your phone.',
        
        'recovery_codes_title' => 'Recovery Codes',
        'recovery_codes_info' => 'Store these recovery codes in a secure place. They can be used to access your account if you lose your authenticator device.',
        'code_invalid' => 'The provided code is invalid.',
        
        'setup_title' => 'Set Up Two-Factor Authentication',
        'scan_qr' => 'Scan the QR code below with your authenticator app, then enter the verification code.',
        'enter_code' => 'Enter 6-digit code',
        'verifying' => 'Verifying...',
        'verify_enable' => 'Verify & Enable',
        
        'confirm_disable_title' => 'Disable Two-Factor Authentication',
        'confirm_disable_description' => 'Enter your password to disable two-factor authentication.',
        'disabling' => 'Disabling...',
    ],
    
    // ==========================================
    // SESSIONS
    // ==========================================
    'sessions' => [
        'title' => 'Browser Sessions',
        'description' => 'Manage and log out your active sessions on other browsers and devices.',
        
        'this_device' => 'This device',
        'logout' => 'Log out',
        'logout_all' => 'Log Out All Other Sessions',
        'logout_confirm' => 'Are you sure you want to log out this session?',
        'logout_all_confirm' => 'Are you sure you want to log out all other sessions?',
        
        'no_sessions' => 'No active sessions found.',
        'logged_out' => 'Session logged out successfully.',
        'all_logged_out' => ':count session(s) logged out successfully.',
        'cannot_logout_current' => 'You cannot logout your current session.',
    ],
    
    // ==========================================
    // MODALS
    // ==========================================
    'change_email' => [
        'title' => 'Change Email Address',
        'description' => 'Enter your current password and new email address.',
        'new_email' => 'New Email Address',
        'password' => 'Current Password',
        'cancel' => 'Cancel',
        'change' => 'Change Email',
        'changing' => 'Changing...',
    ],
    
    // ==========================================
    // ACTIVITY LOGS
    // ==========================================
    'activity' => [
        'title' => 'Activity Logs',
        'description' => 'View your recent account activity.',
        'search' => 'Search activity...',
        'no_logs' => 'No activity logs found.',
    ],
    
    // ==========================================
    // MODALS
    // ==========================================
    'modals' => [
        // Change Email Modal
        'change_email' => [
            'title' => 'Change Email Address',
            'verification_sent_title' => 'Verification Email Sent',
            'sent_to' => 'We have sent a verification link to',
            'link_expires' => 'Click the link in the email to confirm your new email address. The link will expire in 24 hours.',
            'new_email' => 'New Email Address',
            'confirm_password' => 'Confirm your password',
            'otp_label' => 'Verification Code',
            'otp_hint' => 'Enter new email and password, then click Send OTP. Code will be sent to your current email.',
            'otp_sent_to_old' => 'OTP sent to your current email address.',
            'otp_invalid' => 'Invalid OTP code. Please try again.',
            'otp_expired' => 'OTP code has expired. Please request a new one.',
            'email_mismatch' => 'Email address does not match the OTP request.',
            'send_otp' => 'Send OTP',
            'got_it' => 'Got it',
            'cancel' => 'Cancel',
            'send_verification' => 'Send Verification',
            'sending' => 'Sending...',
        ],
        
        // Enable 2FA Modal
        'enable_2fa' => [
            'title' => 'Enable Two-Factor Authentication',
            'save_codes_title' => 'Save your recovery codes',
            'enabled_message' => 'Two-factor authentication has been enabled. Save these recovery codes in a secure location.',
            'code_warning' => 'Each code can only be used once. If you lose these codes and your authenticator app, you will lose access to your account.',
            'scan_qr' => 'Scan this QR code with your authenticator app (Google Authenticator, Authy, etc.)',
            'enter_manually' => 'Or enter this code manually:',
            'verification_code' => 'Verification Code',
            'saved_codes' => 'I have saved my recovery codes',
            'cancel' => 'Cancel',
            'verify_enable' => 'Verify & Enable',
            'verifying' => 'Verifying...',
        ],
        
        // Disable 2FA Modal
        'disable_2fa' => [
            'title' => 'Disable Two-Factor Authentication',
            'warning' => 'Warning',
            'warning_message' => 'Disabling two-factor authentication will reduce the security of your account. Anyone with your password will be able to access your account.',
            'confirm_password' => 'Confirm your password',
            'cancel' => 'Cancel',
            'disable' => 'Disable 2FA',
        ],
        
        // Recovery Codes Modal
        'recovery_codes' => [
            'title' => 'Recovery Codes',
            'info' => 'Store these recovery codes in a secure location. They can be used to access your account if you lose your authenticator device.',
            'no_codes' => 'No recovery codes available.',
            'remaining' => 'Each code can only be used once. You have :count codes remaining.',
            'copied' => 'Codes copied to clipboard',
            'copy' => 'Copy',
            'done' => 'Done',
        ],
        
        // Push Subscriptions Modal
        'push_subscriptions' => [
            'title' => 'Push Notifications',
            'subtitle' => 'Manage browser subscriptions',
            'this_browser' => 'This Browser',
            'checking' => 'Checking...',
            'not_supported' => 'Not supported',
            'already_registered' => 'Already registered',
            'not_registered' => 'Not registered yet',
            'enabling' => 'Enabling...',
            'permission_denied' => 'Permission denied',
            'not_configured' => 'Not configured',
            'failed' => 'Failed to enable',
            'enable' => 'Enable',
            'active' => 'Active',
            'registered_devices' => 'Registered Devices (:count)',
            'added' => 'Added :date',
            'confirm_remove' => 'Are you sure you want to remove this subscription?',
            'empty_title' => 'No devices registered yet',
            'empty_description' => 'Enable push notifications to get started',
            'close' => 'Close',
        ],
    ],
    
    // ==========================================
    // NOTIFICATIONS DROPDOWN
    // ==========================================
    'notifications_dropdown' => [
        'title' => 'Notifications',
        'unread_count' => ':count unread',
        'mark_all_read' => 'Mark all read',
        'view_details' => 'View Details',
        'mark_as_read' => 'Mark as read',
        'empty_title' => 'No notifications yet',
        'empty_description' => "When you receive notifications, they'll appear here.",
        'view_all' => 'View All Notifications',
    ],
];
