<?php

return [
    // ==========================================
    // DASHBOARD
    // ==========================================
    'dashboard' => [
        'title' => 'Dashboard',
        'welcome' => 'Welcome to Admin Panel',
        'overview' => 'Overview',
        
        // Period Selector
        'period' => [
            'last_7_days' => 'Last 7 days',
            'last_30_days' => 'Last 30 days',
            'last_90_days' => 'Last 90 days',
        ],
        
        // Stats Cards
        'stats' => [
            'total_users' => 'Total Users',
            'new_users' => '+:count new',
            'total_orders' => 'Total Orders',
            'pending_orders' => ':count pending',
            'total_revenue' => 'Total Revenue',
            'period_revenue' => '+Rp :amount',
            'credits_given' => 'Credits Given',
            'period_credits' => '+:amount new',
        ],
        
        // Charts
        'charts' => [
            'revenue_overview' => 'Revenue Overview',
            'revenue_label' => 'Revenue (Rp)',
            'new_users' => 'New Users',
            'order_status' => 'Order Status',
        ],
        
        // Recent Activity
        'recent' => [
            'orders' => 'Recent Orders',
            'users' => 'Recent Users',
            'view_all' => 'View all',
            'no_orders' => 'No orders yet',
            'no_users' => 'No users yet',
            'guest' => 'Guest',
        ],
    ],

    // ==========================================
    // SIDEBAR MENU
    // ==========================================
    'sidebar' => [
        'admin_panel' => 'Admin Panel',
        'main' => 'Main',
        'dashboard' => 'Dashboard',
        'management' => 'Management',
        'users' => 'Users',
        'roles' => 'Roles',
        'permissions' => 'Permissions',
        'system' => 'System',
        'settings' => 'Settings',
        'credit_system' => 'Credit System',
        'products' => 'Products',
        'categories' => 'Categories',
        'payment_methods' => 'Payment Methods',
        'orders' => 'Orders',
        'credit_logs' => 'Credit Logs',
        'content' => 'Content',
        'pages' => 'Pages',
        'news' => 'News',
        'blog' => 'Blog',
        'posts' => 'Posts',
        'tags' => 'Tags',
        'help_center' => 'Help Center',
        'help_categories' => 'Categories',
        'help_articles' => 'Articles',
        'support' => 'Support',
        'tickets' => 'Tickets',
        'referral' => 'Referral',
        'referrals' => 'Referrals',
        'commissions' => 'Commissions',
        'withdrawals' => 'Withdrawals',
        'administrator' => 'Administrator',
    ],


    // ==========================================
    // USERS
    // ==========================================
    'users' => [
        'title' => 'Users',
        'description' => 'Manage all users, their roles and permissions.',
        'add' => 'Add User',
        'edit' => 'Edit User',
        'create' => 'Create User',
        'delete' => 'Delete User',
        
        'table' => [
            'user' => 'User',
            'roles' => 'Roles',
            'credits' => 'Credits',
            'joined' => 'Joined',
        ],
        
        'filters' => [
            'search' => 'Search by name, email or username...',
            'all_roles' => 'All Roles',
            'all_status' => 'All Status',
            'active_only' => 'Active Users',
            'with_deleted' => 'Include Deleted',
            'deleted_only' => 'Deleted Only',
        ],
        
        'bulk' => [
            'selected' => ':count user(s) selected',
            'ban' => 'Ban Selected',
            'unban' => 'Unban Selected',
            'restore' => 'Restore Selected',
            'force_delete' => 'Permanently Delete',
        ],
        
        'actions' => [
            'ban' => 'Ban',
            'unban' => 'Unban',
            'restore' => 'Restore',
            'force_delete' => 'Delete Permanently',
        ],
        
        'status' => [
            'active' => 'Active',
            'banned' => 'Banned',
            'deleted' => 'Deleted',
        ],
        
        'no_roles' => 'No roles',
        'no_permission' => 'No access',
        'empty' => 'No users found.',
        'empty_deleted' => 'No deleted users found.',
        
        'confirm' => [
            'ban' => 'Are you sure you want to ban this user?',
            'unban' => 'Are you sure you want to unban this user?',
            'delete' => 'Are you sure you want to delete this user?',
            'ban_bulk' => 'Are you sure you want to ban the selected users?',
            'unban_bulk' => 'Are you sure you want to unban the selected users?',
            'restore_bulk' => 'Are you sure you want to restore the selected users?',
            'force_delete' => 'This action is permanent and cannot be undone. Are you sure?',
            'force_delete_bulk' => 'This will permanently delete all selected users. This cannot be undone. Are you sure?',
        ],
        
        'messages' => [
            'created' => 'User created successfully.',
            'updated' => 'User updated successfully.',
            'deleted' => 'User deleted successfully.',
            'banned' => 'User has been banned.',
            'unbanned' => 'User has been unbanned.',
            'restored' => 'User has been restored.',
            'force_deleted' => 'User has been permanently deleted.',
        ],
        
        'modals' => [
            'delete' => [
                'title' => 'Delete User',
                'confirm' => 'Are you sure you want to delete :name?',
                'warning' => 'This action cannot be undone. All data associated with this user will be permanently removed.',
                'cancel' => 'Cancel',
                'submit' => 'Delete User',
                'deleting' => 'Deleting...',
            ],
            'ban' => [
                'title' => 'Ban User',
                'confirm' => 'You are about to ban :name',
                'warning' => 'This user will no longer be able to log in until unbanned.',
                'reason_label' => 'Ban Reason (optional)',
                'reason_placeholder' => 'Reason for banning this user...',
                'cancel' => 'Cancel',
                'submit' => 'Ban User',
                'banning' => 'Banning...',
            ],
            'create' => [
                'title' => 'Create User',
                'name' => 'Name',
                'email' => 'Email',
                'password' => 'Password',
                'password_hint' => '(leave blank to keep current)',
                'password_confirm' => 'Confirm Password',
                'roles' => 'Roles',
                'cancel' => 'Cancel',
                'create' => 'Create',
                'update' => 'Update',
                'saving' => 'Saving...',
            ],
            'edit' => [
                'title' => 'Edit User',
            ],
        ],
        
        'form' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirm' => 'Confirm Password',
            'password_hint' => 'Leave empty to keep current password',
            'roles' => 'Roles',
            'credits' => 'Credits',
            'ban_reason' => 'Ban Reason',
            'ban_reason_placeholder' => 'Enter reason for banning this user...',
        ],
    ],

    // ==========================================
    // ROLES
    // ==========================================
    'roles' => [
        'title' => 'Roles',
        'description' => 'Manage roles and their permissions.',
        'add' => 'Add Role',
        'edit' => 'Edit Role',
        'create' => 'Create Role',
        'delete' => 'Delete Role',
        
        'table' => [
            'name' => 'Name',
            'guard' => 'Guard',
            'permissions' => 'Permissions',
            'users' => 'Users',
        ],
        
        'empty' => 'No roles found.',
        
        'modals' => [
            'create' => [
                'title' => 'Create Role',
                'name' => 'Role Name',
                'guard' => 'Guard Name',
                'permissions' => 'Permissions',
                'cancel' => 'Cancel',
                'create' => 'Create',
                'update' => 'Update',
                'saving' => 'Saving...',
            ],
            'edit' => [
                'title' => 'Edit Role',
            ],
            'delete' => [
                'title' => 'Delete Role',
                'confirm' => 'Are you sure you want to delete the role :name?',
                'warning' => 'This action cannot be undone. All users with this role will lose their associated permissions.',
                'cancel' => 'Cancel',
                'submit' => 'Delete Role',
                'deleting' => 'Deleting...',
            ],
        ],
        
        'form' => [
            'name' => 'Role Name',
            'name_placeholder' => 'e.g. editor',
            'guard' => 'Guard Name',
            'permissions' => 'Permissions',
            'select_all' => 'Select All',
        ],
        
        'messages' => [
            'created' => 'Role created successfully.',
            'updated' => 'Role updated successfully.',
            'deleted' => 'Role deleted successfully.',
            'cannot_delete' => 'Cannot delete this role.',
        ],
        
        'confirm' => [
            'delete' => 'Are you sure you want to delete this role?',
        ],
    ],

    // ==========================================
    // PERMISSIONS
    // ==========================================
    'permissions' => [
        'title' => 'Permissions',
        'description' => 'Manage all available permissions.',
        'add' => 'Add Permission',
        'edit' => 'Edit Permission',
        'create' => 'Create Permission',
        'delete' => 'Delete Permission',
        
        'table' => [
            'name' => 'Name',
            'guard' => 'Guard',
            'roles' => 'Assigned Roles',
        ],
        
        'empty' => 'No permissions found.',
        
        'modals' => [
            'create' => [
                'title' => 'Create Permission',
                'name' => 'Permission Name',
                'guard' => 'Guard Name',
                'roles' => 'Assign to Roles',
                'cancel' => 'Cancel',
                'create' => 'Create',
                'update' => 'Update',
                'saving' => 'Saving...',
            ],
            'edit' => [
                'title' => 'Edit Permission',
            ],
            'delete' => [
                'title' => 'Delete Permission',
                'confirm' => 'Are you sure you want to delete the permission :name?',
                'warning_roles' => 'Warning: This permission is assigned to :count role(s).',
                'warning' => 'This action cannot be undone.',
                'cancel' => 'Cancel',
                'submit' => 'Delete Permission',
                'deleting' => 'Deleting...',
            ],
        ],
        
        'form' => [
            'name' => 'Permission Name',
            'name_placeholder' => 'e.g. edit posts',
            'guard' => 'Guard Name',
        ],
        
        'messages' => [
            'created' => 'Permission created successfully.',
            'updated' => 'Permission updated successfully.',
            'deleted' => 'Permission deleted successfully.',
        ],
        
        'confirm' => [
            'delete' => 'Are you sure you want to delete this permission?',
        ],
    ],

    // ==========================================
    // COMMON ADMIN
    // ==========================================
    'common' => [
        'filters' => 'Filters',
        'bulk_actions' => 'Bulk Actions',
        'per_page' => 'Per page',
        'export' => 'Export',
        'import' => 'Import',
        'refresh' => 'Refresh',
    ],
    
    // ==========================================
    // PRODUCTS MODALS
    // ==========================================
    'products' => [
        'modals' => [
            'create' => [
                'title' => 'Create Product',
                'name' => 'Name',
                'category' => 'Category',
                'no_category' => 'No Category',
                'description' => 'Description',
                'price' => 'Price (Rp)',
                'credit_amount' => 'Credit Amount',
                'bonus_credit' => 'Bonus Credit',
                'active' => 'Active',
                'cancel' => 'Cancel',
                'create' => 'Create',
                'update' => 'Update',
                'saving' => 'Saving...',
            ],
            'edit' => [
                'title' => 'Edit Product',
            ],
        ],
    ],
    
    // ==========================================
    // CATEGORIES MODALS
    // ==========================================
    'categories' => [
        'modals' => [
            'create' => [
                'title' => 'Create Category',
                'name' => 'Name',
                'slug' => 'Slug',
                'description' => 'Description',
                'active' => 'Active',
                'cancel' => 'Cancel',
                'create' => 'Create',
                'update' => 'Update',
                'saving' => 'Saving...',
            ],
            'edit' => [
                'title' => 'Edit Category',
            ],
        ],
    ],
    
    // ==========================================
    // PAGES MODALS
    // ==========================================
    'pages' => [
        'modals' => [
            'create' => [
                'title' => 'Create Page',
                'page_title' => 'Title',
                'slug' => 'Slug',
                'content' => 'Content',
                'meta_title' => 'Meta Title',
                'meta_description' => 'Meta Description',
                'layout' => 'Layout',
                'layout_default' => 'Default',
                'layout_full_width' => 'Full Width',
                'layout_sidebar' => 'Sidebar',
                'order' => 'Order',
                'published' => 'Published',
                'cancel' => 'Cancel',
                'create' => 'Create',
                'update' => 'Update',
                'saving' => 'Saving...',
            ],
            'edit' => [
                'title' => 'Edit Page',
            ],
            'delete' => [
                'title' => 'Delete Page',
                'confirm' => 'Are you sure you want to delete this page?',
                'warning' => 'This action cannot be undone.',
                'cancel' => 'Cancel',
                'submit' => 'Delete Page',
                'deleting' => 'Deleting...',
            ],
        ],
    ],
    
    // ==========================================
    // ORDERS
    // ==========================================
    'orders' => [
        'title' => 'Orders',
        'description' => 'Manage all purchase orders and transactions.',
        
        'filters' => [
            'search' => 'Search order number or user...',
            'all_status' => 'All Status',
        ],
        
        'table' => [
            'order' => 'Order',
            'user' => 'User',
            'product' => 'Product',
            'amount' => 'Amount',
            'status' => 'Status',
            'date' => 'Date',
        ],
        
        'credit_given' => 'Credit Given',
        'credits' => 'credits',
        'user_deleted' => 'User deleted',
        'empty' => 'No orders found.',
        
        'actions' => [
            'view' => 'View',
            'status' => 'Status',
        ],
        
        'modals' => [
            'update_status' => [
                'title' => 'Update Order Status',
            ],
            'detail' => [
                'title' => 'Order Details',
            ],
        ],
    ],
    
    // ==========================================
    // NEWS MODALS
    // ==========================================
    'news' => [
        'modals' => [
            'create' => [
                'title' => 'Create News',
                'cancel' => 'Cancel',
                'create' => 'Create',
                'update' => 'Update',
                'saving' => 'Saving...',
            ],
            'edit' => [
                'title' => 'Edit News',
            ],
            'delete' => [
                'title' => 'Delete News',
                'confirm' => 'Are you sure you want to delete this news?',
                'warning' => 'This action cannot be undone.',
                'cancel' => 'Cancel',
                'submit' => 'Delete News',
                'deleting' => 'Deleting...',
            ],
        ],
    ],
    
    // ==========================================
    // CREDIT LOGS MODALS
    // ==========================================
    'credit_logs' => [
        'modals' => [
            'detail' => [
                'title' => 'Credit Log Details',
            ],
        ],
    ],
    
    // ==========================================
    // PAYMENT METHODS MODALS
    // ==========================================
    'payment_methods' => [
        'modals' => [
            'create' => [
                'title' => 'Create Payment Method',
                'cancel' => 'Cancel',
                'create' => 'Create',
                'update' => 'Update',
                'saving' => 'Saving...',
            ],
            'edit' => [
                'title' => 'Edit Payment Method',
            ],
        ],
    ],
    
    // ==========================================
    // TICKETS
    // ==========================================
    'tickets' => [
        'title' => 'Support Tickets',
        'description' => 'Manage customer support tickets and inquiries.',
        
        'filters' => [
            'search' => 'Search ticket # or subject...',
            'all_status' => 'All Status',
            'all_priority' => 'All Priority',
        ],
        
        'table' => [
            'ticket' => 'Ticket',
            'user' => 'User',
            'priority' => 'Priority',
            'status' => 'Status',
            'assigned' => 'Assigned',
        ],
        
        'guest' => 'Guest',
        'assign_to_me' => 'Assign to me',
        'empty' => 'No tickets found.',
        
        'actions' => [
            'view' => 'View',
        ],
    ],
    
    // ==========================================
    // PRODUCTS (INDEX)
    // ==========================================
    'products_index' => [
        'title' => 'Products',
        'description' => 'Manage credit packages and other products.',
        'add' => 'Add Product',
        
        'filters' => [
            'search' => 'Search products...',
            'all_categories' => 'All Categories',
        ],
        
        'table' => [
            'product' => 'Product',
            'category' => 'Category',
            'price' => 'Price',
            'credit' => 'Credit',
            'status' => 'Status',
        ],
        
        'status' => [
            'active' => 'Active',
            'inactive' => 'Inactive',
        ],
        
        'empty' => 'No products found.',
        'confirm_delete' => 'Are you sure you want to delete this product?',
    ],
    
    // ==========================================
    // PRODUCT CATEGORIES (INDEX)
    // ==========================================
    'product_categories' => [
        'title' => 'Product Categories',
        'description' => 'Manage product categories for organizing your products.',
        'add' => 'Add Category',
        
        'filters' => [
            'search' => 'Search categories...',
        ],
        
        'table' => [
            'name' => 'Name',
            'slug' => 'Slug',
            'products' => 'Products',
            'status' => 'Status',
        ],
        
        'status' => [
            'active' => 'Active',
            'inactive' => 'Inactive',
        ],
        
        'empty' => 'No categories found.',
        'confirm_delete' => 'Are you sure you want to delete this category?',
    ],
    
    // ==========================================
    // NEWS (INDEX)
    // ==========================================
    'news_index' => [
        'title' => 'News & Announcements',
        'description' => 'Manage platform news, updates, and maintenance notices.',
        'add' => 'Add News',
        
        'filters' => [
            'search' => 'Search...',
            'all_types' => 'All Types',
        ],
        
        'table' => [
            'title' => 'Title',
            'type' => 'Type',
            'status' => 'Status',
            'author' => 'Author',
        ],
        
        'status' => [
            'published' => 'Published',
            'draft' => 'Draft',
        ],
        
        'unknown_author' => 'Unknown',
        'empty' => 'No news found.',
    ],
    
    // ==========================================
    // PAGES (INDEX)
    // ==========================================
    'pages_index' => [
        'title' => 'Pages',
        'description' => 'Manage static pages like Terms, Privacy Policy, FAQ.',
        'add' => 'Add Page',
        
        'filters' => [
            'search' => 'Search pages...',
        ],
        
        'table' => [
            'title' => 'Title',
            'slug' => 'Slug',
            'status' => 'Status',
            'layout' => 'Layout',
        ],
        
        'status' => [
            'published' => 'Published',
            'draft' => 'Draft',
        ],
        
        'empty' => 'No pages found.',
    ],
    
    // ==========================================
    // CREDIT LOGS (INDEX)
    // ==========================================
    'credit_logs_index' => [
        'title' => 'Credit Logs',
        'description' => 'Audit trail of all credit transactions.',
        'add' => 'Add Credit Log',
        
        'filters' => [
            'search' => 'Search user...',
            'all_types' => 'All Types',
            'all_users' => 'All Users',
        ],
        
        'table' => [
            'date' => 'Date',
            'user' => 'User',
            'type' => 'Type',
            'amount' => 'Amount',
            'balance' => 'Balance',
            'description' => 'Description',
        ],
        
        'user_deleted' => 'User deleted',
        'empty' => 'No credit logs found.',
    ],
    
    // ==========================================
    // PAYMENT METHODS (INDEX)
    // ==========================================
    'payment_methods_index' => [
        'title' => 'Payment Methods',
        'description' => 'Manage payment methods for transactions.',
        'add' => 'Add Payment Method',
        
        'filters' => [
            'search' => 'Search by name or code...',
            'all_providers' => 'All Providers',
            'all_types' => 'All Types',
        ],
        
        'table' => [
            'payment_method' => 'Payment Method',
            'provider' => 'Provider',
            'type' => 'Type',
            'limits' => 'Limits',
            'fees' => 'Fees',
            'status' => 'Status',
        ],
        
        'limits' => [
            'min' => 'Min',
            'max' => 'Max',
        ],
        
        'fees' => [
            'flat' => 'Flat',
        ],
        
        'status' => [
            'active' => 'Active',
            'inactive' => 'Inactive',
        ],
        
        'empty' => 'No payment methods found.',
        'confirm_delete' => 'Are you sure you want to delete this payment method?',
    ],
    
    // ==========================================
    // REFERRALS (INDEX)
    // ==========================================
    'referrals_index' => [
        'stats' => [
            'total_referrals' => 'Total Referred Users',
            'total_referrers' => 'Total Referrers',
        ],
        
        'title' => 'Referred Users',
        'search' => 'Search...',
        
        'table' => [
            'user' => 'User',
            'referred_by' => 'Referred By',
            'joined' => 'Joined',
        ],
        
        'empty' => 'No referrals found.',
    ],
    
    // ==========================================
    // WITHDRAWALS (INDEX)
    // ==========================================
    'withdrawals_index' => [
        'stats' => [
            'pending' => 'Pending',
            'processing' => 'Processing',
            'completed' => 'Completed',
        ],
        
        'title' => 'Withdrawals',
        'search' => 'Search...',
        'all_status' => 'All Status',
        
        'table' => [
            'user' => 'User',
            'amount' => 'Amount',
            'account' => 'Account',
            'status' => 'Status',
            'date' => 'Date',
            'actions' => 'Actions',
        ],
        
        'actions' => [
            'process' => 'Process',
            'approve' => 'Approve',
            'reject' => 'Reject',
            'complete' => 'Complete',
        ],
        
        'confirm_reject' => 'Are you sure you want to reject this withdrawal?',
        'empty' => 'No withdrawals found.',
    ],
    
    // ==========================================
    // TICKETS SHOW
    // ==========================================
    'tickets_show' => [
        'back' => 'Back to Tickets',
        'priority' => 'Priority',
        'conversation' => 'Conversation',
        'unknown' => 'Unknown',
        'reply_placeholder' => 'Type your reply...',
        'send_reply' => 'Send Reply',
        
        'details' => [
            'title' => 'Ticket Details',
            'status' => 'Status',
            'category' => 'Category',
            'user' => 'User',
            'email' => 'Email',
            'assigned' => 'Assigned To',
            'unassigned' => 'Unassigned',
            'guest' => 'Guest',
        ],
        'attachments' => 'Attachments',
        'attach_files' => 'Attach Files',
        'attachments_note' => 'Max 5 files. Accepted: JPG, PNG, GIF, PDF, DOC, TXT (max 5MB each)',
    ],
    
    // ==========================================
    // BLOG POSTS
    // ==========================================
    'blog_posts' => [
        'title' => 'Blog Posts',
        'description' => 'Manage blog articles and publications.',
        'add' => 'Add Post',
        
        'filters' => [
            'search' => 'Search posts...',
            'all_status' => 'All Status',
            'all_categories' => 'All Categories',
        ],
        
        'table' => [
            'post' => 'Post',
            'category' => 'Category',
            'author' => 'Author',
            'status' => 'Status',
            'published_at' => 'Published At',
        ],
        
        'status' => [
            'published' => 'Published',
            'draft' => 'Draft',
            'scheduled' => 'Scheduled',
        ],
        
        'uncategorized' => 'Uncategorized',
        'unknown_author' => 'Unknown',
        'empty' => 'No posts found.',
        'confirm_delete' => 'Are you sure you want to delete this post?',
        
        'form' => [
            'create_title' => 'Create Post',
            'edit_title' => 'Edit Post',
            'title' => 'Title',
            'slug' => 'Slug',
            'excerpt' => 'Excerpt',
            'content' => 'Content',
            'featured_image' => 'Featured Image',
            'category' => 'Category',
            'tags' => 'Tags',
            'status' => 'Status',
            'published_at' => 'Publish Date',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'cancel' => 'Cancel',
            'save' => 'Save Post',
            'saving' => 'Saving...',
            'select_category' => 'Select Category',
            'select_tags' => 'Select Tags',
        ],
    ],
    
    // ==========================================
    // BLOG CATEGORIES
    // ==========================================
    'blog_categories' => [
        'title' => 'Blog Categories',
        'description' => 'Manage categories for blog posts.',
        'add' => 'Add Category',
        
        'filters' => [
            'search' => 'Search categories...',
        ],
        
        'table' => [
            'name' => 'Name',
            'slug' => 'Slug',
            'posts' => 'Posts',
            'status' => 'Status',
        ],
        
        'status' => [
            'active' => 'Active',
            'inactive' => 'Inactive',
        ],
        
        'empty' => 'No categories found.',
        'confirm_delete' => 'Are you sure you want to delete this category?',
    ],
    
    // ==========================================
    // BLOG TAGS
    // ==========================================
    'blog_tags' => [
        'title' => 'Tags',
        'description' => 'Manage tags for blog posts.',
        'add' => 'Add Tag',
        
        'filters' => [
            'search' => 'Search tags...',
        ],
        
        'table' => [
            'name' => 'Name',
            'slug' => 'Slug',
            'posts' => 'Posts',
        ],
        
        'empty' => 'No tags found.',
        'confirm_delete' => 'Are you sure you want to delete this tag?',
    ],
    
    // ==========================================
    // SETTINGS
    // ==========================================
    'settings' => [
        'title' => 'Settings',
        'description' => 'Manage your application settings.',
        
        'nav' => [
            'general' => 'General',
            'business' => 'Business',
            'auth' => 'Authentication',
            'captcha' => 'Captcha',
            'cookie_consent' => 'Cookie Consent',
            'socials' => 'Social Links',
            'custom_tags' => 'Custom Tags',
            'notifications' => 'Notifications',
            'referral' => 'Referral Program',
        ],
        
        'sr' => [
            'select_section' => 'Select a section',
        ],
    ],

    // ==========================================
    // ADMIN NOTIFICATIONS
    // ==========================================
    'notifications' => [
        'order_created' => [
            'subject' => 'New Order Created',
            'greeting' => 'Hello Admin!',
            'line1' => 'A new order has been placed.',
            'user' => '• User: :value',
            'product' => '• Product: :value',
            'amount' => '• Amount: :value',
            'action' => 'View Order',
            'title' => 'New Order',
            'message' => ':user placed order for :product',
        ],
        'ticket_created' => [
            'subject' => 'New Support Ticket',
            'greeting' => 'Hello Admin!',
            'line1' => 'A new support ticket has been submitted.',
            'user' => '• User: :value',
            'subject_label' => '• Subject: :value',
            'priority' => '• Priority: :value',
            'action' => 'View Ticket',
            'title' => 'New Ticket',
            'message' => ':user created ticket: :subject',
        ],
        'user_registered' => [
            'subject' => 'New User Registered',
            'greeting' => 'Hello Admin!',
            'line1' => 'A new user has registered.',
            'name' => '• Name: :value',
            'email' => '• Email: :value',
            'action' => 'View User',
            'title' => 'New User',
            'message' => ':name (:email) has registered.',
        ],
        'withdrawal_created' => [
            'subject' => 'New Withdrawal Request',
            'greeting' => 'Hello Admin!',
            'line1' => 'A new withdrawal request has been submitted.',
            'user' => '• User: :value',
            'amount' => '• Amount: :value',
            'account' => '• Account: :value',
            'action' => 'Review Withdrawal',
            'line2' => 'Please review and process this request.',
            'title' => 'New Withdrawal Request',
            'message' => ':user requested withdrawal of :amount',
        ],
    ],
];

