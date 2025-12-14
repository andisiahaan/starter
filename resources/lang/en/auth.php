<?php

return [
    // ==========================================
    // PAGE TITLES
    // ==========================================
    'login' => [
        'title' => 'Login',
        'heading' => 'Sign in to your account',
        'subtitle' => 'Welcome back! Please enter your details.',
        'button' => 'Sign in',
        'no_account' => "Don't have an account yet?",
        'register_link' => 'Sign up',
    ],

    'register' => [
        'title' => 'Register',
        'heading' => 'Create an account',
        'subtitle' => 'Join us today and get started.',
        'button' => 'Create account',
        'have_account' => 'Already have an account?',
        'login_link' => 'Sign in',
        'terms_agree' => 'I agree to the',
        'terms_link' => 'Terms and Conditions',
        'privacy_link' => 'Privacy Policy',
    ],

    'forgot_password' => [
        'title' => 'Forgot Password',
        'heading' => 'Forgot your password?',
        'subtitle' => "No worries! Enter your email and we'll send you a reset link.",
        'button' => 'Send reset link',
        'back_to_login' => 'Back to login',
        'success' => 'We have emailed your password reset link!',
    ],

    'reset_password' => [
        'title' => 'Reset Password',
        'heading' => 'Reset your password',
        'subtitle' => 'Enter your new password below.',
        'button' => 'Reset password',
        'success' => 'Your password has been reset successfully!',
        'new_password' => 'New Password',
        'confirm_password' => 'Confirm New Password',
    ],
    
    // Quick alias
    'email' => 'Email',

    'verify_email' => [
        'title' => 'Verify Email',
        'heading' => 'Verify your email address',
        'subtitle' => 'Before continuing, please verify your email address by clicking the link we sent to your inbox.',
        'resend' => 'Resend verification email',
        'resent' => 'A fresh verification link has been sent to your email address.',
        'check_inbox' => 'Check your inbox',
        'not_received' => "Didn't receive the email?",
    ],

    // ==========================================
    // FORM FIELDS
    // ==========================================
    'fields' => [
        'name' => 'Full Name',
        'name_placeholder' => 'John Doe',
        'email' => 'Email',
        'email_placeholder' => 'name@company.com',
        'email_or_username' => 'Email or Username',
        'email_or_username_placeholder' => 'email@example.com or username',
        'phone' => 'Phone Number',
        'phone_placeholder' => '+12345678900',
        'username' => 'Username',
        'username_placeholder' => 'your_username',
        'password' => 'Password',
        'password_placeholder' => '••••••••',
        'password_confirm' => 'Confirm Password',
        'password_new' => 'New Password',
        'password_current' => 'Current Password',
        'remember_me' => 'Remember me',
        'referral_code' => 'Referral Code',
        'referral_code_placeholder' => 'Enter referral code (optional)',
    ],

    // ==========================================
    // SOCIAL LOGIN
    // ==========================================
    'social' => [
        'or_continue' => 'Or continue with',
        'google' => 'Continue with Google',
        'facebook' => 'Continue with Facebook',
        'github' => 'Continue with GitHub',
        'twitter' => 'Continue with Twitter',
    ],

    // ==========================================
    // MESSAGES
    // ==========================================
    'messages' => [
        'login_success' => 'Welcome back!',
        'logout_success' => 'You have been logged out successfully.',
        'register_success' => 'Account created successfully!',
        'password_changed' => 'Your password has been changed successfully.',
        'email_verified' => 'Your email has been verified.',
        'invalid_credentials' => 'These credentials do not match our records.',
        'account_banned' => 'Your account has been banned.',
        'too_many_attempts' => 'Too many login attempts. Please try again in :seconds seconds.',
    ],

    // ==========================================
    // VALIDATION
    // ==========================================
    'validation' => [
        'email_required' => 'Email is required.',
        'email_invalid' => 'Please enter a valid email address.',
        'password_required' => 'Password is required.',
        'password_min' => 'Password must be at least :min characters.',
        'password_confirmed' => 'Passwords do not match.',
        'name_required' => 'Name is required.',
        'username_required' => 'Username is required.',
        'username_taken' => 'This username is already taken.',
        'email_taken' => 'This email is already registered.',
        'terms_required' => 'You must agree to the terms and conditions.',
    ],

    // ==========================================
    // TWO-FACTOR CHALLENGE
    // ==========================================
    'two_factor_challenge' => [
        'title' => 'Two-Factor Authentication',
        'subtitle_code' => 'Enter the 6-digit code from your authenticator app.',
        'subtitle_recovery' => 'Enter one of your emergency recovery codes.',
        'code_label' => 'Code',
        'recovery_code_label' => 'Recovery Code',
        'verify' => 'Verify',
        'use_recovery' => 'Use a recovery code instead',
        'use_authenticator' => 'Use authenticator code instead',
        'cancel' => 'Cancel and go back to login',
        'error_code_invalid' => 'The provided code is invalid.',
        'error_recovery_invalid' => 'The provided recovery code is invalid.',
    ],

    // ==========================================
    // NOTIFICATIONS
    // ==========================================
    'notifications' => [
        'reset_password' => [
            'subject' => '[:app] Reset Password',
            'greeting' => 'Hello!',
            'line1' => 'You are receiving this email because we received a password reset request for your account.',
            'action' => 'Reset Password',
            'expire' => 'This password reset link will expire in :count minutes.',
            'ignore' => 'If you did not request a password reset, no further action is required.',
        ],
    ],
];
