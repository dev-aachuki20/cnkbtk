<?php

return [
    'home' => [
        'stats' => [
            'today' => '今天',
            'yesterday' => '昨天',
            'posts' => '帖子',
            'members' => '会员',
        ],
        'contact' => [
            'get_in_touch' => '保持联系',
            'contact_heading' => '您可以使用以下选项联系我们。',
            'field' => [
                'email_address' => '电子邮件地址',
                'subject' => '主题',
                'message' => '信息',
            ]
        ]
    ],

    'login' => [
        'form' => [
            'form_title' => "登入",
            'form_decription' => '欢迎来到 CNKBTK 资源中转站, 请在下面输入您的登录凭据以开始使用网络',

            'fields' => [
                'user' => '用户名/电子邮件地址',
                'password' => '密码'
            ],
        ],
    ],

    'sign_up' => [
        'form' => [
            'form_title' => '报名',
            'fields' => [
                'user_name' => '用户名',
                'email_address' => '电子邮件地址',
                'password' => '密码',
                'confirm_password' => '确认密码',
            ],
        ],
         'char_password' => '密码必须至少包含 1 个小写字母、1 个大写字母、1 个数字和 1 个特殊字符。',
    ],

    'forget_password' => [
        'forget_password_q' => '忘记密码？',
        'send_instruction' => "不用担心，我们会向您发送重置说明.",
        'reset_password' => '重设密码',
        'back_to_sign_in' => '返回登录',
        'form' => [
            'fields' => [
                'email_address' => '电子邮件地址',
            ],
        ]
    ],

    'reset_password' => [
        'reset_password' => '重设密码',
        'password_instruction' => '输入新密码，然后重复',
        'form' => [
            'fields' => [
                'email_address' => '电子邮件地址',
                'password' => '密码',
                'confirm_password' => '确认密码',
            ],
        ]
    ],

    'confirm_password' => [
        'confirm_password' => '确认密码',
        'confirm_password_instruction' => '请先确认您的密码，然后再继续.',
        'forgot_password' => '忘记密码了吗？',
        'form' => [
            'fields' => [
                'password' => '密码',
            ],
        ]
    ],

    'verify_page' => [
        'verify_your' => '验证您的',
        'email' => '电子邮件',
        'verify_your_email_address' => '确认你的邮件地址',
        'fresh_mail_sent' => '新的验证链接已发送到您的电子邮件地址.',
        'verification_link_sent' => '在继续之前，请检查您的电子邮件以获取验证链接',
        'not_recieve_mail' => '如果您没有收到电子邮件',
        'request_another_mail' => '单击此处请求再次发送',
    ],

    'post' => [
        'form' => [
            'fields' => [
                'title' => '标题',
                'parent_section' => '以及板块',
                'sub_section' => '二级板块',
                // 'child_section' => '儿童专区',
                'poster_cover_image' => '帖子封面图片',
                'tags' => '标签',
                'status' => '地位',
                'description' => '描述',
                'episode_title' => '剧集标题',
                'episode_cost' => '剧集费用',
                'episode_description' => '剧集描述',
                'allowed_file_type' => '（允许类型 jpg | png | jpeg | JPG | JPEG | PNG)',

            ],
            'delete_message' => '该记录一旦删除，将无法恢复。此外，与此帖子相关的所有剧集都将被删除',
            'add_episode' => '添加剧集',
        ],
    ],


    'post' => [
        'form' => [
            'fields' => [
                'title' => '标题',
                'parent_section' => '一级板块',
                'sub_section' => '二级板块',
                // 'child_section' => '儿童专区',
                'poster_cover_image' => '帖子封面图片',
                'tags' => '标签',
                'status' => '地位',
                'description' => '描述',
                'episode_title' => '剧集标题',
                'episode_cost' => '剧集费用',
                'episode_description' => '剧集描述',
                'allowed_file_type' => '（允许类型 jpg | png | jpeg | JPG | JPEG | PNG)',
            ],
            'add_episode' => '添加剧集',
        ],
    ],

    'section' => [
        'most_viewed' => '查看次数最多',
    ],

    'poster' => [
        'report' => '举报',
        'follow' => '关注',
        'following' => '正在关注',
        'episode_details' => '剧集详情'
    ],

    'selftopup' => [
        'self_service' => "自助充值",
        'top_up' => '充值',
        'product_name' => '产品名称',
        'points' => '积分',
        'order_amount' => '订单金额',
        'payment_method' => '付款方式',
        'need_to_pay' => '需要付费',
        'pay_immediately' => '立即付款'
    ],

    'user' => [
        "profile_tab" => [
            "profile" => "用户档案",
            "user_has_not_write_anything_yet" => "用户还没有写任何东西",
            "form" => [
                "field" => [
                    "user_name" => "用户名",
                    "email_address" => "电子邮件地址",
                    "profile_image" => "个人资料图片",
                    "about_your_self" => "关于你自己"
                ]
            ]
        ],

        "basic_infomation_tab" => [
            "basic_infomation" => "基本信息",
            'personal_information' => "个人信息",
            'personal_info_text' => "管理您的个人信息，包括可以联系您的电话号码和电子邮件地址.",
            "user_name" => "用户名",
            "uid" => "Uid",
            "email_status" => "电子邮件状态",
            "email_address" => "电子邮件地址",
            "active_profile" => "档案启用信息",
            "registration_time" => "注册时间",
            "registration_ip" => "注册IP地址",
            "last_visited_ip" => "最后访问的IP地址",
            "statistics" => "统计数据",
            "points" => "积分"
        ],

        "change_password_tab" => [
            "change_password" => "更改密码",
            "old_password" => "旧密码",
            "new_password" => "新密码",
            "confirm_password" => "确认密码",


        ],

        "credit_history_tab" => [
            "credit_history" => "信用记录",
            "points_record" => "积分记录",
            "serial_number" => "序列号",
            "type" => "类型",
            "points" => "积分",
            "date_time" => "日期和时间",
            "Transection_not_find" => "找不到转账记录"
        ],

        "post_history_tab" => [
            "post" => "邮政",
            "history" => "历史",
            "post_history" => "帖子历史",
            "posters_not_available" => "海报不可用",
        ],

        "blacklist_user_tab" => [
            "blacklist" => "黑名单",
            "user" => "用户",
            "blacklist_users" => "黑名单用户",
            "users_not_available" => "黑名单用户不可用",
        ]


    ],

    'site_statistics' => [
        'basic' => "基本的",
        'profile' => '个人档案',
        'site' => '网站统计'
    ],

    'blacklist_user' => [
        'button_one' => 'Excel 文件示例',
        'button_two' => '导入Excel',
        'add' => '添加黑名单用户',
        'edit' => '编辑黑名单用户',
        'form' => [
            'fields' => [
                'email' => '电子邮件',
                'ip_address' => 'IP地址',
                'reason' => '原因',
                'username' => '用户名',
            ],
        ],
    ],


];