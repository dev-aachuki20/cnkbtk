<?php

return [
    'profile' => [
        'title'                     => '简介',
        'title_singular'            => '简介',
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
            'email_body' => "电子邮件正文",
            'short_codes' => "短代码",
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
        'title'                     => '板块管理',
        'title_singular'            => '板块管理',
        // Parent Section
        'parent_section' => [
            'title'              => '一级板块',
            'title_singular'     => '一级板块',
            'fields' => [
                'id' =>  'ID',
                'title' => "标题",
                'description' => '描述',
                'creator_can_post' => '制作组可以发布',
                'user_can_post' => '用户可以发帖',
                'show_in_header' => '在标题中显示',
                'show_in_footer' => '在页脚中显示',
                'position' => '位置'
            ],
            'delete_message' => '如果您删除一级板块，则所有二级板块都将与其帖子一起删除'
        ],
        // Sub Section 
        'sub_section' => [
            'title'              => '二级板块',
            'title_singular'     => '二级板块',
            'fields' => [
                'id' =>  'ID',
                'title' => "标题",
                'description' => '描述',
                'creator_can_post' => '制作组可以发布',
                'user_can_post' => '用户可以发帖',
                'show_in_header' => '在标题中显示',
                'show_in_footer' => '在页脚中显示',
                'position' => '位置',
                'parent_section' => "一级板块",
                'section_logo' => "板块标志",
            ],
            'delete_message' => '如果您删除二级板块，则所有二级板块都将与其帖子一起删除'
        ],

        //Child Section 
        'child_section' => [
            'title'              => '子部分',
            'title_singular'     => '儿童科',
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
                'sub_section' => "子部分",
            ],
            'delete_message' => 'If you delete child section all the posters will delete.'
        ]

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
        'title'                     => '帖子管理',
        'title_singular'            => '帖子管理',

    ],

    'plan' => [
        'title'                     => '充值选项管理',
        'title_singular'            => '充值选项管理',
        'module' => '充值选项',
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
            'message' => '内容',
        ]
    ],

    'reports' => [
        'title' => '举报',
        'title_singular' => '举报',
        'fields' => [
            'id' =>  'ID',
            'reason' => '原因',
            'description' => '描述',
            'username' => '用户名',
            'poster' => '帖子'
        ]
    ],

    'point' => [
        'title' => '积分',
        'title_singular' => '积分'
    ],



    //  Global
    'global' => [
        'status' => '状态',
        'created_date' => '创建日期',
        'updated_date' => '更新日期',
        'add' => '添加',
        'view' => '看法',
        'delete' =>  '删除',
        'edit' => '编辑',
        'action' => '行动',
        'active' => '启用',
        'in_active' => '不启用',
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
        'apply' => '应用',
        'message' => '信息',
        'read_chat' => '阅读聊天',
        'average' => '平均的',
        'finish' =>'结束',
        'finished' => '完成的',
        'submit' =>'提交',
        'close' =>'关闭',
        'total' => '全部的',
        'count' => '数数',
        'other' => '其他',
        'user_chat' => '用户',
        'assign' => '分配',
        'rating' => '评分',
        'assigned' => '已分配',
        'confirmed' => '确认的',
        'readmore' => '阅读更多',
        'search_by_project_title' => '按标题搜索',
    ],

    'lang' => [
        'english' => "英语",
        'chinese' => "简体中文",
    ],

    'statistics' => [
        'title' => '网站统计',
        'statistics_filteration' => [
            'title' => '选择过滤器：',
            'daterange_title' => '选择日期范围：',
            'tag_type_title'    => '选择标签类型：',
            'day' => "天",
            'week' => "星期",
            'month' => "月",
            'custom_range'      => "自选范围",
            'all'      => "全部",
            'purchased'      => "已购买",
            'visited'      => "访问过",
            'filter'      => "筛选",
        ]
    ],

    'registered_members' => [
        'title'                     => '注册会员',
        'title_singular'            => '注册会员',
        'fields' => [
            'num_graph' => '会员注册图',
            'time'      => '时间',
            'count'     => '数量',
            'graph'     => '会员图',
        ]
    ],

    'number_of_posts' => [
        'title'            => '帖子数量',
        'title_singular'   => '帖子数量',
        'fields' => [
            'num_graph'    => '帖子数量图',
            'time'         => '时间',
            'count'        => '数量',
            'graph'        => '帖子图',
        ]
    ],

    'most_popular_poster' => [
        'title'             => '最受欢迎的标签',
        'title_singular'    => '最受欢迎的标签',
        'fields' => [
            'num_graph'     => '最受欢迎的标签图',
            'time'          => '时间',
            'count'         => '数量',
            'graph'         => '最受欢迎的标签图',
        ]
    ],

    'visiting_users' => [
        'title'             => '来访用户',
        'title_singular'    => '来访用户',
        'fields' => [
            'num_graph'     => '访问用户图',
            'time'          => '时间',
            'count'         => '数量',
            'graph'         => '访问用户图',
        ]
    ],

    'mobile_access' => [
        'title'             => '移动端访问',
        'title_singular'    => '移动端访问',
        'fields' => [
            'num_graph'     => '移动端访问图',
            'time'          => '时间',
            'count'         => '数量',
            'graph'         => '移动端访问图',
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
        'title'    => '创建项目',
        'home'     => '主页',
        'create'    => '创建',
        'project'  => '项目',
        'projects'  => '项目',
        'project_details'  => '项目详情',
        'detail' => '细节',
        'post'  => '发布',
        'list' => '列表',
        'list_title' => '列表',
        'request' => '要求',
        'fields' => [
            'title'     => '标题',
            'type'     => '类型',
            'tags'          => '标签',
            'creators'         => '制作组',
            'budget'         => '预算',
            'description'         => '描述',
            'user_name'         => '用户名',
            'user_ip'         => 'IP地址',
            'copyright'         => '版权',
            'placeholder'         => '输入预算',
            'text'         => '勾选此方块即表示您同意遵守我们的板块政策。',
            'selected' => [
                'type' => '选择类型',
                'tags' => '选择标签',
                'creator' => '选择制作组',
            ],
            'creator_name' => '创建者姓名',
            'project_request' => '项目确认请求',
            'status' => [
                'locked' => '锁定',
                'unlocked' => '解锁',
            ],
            'user_rating' =>  'User Rating',
            'creator_rating' => 'Creator Rating',
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
    ],

    'status' => [
        'active' => '积极的',
        'inactive' => '不活跃'
    ],

    'finished_project' => [
        'title' => '完成项目',
        'title_singular' => '完成项目',
        'options' => [
            'add_remark' => '添加备注',
            'finish_btn_text' => '是的，完成了！',
        ],
        'fields' => [
            'remark' => '评论',
        ],
    ]

];
