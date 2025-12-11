<?php

return [
    // ==========================================
    // PRODUCT CATEGORIES
    // ==========================================
    'product_categories' => [
        'title' => 'Product Categories',
        'description' => 'Manage product categories for your store.',
        'add' => 'Add Category',
        'edit' => 'Edit Category',
        
        'table' => [
            'name' => 'Name',
            'slug' => 'Slug',
            'products' => 'Products',
            'status' => 'Status',
        ],
        
        'form' => [
            'name' => 'Category Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'is_active' => 'Active',
        ],
        
        'empty' => 'No categories found.',
        
        'messages' => [
            'created' => 'Category created successfully.',
            'updated' => 'Category updated successfully.',
            'deleted' => 'Category deleted successfully.',
        ],
    ],

    // ==========================================
    // PRODUCTS
    // ==========================================
    'products' => [
        'title' => 'Products',
        'description' => 'Manage credit packages and products.',
        'add' => 'Add Product',
        'edit' => 'Edit Product',
        
        'table' => [
            'name' => 'Name',
            'category' => 'Category',
            'price' => 'Price',
            'credits' => 'Credits',
            'sales' => 'Sales',
            'status' => 'Status',
        ],
        
        'filters' => [
            'search' => 'Search products...',
            'all_categories' => 'All Categories',
        ],
        
        'form' => [
            'name' => 'Product Name',
            'description' => 'Description',
            'category' => 'Category',
            'price' => 'Price',
            'credits' => 'Credits Amount',
            'is_featured' => 'Featured Product',
            'is_active' => 'Active',
        ],
        
        'empty' => 'No products found.',
        
        'messages' => [
            'created' => 'Product created successfully.',
            'updated' => 'Product updated successfully.',
            'deleted' => 'Product deleted successfully.',
        ],
    ],

    // ==========================================
    // PAYMENT METHODS
    // ==========================================
    'payment_methods' => [
        'title' => 'Payment Methods',
        'description' => 'Configure available payment methods.',
        'add' => 'Add Payment Method',
        'edit' => 'Edit Payment Method',
        
        'table' => [
            'name' => 'Name',
            'type' => 'Type',
            'fee' => 'Fee',
            'status' => 'Status',
        ],
        
        'types' => [
            'manual' => 'Manual Transfer',
            'gateway' => 'Payment Gateway',
            'wallet' => 'E-Wallet',
        ],
        
        'form' => [
            'name' => 'Method Name',
            'type' => 'Type',
            'description' => 'Description',
            'instructions' => 'Payment Instructions',
            'fee_type' => 'Fee Type',
            'fee_amount' => 'Fee Amount',
            'is_active' => 'Active',
        ],
        
        'fee_types' => [
            'fixed' => 'Fixed',
            'percentage' => 'Percentage',
        ],
        
        'empty' => 'No payment methods found.',
        
        'messages' => [
            'created' => 'Payment method created successfully.',
            'updated' => 'Payment method updated successfully.',
            'deleted' => 'Payment method deleted successfully.',
        ],
    ],

    // ==========================================
    // ORDERS
    // ==========================================
    'orders' => [
        'title' => 'Orders',
        'description' => 'Manage customer orders and transactions.',
        
        'table' => [
            'order_id' => 'Order ID',
            'customer' => 'Customer',
            'product' => 'Product',
            'amount' => 'Amount',
            'status' => 'Status',
            'date' => 'Date',
        ],
        
        'filters' => [
            'search' => 'Search orders...',
            'all_status' => 'All Status',
        ],
        
        'status' => [
            'pending' => 'Pending',
            'processing' => 'Processing',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            'refunded' => 'Refunded',
            'failed' => 'Failed',
        ],
        
        'detail' => [
            'title' => 'Order Details',
            'order_info' => 'Order Information',
            'customer_info' => 'Customer Information',
            'payment_info' => 'Payment Information',
            'payment_method' => 'Payment Method',
            'payment_proof' => 'Payment Proof',
            'notes' => 'Notes',
        ],
        
        'actions' => [
            'approve' => 'Approve',
            'reject' => 'Reject',
            'cancel' => 'Cancel',
            'update_status' => 'Update Status',
        ],
        
        'empty' => 'No orders found.',
        
        'messages' => [
            'approved' => 'Order approved successfully.',
            'rejected' => 'Order rejected.',
            'cancelled' => 'Order cancelled.',
            'status_updated' => 'Order status updated.',
        ],
    ],

    // ==========================================
    // CREDIT LOGS
    // ==========================================
    'credit_logs' => [
        'title' => 'Credit Logs',
        'description' => 'View all credit transactions.',
        'add' => 'Add Credit',
        
        'table' => [
            'user' => 'User',
            'type' => 'Type',
            'amount' => 'Amount',
            'balance' => 'Balance',
            'description' => 'Description',
            'date' => 'Date',
        ],
        
        'types' => [
            'purchase' => 'Purchase',
            'usage' => 'Usage',
            'refund' => 'Refund',
            'bonus' => 'Bonus',
            'adjustment' => 'Adjustment',
            'referral' => 'Referral Bonus',
            'withdrawal' => 'Withdrawal',
        ],
        
        'filters' => [
            'search' => 'Search by user...',
            'all_types' => 'All Types',
        ],
        
        'form' => [
            'user' => 'Select User',
            'type' => 'Transaction Type',
            'amount' => 'Amount',
            'description' => 'Description',
            'search_user' => 'Search user by name or email...',
            'current_credit' => 'Current Credit',
            'select_type' => '-- Select Type --',
            'amount_hint' => 'Use positive value to add credits, negative to subtract.',
            'amount_placeholder' => 'Example: 100.00 or -50.00',
            'description_placeholder' => 'Optional: Additional notes about this transaction...',
            'preview_title' => 'Preview Changes',
            'credit_before' => 'Current credit:',
            'insufficient_warning' => 'Warning: User has insufficient credits for this deduction.',
        ],
        
        'detail' => [
            'title' => 'Transaction Details',
            'before_balance' => 'Balance Before',
            'after_balance' => 'Balance After',
            'reference' => 'Reference',
            'credit_change' => 'Credit Change',
            'before' => 'Before',
            'after' => 'After',
            'additional_info' => 'Additional Info',
        ],
        
        'empty' => 'No credit logs found.',
        
        'messages' => [
            'created' => 'Credit added successfully.',
        ],
    ],

    // ==========================================
    // GENERAL
    // ==========================================
    'balance' => 'Balance',
    'credits' => 'Credits',
    'total_credits' => 'Total Credits',
    'available_credits' => 'Available Credits',
    'used_credits' => 'Used Credits',
    
    // ==========================================
    // USER-FACING - CREDITS INDEX
    // ==========================================
    'user' => [
        'balance' => [
            'label' => 'Your Credit Balance',
            'available' => 'Credits available',
            'current' => 'Current Balance',
        ],
        
        'actions' => [
            'view_history' => 'View History',
            'my_orders' => 'My Orders',
            'buy_credits' => 'Buy Credits',
        ],
        
        'products' => [
            'title' => 'Buy Credits',
            'credits' => 'credits',
            'bonus' => '+:amount Bonus',
            'buy_now' => 'Buy Now',
            'empty_title' => 'No products available',
            'empty_desc' => 'Check back later for available credit packages.',
        ],
        
        'history' => [
            'title' => 'Credit History',
            'subtitle' => 'Your credit transaction history',
            'all_types' => 'All Types',
            'balance_after' => 'Balance: :amount',
            'empty_title' => 'No transactions yet',
            'empty_desc' => 'Your credit history will appear here.',
        ],
        
        'purchase' => [
            'title' => 'Confirm Purchase',
            'subtitle' => 'Complete your credit purchase',
            'product' => 'Product',
            'credits' => 'Credits',
            'credits_label' => 'Credits',
            'bonus' => '+:amount Bonus Credits',
            'select_payment' => 'Select Payment Method',
            'auto' => 'Auto',
            'manual' => 'Manual',
            'fee' => 'Fee:',
            'no_fee' => 'No Fee',
            'subtotal' => 'Subtotal',
            'payment_fee' => 'Payment Fee',
            'total' => 'Total',
            'cancel' => 'Cancel',
            'pay_now' => 'Pay Now',
            'processing' => 'Processing...',
            'loading' => 'Loading product...',
        ],
    ],
    
    // ==========================================
    // ORDERS (Admin)
    // ==========================================
    'orders' => [
        'table' => [
            'order_id' => 'Order Number',
            'customer' => 'Customer',
            'product' => 'Product',
        ],
        'detail' => [
            'payment_info' => 'Payment',
            'payment_method' => 'Method',
            'notes' => 'Notes',
        ],
        'actions' => [
            'update_status' => 'Update Status',
        ],
    ],
    
    'credits' => 'Credits',
];
