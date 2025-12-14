<?php

return [
    // ==========================================
    // FRONTEND - PUBLIC
    // ==========================================
    'title' => 'Help Center',
    'subtitle' => 'Find answers to your questions and get the help you need',
    'search_placeholder' => 'Search for articles...',
    'search_results' => 'Search results for ":query"',
    'results' => 'results',
    'no_results' => 'No articles found matching your search.',
    
    'browse_categories' => 'Browse by Category',
    'popular_articles' => 'Popular Articles',
    'other_categories' => 'Other Categories',
    'related_articles' => 'Related Articles',
    'articles' => 'articles',
    
    'reading_time' => ':count min read',
    'views' => 'views',
    'no_articles_in_category' => 'No articles in this category yet.',
    
    'back_to_category' => 'Back to :category',
    'was_helpful' => 'Was this article helpful?',
    'feedback_thanks' => 'Thank you for your feedback!',
    'yes' => 'Yes',
    'no' => 'No',
    
    'still_need_help' => 'Still need help?',
    'need_more_help' => 'Need more help?',
    'contact_support_text' => 'Our support team is here to assist you.',
    'contact_support' => 'Contact Support',

    // ==========================================
    // ADMIN PANEL
    // ==========================================
    'admin' => [
        // Categories
        'categories' => [
            'title' => 'Help Categories',
            'description' => 'Manage help center categories and their organization.',
            'add' => 'Add Category',
            'edit' => 'Edit Category',
            'empty' => 'No categories found.',
            
            'table' => [
                'name' => 'Name',
                'slug' => 'Slug',
                'articles' => 'Articles',
                'status' => 'Status',
                'order' => 'Order',
            ],
            
            'filters' => [
                'search' => 'Search categories...',
                'all_status' => 'All Status',
            ],
            
            'form' => [
                'name' => 'Name',
                'name_placeholder' => 'e.g. Getting Started',
                'slug' => 'Slug',
                'slug_placeholder' => 'getting-started',
                'icon' => 'Icon (Emoji or SVG)',
                'icon_placeholder' => '🚀',
                'description' => 'Description',
                'description_placeholder' => 'Brief description of this category...',
                'order' => 'Order',
                'active' => 'Active',
            ],
            
            'modals' => [
                'create' => [
                    'title' => 'Create Category',
                    'cancel' => 'Cancel',
                    'create' => 'Create',
                    'update' => 'Update',
                    'saving' => 'Saving...',
                ],
                'edit' => [
                    'title' => 'Edit Category',
                ],
                'delete' => [
                    'title' => 'Delete Category',
                    'confirm' => 'Are you sure you want to delete this category?',
                    'warning' => 'All articles in this category will also be deleted. This action cannot be undone.',
                    'cancel' => 'Cancel',
                    'submit' => 'Delete Category',
                    'deleting' => 'Deleting...',
                ],
            ],
            
            'messages' => [
                'created' => 'Category created successfully.',
                'updated' => 'Category updated successfully.',
                'deleted' => 'Category deleted successfully.',
            ],
            
            'confirm_delete' => 'Are you sure you want to delete this category? All articles will also be deleted.',
        ],
        
        // Articles
        'articles' => [
            'title' => 'Help Articles',
            'description' => 'Manage help center articles and content.',
            'add' => 'Add Article',
            'create' => 'Create Article',
            'edit' => 'Edit Article',
            'new' => 'New Article',
            'empty' => 'No articles found.',
            'create_first' => 'Create your first article',
            
            'table' => [
                'article' => 'Article',
                'category' => 'Category',
                'views' => 'Views',
                'status' => 'Status',
                'published' => 'Published',
            ],
            
            'filters' => [
                'search' => 'Search articles...',
                'all_categories' => 'All Categories',
                'all_status' => 'All Status',
            ],
            
            'status' => [
                'published' => 'Published',
                'draft' => 'Draft',
                'scheduled' => 'Scheduled',
            ],
            
            'form' => [
                'title' => 'Title',
                'title_placeholder' => 'Article title...',
                'slug' => 'Slug',
                'slug_placeholder' => 'article-url-slug',
                'category' => 'Category',
                'select_category' => 'Select a category',
                'content' => 'Content',
                'content_placeholder' => 'Write your article content here...',
                'published_at' => 'Publish Date',
                'order' => 'Order',
                'active' => 'Active',
                
                'seo' => 'SEO Settings',
                'meta_title' => 'Meta Title',
                'meta_title_placeholder' => 'SEO title (max 70 chars)',
                'meta_description' => 'Meta Description',
                'meta_description_placeholder' => 'SEO description (max 160 chars)',
            ],
            
            'messages' => [
                'created' => 'Article created successfully.',
                'updated' => 'Article updated successfully.',
                'deleted' => 'Article deleted successfully.',
            ],
            
            'confirm_delete' => 'Are you sure you want to delete this article?',
        ],
    ],
];
