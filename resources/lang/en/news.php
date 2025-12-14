<?php

return [
    // ==========================================
    // NEWS & ANNOUNCEMENTS
    // ==========================================
    'title' => 'News & Announcements',
    'subtitle' => 'Stay updated with platform news and updates',
    
    'filter' => [
        'all_types' => 'All Types',
    ],
    
    'types' => [
        'news' => 'News',
        'announcement' => 'Announcement',
        'update' => 'Update',
        'maintenance' => 'Maintenance',
        'warning' => 'Warning',
        'info' => 'Info',
        'information' => 'Information',
    ],
    
    'empty' => [
        'title' => 'No news',
        'description' => 'Check back later for updates.',
    ],
    
    'show' => [
        'back' => 'Back to News',
        'published' => 'Published :date',
        'by' => 'By :author',
    ],
    
    'form' => [
        'content' => 'Content',
        'publish_at' => 'Publish At',
        'expires_at' => 'Expires At',
        'pinned' => 'Pinned',
    ],

    // ==========================================
    // NOTIFICATIONS
    // ==========================================
    'notifications' => [
        'published' => [
            'subject' => '[:app] :title',
            'greeting' => 'Hello :name!',
            'line1' => 'A new article has been published.',
            'action' => 'Read Article',
            'title' => 'New Article',
            'message' => ':title',
        ],
    ],
];
