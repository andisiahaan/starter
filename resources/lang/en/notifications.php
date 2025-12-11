<?php

return [
    // ==========================================
    // GENERAL
    // ==========================================
    'title' => 'Notifications',
    'description' => 'Stay updated with your latest notifications and alerts.',
    'mark_all_read' => 'Mark All as Read',
    'clear_all' => 'Clear all',
    'no_notifications' => 'No notifications',
    'view_all' => 'View all notifications',

    // ==========================================
    // INDEX PAGE
    // ==========================================
    'filter_all' => 'All',
    'filter_unread' => 'Unread',
    'filter_read' => 'Read',
    'mark_read' => 'Mark as Read',
    'mark_unread' => 'Mark as Unread',
    'delete' => 'Delete',
    'delete_all_read' => 'Delete All Read',
    'view' => 'View',
    'select_all' => 'Select All',
    'new' => 'New',
    'selected_count' => ':count selected',
    
    // Confirmations
    'confirm_delete' => 'Are you sure you want to delete this notification?',
    'confirm_delete_selected' => 'Are you sure you want to delete the selected notifications?',
    'confirm_delete_all_read' => 'Are you sure you want to delete all read notifications?',
    
    // Toast Messages
    'marked_as_read' => 'Notification marked as read.',
    'marked_as_unread' => 'Notification marked as unread.',
    'bulk_marked_read' => ':count notifications marked as read.',
    'bulk_marked_unread' => ':count notifications marked as unread.',
    'all_marked_read' => 'All notifications marked as read.',
    'deleted' => 'Notification deleted.',
    'bulk_deleted' => ':count notifications deleted.',
    'all_read_deleted' => ':count read notifications deleted.',
    
    // Empty States
    'empty_title' => 'No Notifications',
    'empty_description' => "You're all caught up! We'll notify you when there's something new.",
    'empty_unread_title' => 'No Unread Notifications',
    'empty_unread_description' => "You've read all your notifications. Great job staying on top of things!",
    'empty_read_title' => 'No Read Notifications',
    'empty_read_description' => "You haven't read any notifications yet, or they've been deleted.",

    // ==========================================
    // PREFERENCES
    // ==========================================
    'preferences' => [
        'title' => 'Notification Preferences',
        'description' => 'Choose how you want to receive notifications.',
        
        'channels' => [
            'title' => 'Notification Channels',
            'email' => 'Email',
            'email_description' => 'Receive notifications via email',
            'push' => 'Push Notifications',
            'push_description' => 'Receive browser push notifications',
            'database' => 'In-App',
            'database_description' => 'Show notifications in the app',
        ],
        
        'types_title' => 'Notification Types',
    ],

    // ==========================================
    // CATEGORIES
    // ==========================================
    'categories' => [
        'account' => [
            'title' => 'Account Notifications',
            'login' => 'New login alerts',
            'password_changed' => 'Password change alerts',
            'profile_updated' => 'Profile update confirmations',
        ],
        
        'orders' => [
            'title' => 'Order Notifications',
            'order_placed' => 'Order confirmation',
            'order_status' => 'Order status updates',
            'payment_received' => 'Payment confirmations',
        ],
        
        'credits' => [
            'title' => 'Credit Notifications',
            'credit_added' => 'Credits added',
            'credit_used' => 'Credits used',
            'low_balance' => 'Low balance alerts',
        ],
        
        'referral' => [
            'title' => 'Referral Notifications',
            'new_referral' => 'New referral sign-ups',
            'commission_earned' => 'Commission earned',
            'withdrawal_status' => 'Withdrawal updates',
        ],
        
        'support' => [
            'title' => 'Support Notifications',
            'ticket_reply' => 'Ticket replies',
            'ticket_resolved' => 'Ticket resolution',
        ],
        
        'marketing' => [
            'title' => 'Marketing Notifications',
            'newsletter' => 'Newsletter and updates',
            'promotions' => 'Promotions and offers',
            'product_updates' => 'Product updates',
        ],
        
        'admin' => [
            'title' => 'Admin Notifications',
            'new_user' => 'New user registrations',
            'new_order' => 'New orders',
            'new_ticket' => 'New support tickets',
            'withdrawal_request' => 'Withdrawal requests',
        ],
    ],

    // ==========================================
    // NOTIFICATION TYPES/MESSAGES
    // ==========================================
    'types' => [
        'welcome' => 'Welcome to :app!',
        'email_verified' => 'Your email has been verified.',
        'password_changed' => 'Your password has been changed.',
        'new_login' => 'New login detected from :device',
        'order_placed' => 'Order #:id has been placed.',
        'order_completed' => 'Order #:id has been completed.',
        'credits_added' => ':amount credits have been added to your account.',
        'new_referral' => ':name signed up using your referral code!',
        'commission_earned' => "You've earned :amount in commission!",
        'ticket_replied' => 'Your ticket #:id has a new reply.',
        'ticket_resolved' => 'Your ticket #:id has been resolved.',
    ],

    // ==========================================
    // MESSAGES
    // ==========================================
    'messages' => [
        'preferences_saved' => 'Notification preferences saved.',
        'marked_read' => 'Notification marked as read.',
        'all_marked_read' => 'All notifications marked as read.',
        'cleared' => 'Notifications cleared.',
    ],
    
    // ==========================================
    // EMAIL CHANGE NOTIFICATIONS
    // ==========================================
    'email_change' => [
        'subject' => 'Verify Email Change',
        'greeting' => 'Hello!',
        'line1' => 'You have requested to change your email address to :email.',
        'action' => 'Verify Email Address',
        'expire' => 'This link will expire in 24 hours.',
        'ignore' => 'If you did not request this change, please ignore this email.',
    ],
    
    // ==========================================
    // COMMON
    // ==========================================
    'common' => [
        'greeting' => 'Hello!',
        'regards' => 'Regards',
    ],
];
