<?php

return [
    // ==========================================
    // GENERAL
    // ==========================================
    'title' => 'Referral Program',
    'description' => 'Earn rewards by inviting friends.',

    // ==========================================
    // REFERRAL MANAGEMENT (Admin)
    // ==========================================
    'management' => [
        'title' => 'Referrals',
        'description' => 'Manage user referrals and commissions.',
        
        'table' => [
            'referrer' => 'Referrer',
            'referred' => 'Referred User',
            'code' => 'Referral Code',
            'date' => 'Date',
            'status' => 'Status',
            'earnings' => 'Earnings',
        ],
        
        'filters' => [
            'search' => 'Search by user...',
        ],
        
        'empty' => 'No referrals found.',
    ],

    // ==========================================
    // COMMISSIONS
    // ==========================================
    'commissions' => [
        'title' => 'Commissions',
        'description' => 'View and manage referral commissions.',
        
        'table' => [
            'user' => 'User',
            'referee' => 'Referred User',
            'order' => 'Order',
            'amount' => 'Commission',
            'status' => 'Status',
            'date' => 'Date',
        ],
        
        'status' => [
            'pending' => 'Pending',
            'approved' => 'Approved',
            'paid' => 'Paid',
            'cancelled' => 'Cancelled',
        ],
        
        'filters' => [
            'all_status' => 'All Status',
            'search' => 'Search...',
        ],
        
        'empty' => 'No commissions found.',
        
        'stats' => [
            'total' => 'Total Commissions',
            'pending' => 'Pending',
            'approved' => 'Approved',
            'paid' => 'Paid',
        ],
    ],

    // ==========================================
    // WITHDRAWALS
    // ==========================================
    'withdrawals' => [
        'title' => 'Withdrawals',
        'description' => 'Manage withdrawal requests.',
        
        'table' => [
            'user' => 'User',
            'amount' => 'Amount',
            'method' => 'Method',
            'account' => 'Account Details',
            'status' => 'Status',
            'date' => 'Request Date',
        ],
        
        'status' => [
            'pending' => 'Pending',
            'processing' => 'Processing',
            'completed' => 'Completed',
            'rejected' => 'Rejected',
        ],
        
        'actions' => [
            'approve' => 'Approve',
            'reject' => 'Reject',
            'process' => 'Process',
            'complete' => 'Mark Completed',
        ],
        
        'form' => [
            'amount' => 'Amount',
            'method' => 'Withdrawal Method',
            'account_name' => 'Account Name',
            'account_number' => 'Account Number',
            'bank_name' => 'Bank Name',
            'notes' => 'Notes',
        ],
        
        'empty' => 'No withdrawal requests found.',
        
        'messages' => [
            'approved' => 'Withdrawal approved successfully.',
            'rejected' => 'Withdrawal rejected.',
            'completed' => 'Withdrawal marked as completed.',
            'requested' => 'Withdrawal request submitted.',
        ],
        
        'errors' => [
            'minimum' => 'Minimum withdrawal amount is :amount.',
            'insufficient' => 'Insufficient balance.',
        ],
    ],

    // ==========================================
    // USER REFERRAL PAGE
    // ==========================================
    'user' => [
        'your_code' => 'Your Referral Code',
        'your_link' => 'Your Referral Link',
        'copy_link' => 'Copy Link',
        'share' => 'Share',
        'share_via' => 'Share via',
        
        'stats' => [
            'total_earnings' => 'Total Earnings',
            'from_referrals' => 'From :count referrals',
            'total_referrals' => 'Total Referrals',
            'active_referrals' => 'Active Referrals',
            'earnings' => 'Total Earnings',
            'pending_earnings' => 'Pending Earnings',
            'available' => 'Available',
            'pending' => 'Pending',
            'withdrawn' => 'Withdrawn',
            'available_balance' => 'Available Balance',
        ],
        
        'actions' => [
            'withdrawal_history' => 'Withdrawal History',
            'request_withdrawal' => 'Request Withdrawal',
        ],
        
        'link' => [
            'title' => 'Your Referral Link',
            'description' => "Share this link with friends. When they register and make a purchase, you'll earn commission!",
        ],
        
        'referrals_list' => 'Your Referrals',
        'commission_history' => 'Commission History',
        'withdraw' => 'Withdraw',
        'request_withdrawal' => 'Request Withdrawal',
        'search' => 'Search...',
        
        'table' => [
            'user' => 'User',
            'joined' => 'Joined',
            'status' => 'Status',
        ],
        
        'status' => [
            'verified' => 'Verified',
            'pending' => 'Pending',
        ],
        
        'referrals_empty' => [
            'title' => 'No referrals yet',
            'description' => 'Share your referral link to start earning!',
        ],
        
        'recent_commissions' => 'Recent Commissions',
        'commission_from' => 'Commission from :name',
        
        'commission_status' => [
            'available' => 'Available',
            'pending' => 'Pending',
            'withdrawn' => 'Withdrawn',
        ],
        
        'commissions_empty' => [
            'title' => 'No commissions yet',
            'description' => 'Commissions will appear when your referrals make purchases.',
        ],
        
        'how_it_works' => 'How It Works',
        'step1' => 'Share your referral link with friends',
        'step2' => 'They sign up using your link',
        'step3' => 'Earn commission when they make purchases',

        // Referral code editing
        'code' => [
            'label' => 'Referral Code',
            'edit' => 'Edit',
            'save' => 'Save',
            'cancel' => 'Cancel',
            'updated' => 'Referral code updated successfully!',
            'validation' => [
                'required' => 'Referral code is required.',
                'min' => 'Referral code must be at least 4 characters.',
                'max' => 'Referral code cannot exceed 20 characters.',
                'alpha_dash' => 'Referral code can only contain letters, numbers, dashes, and underscores.',
                'unique' => 'This referral code is already taken.',
            ],
        ],
        
        // User-facing Withdrawals Page
        'withdrawals' => [
            'title' => 'Withdrawal History',
            'available' => 'Available:',
            'request' => 'Request Withdrawal',
            'back' => 'Back to Referral',
            
            'table' => [
                'date' => 'Date',
                'amount' => 'Amount',
                'account_details' => 'Account Details',
                'status' => 'Status',
            ],
            
            'empty' => [
                'title' => 'No withdrawals yet',
                'description' => 'Your withdrawal history will appear here.',
            ],
            
            'modal' => [
                'title' => 'Request Withdrawal',
                'available' => 'Available:',
                'payment_method' => 'Payment Method',
                'select_payment_method' => 'Select payment method...',
                'min_amount' => 'Minimum',
                'max_amount' => 'Maximum',
                'amount' => 'Amount',
                'bank_name' => 'Bank Name',
                'bank_placeholder' => 'e.g. BCA, Mandiri, BNI',
                'account_number' => 'Account Number',
                'account_number_placeholder' => '1234567890',
                'account_holder' => 'Account Holder Name',
                'account_holder_placeholder' => 'John Doe',
                'password' => 'Password',
                'password_placeholder' => 'Enter your password',
                'otp' => 'Verification Code',
                'otp_placeholder' => 'Enter 6-digit code',
                'send_otp' => 'Send OTP',
                'cancel' => 'Cancel',
                'submit' => 'Submit Request',
                'processing' => 'Processing...',
            ],

            'otp' => [
                'sent' => 'Verification code sent to your email.',
                'sent_message' => 'OTP has been sent to your email. Valid for 10 minutes.',
                'cooldown' => 'Please wait :seconds seconds before requesting again.',
                'email_subject' => '[:app] Withdrawal Verification Code',
                'email_body' => "Your withdrawal verification code is: :otp\n\nThis code is valid for 10 minutes. Do not share this code with anyone.\n\n- :app Team",
            ],

            'validation' => [
                'payment_method_required' => 'Please select a payment method.',
                'min' => 'Minimum withdrawal is :amount',
                'max' => 'Maximum withdrawal is :amount',
                'bank_name_required' => 'Bank name is required',
                'account_number_required' => 'Account number is required',
                'account_holder_required' => 'Account holder name is required',
                'password_required' => 'Password is required for verification.',
                'password_incorrect' => 'The password you entered is incorrect.',
                'otp_required' => 'Please enter the verification code.',
                'otp_invalid' => 'Verification code must be 6 digits.',
                'otp_incorrect' => 'The verification code is incorrect or expired.',
            ],

            'error' => [
                'disabled' => 'Withdrawals are currently disabled.',
                'insufficient' => 'Insufficient available commission.',
            ],

            'success' => 'Withdrawal request submitted successfully!',
        ],
    ],
];
