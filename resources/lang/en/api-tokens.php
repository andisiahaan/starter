<?php

return [
    // ==========================================
    // API TOKENS
    // ==========================================
    'title' => 'API Tokens',
    'subtitle' => 'Manage your API access tokens for integrations',
    'create_token' => 'Create Token',
    
    'table' => [
        'name' => 'Name',
        'abilities' => 'Abilities',
        'last_used' => 'Last Used',
        'created' => 'Created',
        'never' => 'Never',
        'revoke' => 'Revoke',
    ],
    
    'empty' => [
        'title' => 'No tokens',
        'description' => 'Create an API token to integrate with external services.',
    ],
    
    'docs' => [
        'title' => 'API Documentation',
        'description' => 'Include your token in API requests using the :header header:',
        'view_docs' => 'View Docs',
    ],
    
    // Modals
    'modals' => [
        'create' => [
            'title' => 'Create API Token',
            'name' => 'Token Name',
            'name_placeholder' => 'e.g. My Integration',
            'abilities' => 'Abilities',
            'expiration' => 'Expiration',
            'expiration_help' => 'When should this token expire?',
            'cancel' => 'Cancel',
            'create' => 'Create Token',
            'creating' => 'Creating...',
        ],
        'show' => [
            'title' => 'Token Created Successfully!',
            'subtitle' => "Copy your token now. It won't be shown again.",
            'copy' => 'Copy',
            'copied' => 'Copied!',
            'warning_title' => 'Keep this token safe!',
            'warning_message' => "Store it securely. You won't be able to see it again after closing this dialog.",
            'done' => 'Done',
        ],
        'revoke' => [
            'title' => 'Revoke Token',
            'subtitle' => 'This action cannot be undone.',
            'confirm' => 'Are you sure you want to revoke the token ":name"?',
            'warning' => 'Any integrations using this token will immediately stop working.',
            'cancel' => 'Cancel',
            'revoke' => 'Revoke Token',
            'revoking' => 'Revoking...',
        ],
    ],
    
    'messages' => [
        'created' => 'API token created successfully.',
        'revoked' => 'API token revoked.',
    ],

    'token_created' => [
        'title' => 'Token Created Successfully!',
        'warning' => 'Copy your token now. It won\'t be shown again after you leave this page.',
    ],
];
