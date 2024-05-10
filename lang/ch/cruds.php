<?php

return [
    'profile' => [
        'title'                     => '型材',
        'title_singular'            => '轮廓',
        'fields' => [
            'user_name' => '用户名',
            'email' => '电子邮件',
            'profile_image' => '个人资料图片',
            'role' => '角色',
        ]
    ],

    'change_password' => [
        'title'                     => '更改密码',
        'title_singular'            => '更改密码',
        'fields' => [
            'old_password' => '旧密码',
            'password' => '密码',
            'confirm_password' => '确认密码',
        ]
    ],
    //Email Template Cruds
    'email_template'  => [
        'title'                     => '电子邮件模板',
        'title_singular'            => '电子邮件模板',
        'fields' => [
            'id' =>  'ID',
            'name' => "姓名",
            'subject' => "主題",
            'email_body' => "電子郵件正文",
            'short_codes' => "短代碼",
        ]
    ],
    //User Crud
    'user'  => [
        'title'                     => '用户',
        'title_singular'            => '用户',
        'fields' => [
            'id' =>  'ID',
            'user_name' => "用户名",
            'profile_image' => "个人资料图片",
            'role' => "角色",
            'email' => '电子邮件',
            'image' => "图像"
        ]
    ],

    'setting'  => [
        'title'                     => '设置',
        'title_singular'            => '环境',
        'basic_details'             => '基本信息',
        'footer'                    => '页脚',
        'social_links'              => "社交链接"

    ],

    // Sections Crud
    'section_management'  => [
        'title'                     => '部门管理',
        'title_singular'            => '科室管理',
        // Parent Section
        'parent_section' => [
            'title'              => '家长部分',
            'title_singular'     => '家长部分',
            'fields' => [
                'id' =>  'ID',
                'title' => "标题",
                'description' => '描述',
                'creator_can_post' => '创建者可以发布',
                'user_can_post' => '用户可以发帖',
                'show_in_header' => '在标题中显示',
                'show_in_footer' => '在页脚中显示',
                'position' => '位置'
            ],
            'delete_message' => '如果您删除父部分，则所有子部分和子部分都将与其海报一起删除'
        ],
        // Sub Section 
        'sub_section' => [
            'title'              => '子部分',
            'title_singular'     => '子部分',
            'fields' => [
                'id' =>  'ID',
                'title' => "标题",
                'description' => '描述',
                'creator_can_post' => '创建者可以发布',
                'user_can_post' => '用户可以发帖',
                'show_in_header' => '在标题中显示',
                'show_in_footer' => '在页脚中显示',
                'position' => '位置',
                'parent_section' => "家长部分",
                'section_logo' => "部分标志",
            ],
            'delete_message' => '如果您删除子部分，则所有子部分都将与其海报一起删除'
        ],

        // //Child Section 
        // 'child_section' => [
        //     'title'              => '子部分',
        //     'title_singular'     => '儿童科',
        //     'fields' => [
        //         'id' =>  'ID',
        //         'title' => "标题",
        //         'description' => '描述',
        //         'creator_can_post' => '创建者可以发布',
        //         'user_can_post' => '用户可以发帖',
        //         'show_in_header' => '在标题中显示',
        //         'show_in_footer' => '在页脚中显示',
        //         'position' => '位置',
        //         'parent_section' => "家长部分",
        //         'section_logo' => "部分标志",
        //         'sub_section' => "子部分",
        //     ],
        //     'delete_message' => 'If you delete child section all the posters will delete.'
        // ]

    ],
    // Tag Type and Tag Cruds
    'tag_management'  => [
        'title'                     => '标签管理',
        'title_singular'            => '标签管理',
        //Tag Type Cruds
        'tag_type' => [
            'title'              => '标签类型',
            'title_singular'     => '标签类型',
            'fields' => [
                'id' =>  'ID',
                'title' => "标题",
            ],
            'delete_message' => '如果删除，则该标签类型的所有标签都会被删除'
        ],
        //Tags Cruds
        'tag' => [
            'title'              => '标签',
            'title_singular'     => '标签',
            'fields' => [
                'id' =>  'ID',
                'title' => "标题",
                'tag_type' => "标签类型",
            ]
        ],



    ],
    //Advertisement Cruds
    'advertisement' => [
        'title'              => '广告',
        'title_singular'     => '广告',
        'fields' => [
            'id' =>  'ID',
            'image' => "图像",
            'advertisement_type' => '广告类型',
            'url' => '网址',
        ]
    ],
    //Post management Cruds
    'post_management' => [
        'title'                     => '海报管理',
        'title_singular'            => '海报管理',

    ],

    'plan' => [
        'title'                     => '计划管理',
        'title_singular'            => '计划管理',
        'module' => '计划',
        'fields' => [
            'id' =>  'ID',
            'title' => '标题',
            'amount' => '数量',
            'points' => '积分',
        ]

    ],

    'enquiries' => [
        'title' => '查询',
        'title_singular' => '询问',
        'fields' => [
            'id' =>  'ID',
            'email' => '电子邮件',
            'subject' => '主题',
            'message' => '信息',
        ]
    ],

    'reports' => [
        'title' => '报告',
        'title_singular' => '报告',
        'fields' => [
            'id' =>  'ID',
            'reason' => '原因',
            'description' => '描述',
            'username' => '用户名',
            'poster' => '海报'
        ]
    ],

    'point' => [
        'title' => '积分',
        'title_singular' => '观点'
    ],



    //  Global
    'global' => [
        'status' => '地位',
        'created_date' => '创建日期',
        'updated_date' => '更新日期',
        'add' => '添加',
        'view' => '看法',
        'delete' =>  '删除',
        'edit' => '编辑',
        'action' => '行动',
        'active' => '积极的',
        'in_active' => '不活跃',
        'short_code' => '短代码',
        'description' => '描述',
        'details' => '细节',
        'enter' => '进入',
        'copy' => '复制',
        'save' => '节省',
        'update' => '更新',
        'cancel' => '取消',
        'delete_btn_text' => '是的，删除它！',
        'cancel_delete_btn_text' => '不行，取消！',
        'no' => '不',
        'yes' => '是的',
        'select' => "选择",
        'choose_file' => '选择文件',
        'allowed_file_type' => '（允许类型 jpg | png | jpeg | JPG | JPEG | PNG)',
        'allowed_file_type_png' => '（允许类型 png | PNG)',
        'na' => "无法使用",
        'purchase' => "购买",
        'apply' => '申請',
        'message' => '信息',
    ],

    'lang' => [
        'english' => "英语",
        'chinese' => "中国人",
    ],

    'statistics' => [
        'title' => '網站統計',
        'statistics_filteration' => [
            'title' => '選擇過濾器：',
            'daterange_title' => '選擇日期範圍：',
            'tag_type_title'    => '选择标签类型：',
            'day' => "天空",
            'week' => "星期",
            'month' => "月",
            'custom_range'      => "定制范围",
        ]
    ],

    'registered_members' => [
        'title'                     => '註冊會員',
        'title_singular'            => '註冊會員',
        'fields' => [
            'num_graph' => '會員註冊圖',
            'time'      => '會員註冊時間',
            'count'     => '會員數量',
            'graph'     => '會員圖',
        ]
    ],

    'number_of_posts' => [
        'title'            => '貼文數量',
        'title_singular'   => '貼文數量',
        'fields' => [
            'num_graph'    => '帖子数量图',
            'time'         => '帖子数量 时间',
            'count'        => '帖子数',
            'graph'        => '帖子图',
        ]
    ],

    'most_popular_poster' => [
        'title'             => '最受歡迎的海報',
        'title_singular'    => '最受歡迎海報',
        'fields' => [
            'num_graph'     => '最受欢迎的海报图',
            'time'          => '熱門海報時間',
            'count'         => '熱門海報數量',
            'graph'         => '熱門海報圖',
        ]
    ],

    'visiting_users' => [
        'title'             => '來訪用戶',
        'title_singular'    => '來訪用戶',
        'fields' => [
            'num_graph'     => '訪問用戶圖',
            'time'          => '參觀時間',
            'count'         => '訪問用戶數',
            'graph'         => '訪問圖',
        ]
    ],

    'mobile_access' => [
        'title'             => '移動訪問',
        'title_singular'    => '移動訪問',
        'fields' => [
            'num_graph'     => '行動訪問用戶圖',
            'time'          => '移動訪問時間',
            'count'         => '移動訪問計數',
            'graph'         => '移動訪問圖',
        ]
    ],

    'blacklist_tag' => [
        'title'              => '黑名单标签',
        'title_singular'     => '黑名单标签',
        'fields' => [
            'id' =>  'ID',
            'title' => "标题",
        ]
    ],

    'create_project' => [
        'title'    => '創建專案',
        'home'     => '家',
        'create'    => '創造',
        'project'  => '專案',
        'projects'  => '项目',
        'project_details'  => '项目详情',
        'post'  => '郵政',
        'list' => '列表',
        'request' => '要求',
        'fields' => [
            'type'     => '類型',
            'tags'          => '標籤',
            'creators'         => '創作者',
            'budget'         => '預算',
            'description'         => '描述',
            'user_name'         => '用户名',
            'user_ip'         => 'IP地址',
            'copyright'         => '版權',
            'placeholder'         => '輸入預算',
            'text'         => '勾選此方塊即表示您同意遵守我們的版權政策。',
            'selected' => [
                'type' => '選擇類型',
                'tags' => '選擇標籤',
                'creator' => '選擇創作者',
            ],
            'creator_name' => '创建者姓名',
            'status' => [
                'locked' => '锁定',
                'unlocked' => '解锁',
            ]
        ],
        'headings' => [
            'cancelled_project'     => '取消的项目',
            'cancel_project'        => '取消项目',
            'confirmed_project'         => '已确认项目',
            'confirm_project'        => '确认项目',
            'bid_added'        => '项目投标已添加',
            'add_bid'        => '添加您的出价',
            'add_bid_form'        => '添加投标表格',

        ],
    ],

    'project' => [
        'project_type' => [
            'pictures'  => '图片',
            'video'     => '视频',
            'novel'     => '小说',
            'tutorial'  => '教程',
        ]
    ]

];
