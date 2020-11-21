<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'sales' => 'c,r,u,d',
            'profile' => 'r,u',
            'reports' => 'c,r,u,d',
            'settings' => 'c,r,u,d',
            'inventory' => 'c,r,u,d',
            'purchase' => 'c,r,u,d',
            'setting'=>'c,r,u'
        ],
        'cashier' => [
            'sales' => 'c',
            'profile' => 'r,u',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
