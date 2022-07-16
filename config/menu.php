<?php

return [
    'user' => [
        [
            'title' => 'Edit profile',
            'route_name' => 'users.edit-profile',
            'route_data' => [],
            'table' => 'users*',
        ],
        [
            'title' => 'Change password',
            'route_name' => 'change.password',
            'route_data' => [],       
        ],
        [
            'title' => 'Activity',
            'route_name' => 'users.activity',
            'route_data' => [],       
        ]
    ],
    'admin' => [
        [
            'icon' => '<i class="fe-pie-chart"></i>',
            'title' => 'Bảng điều khiển',
            'route' => 'admin.dashboards.index',
        ],
        // [
        //     'icon' => '<i class="fe-bell"></i>',
        //     'title' => 'Thông báo',
        //     'permissions' => ['setting'],
        //     'route' => 'admin.notifications.index',
        // ],
        [
            'icon' => '<i class="fe-users"></i>',
            'title' => 'Người dùng',
            'childs' => [
                [
                    'title' => 'Danh sách',
                    'route' => 'admin.users.index',
                ],
            ],
        ],
        [
            'icon' => '<i class="fas fa-question"></i>',
            'title' => 'Câu hỏi',
            'childs' => [
                [
                    'title' => 'Danh sách',
                    'route' => 'admin.posts.index',
                ],
            ],
        ],
    ],
];