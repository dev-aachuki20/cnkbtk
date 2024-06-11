<?php

return [
    'home' => [
        'stats' => [
            'today' => '����',
            'yesterday' => '����',
            'posts' => '����',
            'members' => '��Ա',
        ],
        'contact' => [
            'get_in_touch' => '������ϵ',
            'contact_heading' => '������ʹ������ѡ����ϵ���ǡ�',
            'field' => [
                'email_address' => '�����ʼ���ַ',
                'subject' => '����',
                'message' => '��Ϣ',
            ]
        ]
    ],

    'login' => [
        'form' => [
            'form_title' => "����",
            'form_decription' => '��ӭ���� CNKBTK ��Դ��תվ, ���������������ĵ�¼ƾ���Կ�ʼʹ������',

            'fields' => [
                'user' => '�û���/�����ʼ���ַ',
                'password' => '����'
            ],
        ],
    ],

    'sign_up' => [
        'form' => [
            'form_title' => '����',
            'fields' => [
                'user_name' => '�û���',
                'email_address' => '�����ʼ���ַ',
                'password' => '����',
                'confirm_password' => 'ȷ������',
            ],
        ],
        'char_password' => '密码必须至少包含 1 个小写字母、1 个大写字母、1 个数字和 1 个特殊字符。',

    ],

    'forget_password' => [
        'forget_password_q' => '�������룿',
        'send_instruction' => "���õ��ģ����ǻ�������������˵��.",
        'reset_password' => '��������',
        'back_to_sign_in' => '���ص�¼',
        'form' => [
            'fields' => [
                'email_address' => '�����ʼ���ַ',
            ],
        ]
    ],

    'reset_password' => [
        'reset_password' => '��������',
        'password_instruction' => '���������룬Ȼ���ظ�',
        'form' => [
            'fields' => [
                'email_address' => '�����ʼ���ַ',
                'password' => '����',
                'confirm_password' => 'ȷ������',
            ],
        ]
    ],

    'confirm_password' => [
        'confirm_password' => 'ȷ������',
        'confirm_password_instruction' => '����ȷ���������룬Ȼ���ټ���.',
        'forgot_password' => '������������',
        'form' => [
            'fields' => [
                'password' => '����',
            ],
        ]
    ],

    'verify_page' => [
        'verify_your' => '��֤����',
        'email' => '�����ʼ�',
        'verify_your_email_address' => 'ȷ������ʼ���ַ',
        'fresh_mail_sent' => '�µ���֤�����ѷ��͵����ĵ����ʼ���ַ.',
        'verification_link_sent' => '�ڼ���֮ǰ���������ĵ����ʼ��Ի�ȡ��֤����',
        'not_recieve_mail' => '�����û���յ������ʼ�',
        'request_another_mail' => '�����˴������ٴη���',
    ],

    'post' => [
        'form' => [
            'fields' => [
                'title' => '����',
                'parent_section' => '�Լ����',
                'sub_section' => '�������',
                // 'child_section' => '��ͯר��',
                'poster_cover_image' => '���ӷ���ͼƬ',
                'tags' => '��ǩ',
                'status' => '��λ',
                'description' => '����',
                'episode_title' => '�缯����',
                'episode_cost' => '�缯����',
                'episode_description' => '�缯����',
                'allowed_file_type' => '���������� jpg | png | jpeg | JPG | JPEG | PNG)',

            ],
            'delete_message' => '�ü�¼һ��ɾ�������޷��ָ������⣬���������ص����о缯������ɾ��',
            'add_episode' => '���Ӿ缯',
        ],
    ],


    'post' => [
        'form' => [
            'fields' => [
                'title' => '����',
                'parent_section' => 'һ�����',
                'sub_section' => '�������',
                // 'child_section' => '��ͯר��',
                'poster_cover_image' => '���ӷ���ͼƬ',
                'tags' => '��ǩ',
                'status' => '��λ',
                'description' => '����',
                'episode_title' => '�缯����',
                'episode_cost' => '�缯����',
                'episode_description' => '�缯����',
                'allowed_file_type' => '���������� jpg | png | jpeg | JPG | JPEG | PNG)',
            ],
            'add_episode' => '���Ӿ缯',
        ],
    ],

    'section' => [
        'most_viewed' => '�鿴�������',
    ],

    'poster' => [
        'report' => '�ٱ�',
        'follow' => '��ע',
        'following' => '���ڹ�ע',
        'episode_details' => '�缯����'
    ],

    'selftopup' => [
        'self_service' => "������ֵ",
        'top_up' => '��ֵ',
        'product_name' => '��Ʒ����',
        'points' => '����',
        'order_amount' => '�������',
        'payment_method' => '���ʽ',
        'need_to_pay' => '��Ҫ����',
        'pay_immediately' => '��������'
    ],

    'user' => [
        "profile_tab" => [
            "profile" => "�û�����",
            "user_has_not_write_anything_yet" => "�û���û��д�κζ���",
            "form" => [
                "field" => [
                    "user_name" => "�û���",
                    "email_address" => "�����ʼ���ַ",
                    "profile_image" => "��������ͼƬ",
                    "about_your_self" => "�������Լ�"
                ]
            ]
        ],

        "basic_infomation_tab" => [
            "basic_infomation" => "������Ϣ",
            'personal_information' => "������Ϣ",
            'personal_info_text' => "�������ĸ�����Ϣ������������ϵ���ĵ绰����͵����ʼ���ַ.",
            "user_name" => "�û���",
            "uid" => "Uid",
            "email_status" => "�����ʼ�״̬",
            "email_address" => "�����ʼ���ַ",
            "active_profile" => "����������Ϣ",
            "registration_time" => "ע��ʱ��",
            "registration_ip" => "ע��IP��ַ",
            "last_visited_ip" => "�����ʵ�IP��ַ",
            "statistics" => "ͳ������",
            "points" => "����"
        ],

        "change_password_tab" => [
            "change_password" => "��������",
            "old_password" => "������",
            "new_password" => "������",
            "confirm_password" => "ȷ������",


        ],

        "credit_history_tab" => [
            "credit_history" => "���ü�¼",
            "points_record" => "���ּ�¼",
            "serial_number" => "���к�",
            "type" => "����",
            "points" => "����",
            "date_time" => "���ں�ʱ��",
            "Transection_not_find" => "�Ҳ���ת�˼�¼"
        ],

        "post_history_tab" => [
            "post" => "����",
            "history" => "��ʷ",
            "post_history" => "������ʷ",
            "posters_not_available" => "����������",
        ],

        "blacklist_user_tab" => [
            "blacklist" => "������",
            "user" => "�û�",
            "blacklist_users" => "�������û�",
            "users_not_available" => "�������û�������",
        ]


    ],

    'site_statistics' => [
        'basic' => "������",
        'profile' => '���˵���',
        'site' => '��վͳ��'
    ],

    'blacklist_user' => [
        'button_one' => 'Excel �ļ�ʾ��',
        'button_two' => '����Excel',
        'add' => '���Ӻ������û�',
        'edit' => '�༭�������û�',
        'form' => [
            'fields' => [
                'email' => '�����ʼ�',
                'ip_address' => 'IP��ַ',
                'reason' => 'ԭ��',
                'username' => '�û���',
            ],
        ],
    ],


];
