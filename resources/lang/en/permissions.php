<?php

return [
    // ==========================================
    // PERMISSIONS
    // ==========================================
    'title' => 'Permissions',
    'description' => 'Manage granular permissions and assign them to roles.',
    'add' => 'Add Permission',
    'edit' => 'Edit Permission',
    'search' => 'Search permissions...',
    
    'table' => [
        'permission' => 'Permission',
        'guard' => 'Guard',
        'assigned_to' => 'Assigned To',
    ],
    
    'form' => [
        'name' => 'Permission Name',
        'guard_name' => 'Guard Name',
    ],
    
    'roles_count' => ':count roles',
    'empty' => 'No permissions found.',
    
    'messages' => [
        'created' => 'Permission created successfully.',
        'updated' => 'Permission updated successfully.',
        'deleted' => 'Permission deleted successfully.',
    ],
];
