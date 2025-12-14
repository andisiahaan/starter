<?php

return [
    // ==========================================
    // NAVIGATION
    // ==========================================
    'nav' => [
        'general' => 'General',
        'auth' => 'Authentication',
        'captcha' => 'Captcha',
        'socials' => 'Social Login',
        'custom_tags' => 'Custom Tags',
        'notifications' => 'Notifications',
        'referral' => 'Referral',
        'business' => 'Business',
        'cookie_consent' => 'Cookie Consent',
    ],

    // ==========================================
    // GENERAL SETTINGS
    // ==========================================
    'general' => [
        'title' => 'General Settings',
        'description' => "Configure your application's basic information.",
        'app_name' => 'Application Name',
        'app_description' => 'Description',
        'logo' => 'Logo',
        'upload_logo' => 'Upload Logo',
        'favicon' => 'Favicon',
        'upload_favicon' => 'Upload Favicon',
        'language' => 'Language',
        'default_theme' => 'Default Theme',
        'timezone' => 'Timezone',
        'currency' => 'Currency',
        'languages' => [
            'en' => 'English',
            'id' => 'Indonesian',
        ],
        'themes' => [
            'light' => 'Light',
            'dark' => 'Dark',
        ],
    ],

    // ==========================================
    // AUTHENTICATION SETTINGS
    // ==========================================
    'auth' => [
        'title' => 'Authentication Settings',
        'description' => 'Configure login, registration, and security options.',
        
        'registration' => [
            'title' => 'Registration',
            'enabled' => 'Enable Registration',
            'enabled_description' => 'Allow new users to register',
        ],
        
        'email_verification' => [
            'title' => 'Email Verification',
            'enabled' => 'Require Email Verification',
            'enabled_description' => 'Users must verify their email before accessing the app',
        ],
        
        'login_options' => [
            'title' => 'Login Options',
            'email_enabled' => 'Allow Login with Email',
            'username_enabled' => 'Allow Login with Username',
        ],
        
        'default_role' => [
            'title' => 'Default Role',
            'select' => 'Select Role',
        ],
        
        'password' => [
            'title' => 'Password Requirements',
            'min_length' => 'Minimum Password Length',
        ],
        
        'toggles' => [
            'is_login_enabled' => 'Login Enabled',
            'is_registration_enabled' => 'Registration Enabled',
            'is_login_with_google_enabled' => 'Login with Google',
            'is_registration_with_google_enabled' => 'Register with Google',
            'is_email_verification_required' => 'Email Verification Required',
            'is_phone_required' => 'Phone Required',
            'is_login_with_username_enabled' => 'Login with Username',
            'is_login_with_email_enabled' => 'Login with Email',
            'is_remember_me_enabled' => 'Remember Me Option',
            'is_account_deletion_enabled' => 'Account Deletion',
            'is_strong_password_required' => 'Strong Password Required',
        ],
        
        'fields' => [
            'max_login_attempts' => 'Max Login Attempts',
            'min_password_length' => 'Min Password Length',
            'lockout_duration' => 'Lockout Duration (minutes)',
        ],
    ],

    // ==========================================
    // CAPTCHA SETTINGS
    // ==========================================
    'captcha' => [
        'title' => 'Captcha Settings',
        'description' => 'Configure captcha protection for authentication forms.',
        'provider_description' => 'Select captcha provider or disable captcha protection.',
        
        'provider' => 'Captcha Provider',
        'providers' => [
            'none' => 'Disabled',
            'recaptcha_v2' => 'Google reCAPTCHA v2',
        ],
        
        'api_keys' => 'API Keys',
        'site_key' => 'Site Key',
        'secret_key' => 'Secret Key',
        'get_keys_help' => 'Get your keys from',
        'recaptcha_admin' => 'Google reCAPTCHA Admin',
        'recaptcha_select_help' => 'Select reCAPTCHA v2 "I\'m not a robot" Checkbox.',
        
        'forms' => [
            'title' => 'Enable Captcha On',
            'login' => 'Login Form',
            'login_description' => 'Protect login page from brute force attacks',
            'registration' => 'Registration Form',
            'registration_description' => 'Prevent spam registrations',
            'forgot_password' => 'Forgot Password Form',
            'forgot_password_description' => 'Protect password reset requests',
        ],
        
        'get_keys' => 'Get your reCAPTCHA keys from',
        'google_console' => 'Google reCAPTCHA Console',
    ],

    // ==========================================
    // SOCIAL LOGIN SETTINGS
    // ==========================================
    'socials' => [
        'title' => 'Social Links',
        'description' => 'Add your social media profile URLs.',
        
        'google' => [
            'title' => 'Google OAuth',
            'enabled' => 'Enable Google Login',
            'client_id' => 'Client ID',
            'client_secret' => 'Client Secret',
        ],
        
        'callback_url' => 'Callback URL',
        'copy_callback' => 'Copy this URL to your OAuth provider settings',
    ],

    // ==========================================
    // CUSTOM TAGS
    // ==========================================
    'custom_tags' => [
        'title' => 'Custom Tags',
        'description' => 'Add custom code to head and body sections.',
        
        'head_tags' => 'Head Tags',
        'head_tags_description' => 'Code to insert before </head>',
        'head_tags_placeholder' => '<!-- Analytics, meta tags, custom CSS -->',
        
        'body_start_tags' => 'Body Start Tags',
        'body_start_tags_description' => 'Code to insert after <body>',
        
        'body_end_tags' => 'Body End Tags',
        'body_end_tags_description' => 'Code to insert before </body>',
        'body_end_tags_placeholder' => '<!-- Chat widgets, tracking scripts -->',
    ],

    // ==========================================
    // NOTIFICATION SETTINGS
    // ==========================================
    'notifications' => [
        'title' => 'Notification Settings',
        'description' => 'Configure default notification channels.',
        
        'channels' => [
            'email' => 'Email',
            'database' => 'In-App',
            'push' => 'Push Notification',
        ],
        
        'categories' => [
            'account' => 'Account Notifications',
            'orders' => 'Order Notifications',
            'marketing' => 'Marketing Notifications',
        ],
    ],

    // ==========================================
    // REFERRAL SETTINGS
    // ==========================================
    'referral' => [
        'title' => 'Referral Settings',
        'description' => 'Configure the referral program settings.',
        
        'enabled' => 'Enable Referral Program',
        'commission_rate' => 'Commission Rate (%)',
        'commission_type' => 'Commission Type',
        'commission_types' => [
            'percentage' => 'Percentage',
            'fixed' => 'Fixed Amount',
        ],
        'minimum_withdrawal' => 'Minimum Withdrawal',
        'max_referrals' => 'Max Referrals per User',
        'cookie_duration' => 'Cookie Duration (days)',
    ],

    // ==========================================
    // BUSINESS SETTINGS
    // ==========================================
    'business' => [
        'title' => 'Business Settings',
        'description' => 'Configure your business information for invoices and legal purposes.',
        
        'sections' => [
            'brand' => 'Brand & Identity',
            'invoice' => 'Invoice Settings',
            'contact' => 'Contact Information',
            'address' => 'Address',
            'tax' => 'Tax & Legal',
            'banking' => 'Banking Information',
            'custom' => 'Custom Fields',
        ],
        
        'fields' => [
            'brand_name' => 'Brand Name',
            'legal_name' => 'Legal Name',
            'tagline' => 'Tagline',
            'invoice_prefix' => 'Invoice Prefix',
            'invoice_starting_number' => 'Starting Number',
            'email' => 'Business Email',
            'phone' => 'Phone Number',
            'whatsapp' => 'WhatsApp',
            'website' => 'Website',
            'address_line_1' => 'Address Line 1',
            'address_line_2' => 'Address Line 2',
            'city' => 'City',
            'state' => 'State/Province',
            'postal_code' => 'Postal Code',
            'country' => 'Country',
            'tax_type' => 'Tax Type',
            'tax_id' => 'Tax ID',
            'tax_rate' => 'Tax Rate (%)',
            'registration_number' => 'Business Registration Number',
            'bank_name' => 'Bank Name',
            'bank_account_name' => 'Account Name',
            'bank_account_number' => 'Account Number',
            'bank_swift_code' => 'SWIFT/BIC Code',
        ],
        
        'custom_fields' => [
            'add' => 'Add',
            'key' => 'Field Name',
            'value' => 'Field Value',
            'description' => 'Add any additional business information that will appear on invoices.',
        ],
    ],

    // ==========================================
    // COOKIE CONSENT
    // ==========================================
    'cookie_consent' => [
        'title' => 'Cookie Consent',
        'description' => 'Configure the cookie consent banner.',
        
        'enabled' => 'Enable Cookie Banner',
        'enabled_description' => 'Show cookie consent banner to visitors',
        
        'display' => [
            'title' => 'Display Settings',
            'position' => 'Position',
            'positions' => [
                'bottom' => 'Bottom',
                'top' => 'Top',
                'bottom-left' => 'Bottom Left',
                'bottom-right' => 'Bottom Right',
            ],
            'theme' => 'Theme',
            'themes' => [
                'light' => 'Light',
                'dark' => 'Dark',
                'auto' => 'Auto (System)',
            ],
        ],
        
        'content' => [
            'title' => 'Content',
            'banner_title' => 'Banner Title',
            'message' => 'Message',
            'privacy_url' => 'Privacy Policy URL',
        ],
        
        'buttons' => [
            'title' => 'Buttons',
            'accept' => 'Accept Button Text',
            'reject' => 'Reject Button Text',
            'settings' => 'Settings Button Text',
            'show_reject' => 'Show Reject Button',
            'show_settings' => 'Show Settings Button',
        ],
        
        'cookie_settings' => [
            'title' => 'Cookie Settings',
            'name' => 'Cookie Name',
            'expiry' => 'Cookie Expiry (days)',
        ],
    ],

    // ==========================================
    // CUSTOM TAGS
    // ==========================================
    'custom_tags' => [
        'title' => 'Custom Tags',
        'description' => 'Inject custom HTML, CSS, or JavaScript into your layouts.',
        'head_tags' => 'Tags',
        'body_tags' => 'Tags',
        'before' => 'Before',
        'security' => [
            'title' => 'Security Notice',
            'description' => 'Only add trusted scripts. Malicious code can compromise your application and user data.',
        ],
    ],

    // ==========================================
    // NOTIFICATIONS
    // ==========================================
    'notifications' => [
        'title' => 'Notification Settings',
        'description' => 'Configure notification channels and types.',
        
        'channels' => [
            'title' => 'Notification Channels',
            'description' => 'Enable or disable notification delivery channels globally.',
        ],
        
        'types' => [
            'title' => 'Notification Types',
            'description' => 'Enable or disable notification types globally. Users can also customize their preferences.',
        ],
        
        'required' => 'Required',
        'security_critical' => 'Security',
        'enable_all' => 'Enable all',
        'disable_all' => 'Disable all',
    ],

    // ==========================================
    // REFERRAL
    // ==========================================
    'referral' => [
        'title' => 'Referral Settings',
        'description' => 'Configure referral program and commission settings.',
        'saved' => 'Referral settings saved successfully.',
        
        'enabled' => [
            'label' => 'Enable Referral Program',
            'description' => 'Allow users to invite friends and earn commissions.',
        ],
        
        'cookie_days' => [
            'label' => 'Referral Cookie Duration (days)',
            'description' => 'How long the referral code is saved in visitor\'s browser.',
        ],
        
        'expiry_days' => [
            'label' => 'Commission Hold Period (days)',
            'description' => 'Days before pending commission becomes available for withdrawal. Set 0 for immediate.',
        ],
        
        'commission' => [
            'title' => 'Commission Settings',
            'fixed_label' => 'Fixed Commission (Rp)',
            'fixed_description' => 'Fixed amount given to referrer for each qualifying order.',
            'percent_label' => 'Percentage Commission (%)',
            'percent_description' => 'Percentage of order total given as commission (added to fixed amount).',
        ],
        
        'min_withdrawal' => [
            'label' => 'Minimum Withdrawal (Rp)',
            'description' => 'Minimum amount required to request withdrawal.',
        ],

        'max_withdrawal' => [
            'label' => 'Maximum Withdrawal (Rp)',
            'description' => 'Maximum amount per withdrawal request. Set 0 for unlimited.',
        ],
        
        'withdrawal' => [
            'title' => 'Withdrawal Settings',
            'enabled' => [
                'label' => 'Enable Withdrawal',
                'description' => 'Allow users to request commission withdrawals.',
            ],
            'require_otp' => [
                'label' => 'Require Email OTP',
                'description' => 'Send OTP to user email for withdrawal verification.',
            ],
            'require_password' => [
                'label' => 'Require Password Confirmation',
                'description' => 'Users must confirm password when requesting withdrawal.',
            ],
        ],
        
        'example' => [
            'title' => 'Example Calculation',
        ],
    ],

    // ==========================================
    // MESSAGES
    // ==========================================
    'messages' => [
        'saved' => 'Settings saved successfully.',
        'error' => 'Failed to save settings.',
    ],
];
