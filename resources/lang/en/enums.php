<?php

return [
    // ==========================================
    // NOTIFICATION TYPE
    // ==========================================
    'notification_type' => [
        'labels' => [
            'order_created' => 'Order Created',
            'order_paid' => 'Order Paid',
            'order_processing' => 'Order Processing',
            'order_completed' => 'Order Completed',
            'order_failed' => 'Order Failed',
            'order_refunded' => 'Order Refunded',
            'credit_added' => 'Credit Added',
            'credit_deducted' => 'Credit Deducted',
            'credit_low_balance' => 'Low Balance Alert',
            'ticket_created' => 'Ticket Created',
            'ticket_replied' => 'Ticket Reply',
            'ticket_closed' => 'Ticket Closed',
            'ticket_assigned' => 'Ticket Assigned',
            'news_published' => 'News Published',
            'account_login_alert' => 'Login Alert',
            'account_password_changed' => 'Password Changed',
            'account_email_changed' => 'Email Changed',
            'account_2fa_enabled' => '2FA Enabled',
            'account_2fa_disabled' => '2FA Disabled',
            'system_maintenance' => 'Maintenance Notice',
            'system_update' => 'System Update',
            'system_announcement' => 'Announcement',
            'admin_user_registered' => 'New User Registered',
            'admin_order_created' => 'New Order Created',
            'admin_order_failed' => 'Order Failed',
            'admin_ticket_created' => 'New Ticket Created',
            'admin_system_error' => 'System Error',
            'admin_low_stock' => 'Low Stock Alert',
            'test' => 'Test Notification',
        ],
        
        'categories' => [
            'order' => 'Orders',
            'credit' => 'Credit & Balance',
            'ticket' => 'Support Tickets',
            'news' => 'News & Updates',
            'account' => 'Account & Security',
            'system' => 'System',
            'admin' => 'Admin Alerts',
            'test' => 'Test',
        ],
        
        'descriptions' => [
            'order_created' => 'When a new order is placed',
            'order_paid' => 'When order payment is confirmed',
            'order_processing' => 'When order processing starts',
            'order_completed' => 'When order is completed successfully',
            'order_failed' => 'When order fails or is cancelled',
            'order_refunded' => 'When order is refunded',
            'credit_added' => 'When credit is added to your account',
            'credit_deducted' => 'When credit is deducted from your account',
            'credit_low_balance' => 'When your balance is running low',
            'ticket_created' => 'When a new support ticket is created',
            'ticket_replied' => 'When staff replies to your ticket',
            'ticket_closed' => 'When your ticket is closed',
            'ticket_assigned' => 'When a ticket is assigned to you',
            'news_published' => 'When new articles or announcements are published',
            'account_login_alert' => 'When a new login is detected',
            'account_password_changed' => 'When your password is changed',
            'account_email_changed' => 'When your email is changed',
            'account_2fa_enabled' => 'When two-factor auth is enabled',
            'account_2fa_disabled' => 'When two-factor auth is disabled',
            'system_maintenance' => 'Scheduled maintenance notices',
            'system_update' => 'System updates and changes',
            'system_announcement' => 'General announcements',
            'admin_user_registered' => 'When a new user registers',
            'admin_order_created' => 'When a new order is placed',
            'admin_order_failed' => 'When an order payment fails',
            'admin_ticket_created' => 'When a user creates a new ticket',
            'admin_system_error' => 'When a system error occurs',
            'admin_low_stock' => 'When product stock is running low',
            'test' => 'Test notification for debugging',
        ],
    ],
    
    // ==========================================
    // CREDIT LOG TYPE
    // ==========================================
    'credit_log_type' => [
        'labels' => [
            'purchase' => 'Credit Purchase',
            'admin_adjustment' => 'Admin Adjustment',
            'refund' => 'Refund',
            'bonus' => 'Bonus',
            'withdrawal' => 'Withdrawal',
            'free_credit' => 'Free Credit',
        ],
        'descriptions' => [
            'purchase' => 'Credit added from package purchase',
            'admin_adjustment' => 'Manual adjustment by administrator',
            'refund' => 'Credit returned from cancelled transaction',
            'bonus' => 'Bonus credit from promotion or reward',
            'withdrawal' => 'Credit withdrawal from account',
            'free_credit' => 'Monthly free credit claim',
        ],
    ],
    
    // ==========================================
    // NOTIFICATION CHANNEL
    // ==========================================
    'notification_channel' => [
        'labels' => [
            'database' => 'In-App',
            'email' => 'Email',
            'push' => 'Push',
        ],
        'descriptions' => [
            'database' => 'Notifications appear in your notification center',
            'email' => 'Receive notifications via email',
            'push' => 'Browser push notifications',
        ],
    ],
    
    // ==========================================
    // API TOKEN ABILITY
    // ==========================================
    'api_token_ability' => [
        'labels' => [
            'create' => 'Create',
            'read' => 'Read',
            'update' => 'Update',
            'delete' => 'Delete',
        ],
        'descriptions' => [
            'create' => 'Create new resources',
            'read' => 'Read and view resources',
            'update' => 'Update existing resources',
            'delete' => 'Delete resources',
        ],
    ],
];
