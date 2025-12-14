<?php

return [
    // ==========================================
    // USER-FACING TICKETS
    // ==========================================
    'title' => 'My Tickets',
    'subtitle' => 'View and manage your support requests',
    'new_ticket' => 'New Ticket',
    
    'filter' => [
        'all_status' => 'All Status',
    ],
    
    'status' => [
        'open' => 'Open',
        'in_progress' => 'In Progress',
        'waiting' => 'Waiting',
        'resolved' => 'Resolved',
        'closed' => 'Closed',
    ],
    
    'priority' => [
        'low' => 'Low',
        'normal' => 'Normal',
        'high' => 'High',
        'urgent' => 'Urgent',
    ],
    
    'category' => [
        'general' => 'General',
        'billing' => 'Billing',
        'technical' => 'Technical',
        'other' => 'Other',
    ],
    
    'empty' => [
        'title' => 'No tickets',
        'description' => 'Create a new ticket to get support.',
    ],
    
    // Create Ticket
    'create' => [
        'back' => 'Back to Tickets',
        'title' => 'Create Support Ticket',
        'subject' => 'Subject',
        'subject_placeholder' => 'Brief description of your issue',
        'category' => 'Category',
        'priority' => 'Priority',
        'description' => 'Description',
        'description_placeholder' => 'Please describe your issue in detail...',
        'attachments' => 'Attachments',
        'attachments_hint' => 'Click to upload files',
        'attachments_note' => 'Max 5 files. Accepted: JPG, PNG, GIF, PDF, DOC, TXT (max 5MB each)',
        'submit' => 'Submit Ticket',
        'submitting' => 'Submitting...',
    ],
    
    // Show Ticket
    'show' => [
        'back' => 'Back to Tickets',
        'ticket_number' => 'Ticket #:number',
        'created' => 'Created :date',
        'conversation' => 'Conversation',
        'waiting_response' => 'Waiting for staff response...',
        'ticket_closed' => 'This ticket is closed.',
        'reply_placeholder' => 'Type your reply...',
        'send_reply' => 'Send Reply',
        'support_team' => 'Support Team',
        'you' => 'You',
        'attachments' => 'Attachments',
    ],
    
    // Messages
    'messages' => [
        'created' => 'Ticket created successfully.',
        'replied' => 'Reply sent.',
        'closed' => 'Ticket closed.',
        'reopened' => 'Ticket reopened.',
    ],

    // ==========================================
    // NOTIFICATIONS
    // ==========================================
    'notifications' => [
        'created' => [
            'subject' => '[:app] Ticket Created #:ticket_id',
            'greeting' => 'Hello :name!',
            'line1' => 'Your support ticket has been created successfully.',
            'ticket_id' => '• Ticket ID: :value',
            'subject_label' => '• Subject: :value',
            'priority' => '• Priority: :value',
            'action' => 'View Ticket',
            'line2' => 'Our support team will respond as soon as possible.',
            'title' => 'Ticket Created',
            'message' => 'Your ticket #:ticket_id has been created.',
        ],
        'replied' => [
            'subject' => '[:app] New Reply on Ticket #:ticket_id',
            'greeting' => 'Hello :name!',
            'line1' => 'There is a new reply on your support ticket.',
            'ticket_id' => '• Ticket ID: :value',
            'action' => 'View Reply',
            'title' => 'Ticket Replied',
            'message' => 'Your ticket #:ticket_id has a new reply.',
        ],
        'closed' => [
            'subject' => '[:app] Ticket Closed #:ticket_id',
            'greeting' => 'Hello :name!',
            'line1' => 'Your support ticket has been closed.',
            'ticket_id' => '• Ticket ID: :value',
            'action' => 'View Ticket',
            'line2' => 'If you need further assistance, you can reopen this ticket or create a new one.',
            'title' => 'Ticket Closed',
            'message' => 'Your ticket #:ticket_id has been closed.',
        ],
    ],
];
