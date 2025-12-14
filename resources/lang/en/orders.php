<?php

return [
    // ==========================================
    // USER-FACING ORDERS
    // ==========================================
    'title' => 'My Orders',
    'subtitle' => 'Your purchase history',
    'buy_credits' => 'Buy Credits',
    
    'filter' => [
        'all_status' => 'All Status',
    ],
    
    'status' => [
        'pending' => 'Pending',
        'paid' => 'Paid',
        'processing' => 'Processing',
        'completed' => 'Completed',
        'failed' => 'Failed',
        'cancelled' => 'Cancelled',
        'refunded' => 'Refunded',
    ],
    
    'list' => [
        'credit_added' => 'Credit Added',
        'credits' => ':amount credits',
        'total' => 'Total',
        'details' => 'Details',
    ],
    
    'empty' => [
        'title' => 'No orders yet',
        'description' => 'Your orders will appear here after making a purchase.',
    ],
    
    'detail' => [
        'title' => 'Order Details',
        'order_number' => 'Order Number',
        'product' => 'Product',
        'credits' => 'Credits',
        'payment_method' => 'Payment Method',
        'total' => 'Total',
        'created' => 'Created',
        'verified' => 'Verified',
        'credits_added_on' => 'Credits added on :date',
        'view_full' => 'View Full Details',
    ],
    
    // Order Show Page
    'show' => [
        'title' => 'Order :number',
        'back' => 'Back to Orders',
        'created_at' => 'Created :date',
        
        // Payment Section
        'payment' => [
            'complete' => 'Complete Your Payment',
            'expires' => 'Payment expires:',
            'scan_qr' => 'Scan QR Code to Pay',
            'pay_now' => 'Pay Now',
            'redirect_notice' => 'You will be redirected to payment page',
            'code' => 'Payment Code',
            'copy' => 'Copy',
            'copied' => 'Copied!',
            'instructions' => 'Payment Instructions',
            'how_to_pay' => 'How to Pay',
            'check_status' => 'Check Payment Status',
            'checking' => 'Checking...',
        ],
        
        // Verification States
        'verified' => [
            'title' => 'Payment Successful!',
            'credits_added' => ':amount credits have been added to your account.',
            'credits_pending' => 'Your payment has been verified. Credits will be added shortly.',
            'view_credits' => 'View My Credits',
        ],
        
        'failed' => [
            'title' => 'Payment :status',
            'message' => 'Your payment could not be processed.',
            'try_again' => 'Try Again',
        ],
        
        // Order Summary Sidebar
        'summary' => [
            'title' => 'Order Summary',
            'product' => 'Product',
            'credits' => 'Credits',
            'payment_method' => 'Payment Method',
            'subtotal' => 'Subtotal',
            'fee' => 'Fee',
            'total' => 'Total',
            'reference' => 'Reference',
        ],
    ],

    // ==========================================
    // NOTIFICATIONS
    // ==========================================
    'notifications' => [
        'created' => [
            'subject' => '[:app] Order Created',
            'greeting' => 'Hello :name!',
            'line1' => 'Your order has been successfully created.',
            'details_title' => '**Order Details:**',
            'order_id' => '• Order ID: :value',
            'product' => '• Product: :value',
            'amount' => '• Amount: :value',
            'credit' => '• Credit: :value credits',
            'status' => '• Status: :value',
            'action' => 'View Order',
            'thanks' => 'Thank you for your purchase!',
            'title' => 'Order Created',
            'message' => 'Your order #:order_number for :product has been created.',
        ],
        'status_updated' => [
            'subject' => '[:app] Order Status Updated',
            'greeting' => 'Hello :name!',
            'line1' => 'Your order status has been updated.',
            'details_title' => '**Order Details:**',
            'order_id' => '• Order ID: :value',
            'product' => '• Product: :value',
            'previous_status' => '• Previous Status: :value',
            'new_status' => '• New Status: :value',
            'action' => 'View Order',
            'title' => 'Order Status: :status',
            'statuses' => [
                'verified' => '✅ Your order has been verified and credit will be added to your account.',
                'paid' => '✅ Your payment has been confirmed.',
                'processing' => '⏳ Your order is now being processed.',
                'completed' => '✅ Your order has been completed successfully!',
                'failed' => '❌ Your order has failed. Please contact support if you need assistance.',
                'cancelled' => '❌ Your order has been cancelled.',
                'refunded' => '💰 Your order has been refunded.',
                'default' => 'Your order status has been updated to :status.',
            ],
        ],
        'credit_added' => [
            'subject' => '[:app] 💰 Credit Added to Your Account',
            'greeting' => 'Hello :name!',
            'line1' => 'Great news! Credit has been added to your account.',
            'details_title' => '**Transaction Details:**',
            'order_id' => '• Order ID: :value',
            'product' => '• Product: :value',
            'credit_added' => '• Credit Added: :value credits',
            'new_balance' => '• New Balance: :value credits',
            'action' => 'View Balance',
            'thanks' => 'Thank you for your purchase!',
            'title' => '💰 Credit Added',
            'message' => ':amount credits have been added to your account from order #:order_number.',
        ],
    ],
];
