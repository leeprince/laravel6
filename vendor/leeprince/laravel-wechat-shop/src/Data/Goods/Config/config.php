<?php
return [
    /** 配置数据库连接 */
    'database' => [
        'connection' => [
            'default' => env('DB_CONNECTION', 'mysql'),
            // 默认连接的配置项合并到自定义的配置连接中，再用自定义的配置覆盖默认连接的配置项
            'customer' => 'member'
        ],
        'member' => [
            'prefix'  => 'admin_'
        ]
    ],
];
