<?php

return [

    'home' => [
        'stats' => [
            'today' => 'Today',
            'yesterday' => 'Yesterday',
            'posts' => 'Posts',
            'members' => 'Members',
        ],
        'contact' => [
            'get_in_touch' => 'Get in touch',
            'contact_heading' =>'You can contact us from using below options.',
            'field' => [
                'email_address' => 'Email address',
                'subject' => 'Subject',
                'message' => 'Message',
            ]
        ]
    ],
    
    'login' => [
        'form' => [
            'form_title' => 'Sign in',
            'form_decription' => 'Welcome to CNKBTK, please put your login credentials below to start using the web',
            'fields' => [
                'user' => 'User name / Email address',
                'password' => 'Password' 
            ],
        ],
    ],

    'sign_up' =>[
        'form' => [
            'form_title' => 'Sign up',
            'fields' => [
                'user_name' => 'User name',
                'email_address' => 'Email address',
                'password' => 'Password',
                'confirm_password' => 'Confirm password', 
            ],
        ]
    ],

    'forget_password' =>[
        'forget_password_q' => 'Forgot password?',
        'send_instruction' => "No worries, we'll send you reset instructions.",
        'reset_password' => 'Reset Password',
        'back_to_sign_in' => 'Back to sign in',
        'form' => [
            'fields' => [
                'email_address' => 'Email address',
            ],
        ]
    ],

    'reset_password' =>[
        'reset_password' => 'Reset Password',
        'password_instruction' => 'Enter new password and then repeat it.',
        'form' => [
            'fields' => [
                'email_address' => 'Email address',
                'password' => 'Password',
                'confirm_password' => 'Confirm password', 
            ],
        ]
    ],

    'confirm_password' =>[
        'confirm_password' => 'Confirm Password',
        'confirm_password_instruction' => 'Please confirm your password before continuing.',
        'forgot_password' => 'Forgot Your Password?',
        'form' => [
            'fields' => [  
                'password' => 'Password',
            ],
        ]
    ],

    'verify_page' =>[
        'verify_your' => 'Verify your',
        'email' => 'email',
        'verify_your_email_address' => 'Verify your email address',
        'fresh_mail_sent' => 'A fresh verification link has been sent to your email address.',
        'verification_link_sent' => 'Before proceeding, please check your email for a verification link',
        'not_recieve_mail' => 'If you did not receive the email',
        'request_another_mail' => 'click here to request another',
    ],


    'post' => [
        'form' => [
            'fields' => [
                'title' => 'Title',
                'parent_section' => 'Parent section',
                'sub_section' => 'Sub section',
                'child_section' => 'Child section',
                'poster_cover_image' => 'Poster cover image',
                'tags' => 'Tags',
                'status' => 'Status',
                'description' => 'Description',  
                'episode_title' => 'Episode title',
                'episode_cost' => 'Episode cost',
                'episode_description' => 'Episode Description',
                'allowed_file_type' => '(Allowed type jpg | png | jpeg | JPG | JPEG | PNG)'
                
            ],
            'delete_message' => 'Once deleted, this record cannot be restored. Also all the episode will be deleted associated with this poster.',
            'add_episode' => 'Add Eposide',
        ],
    ],

    'section' => [
        'most_viewed' => 'Most viewed',
    ],

    'poster' => [
        'report' => 'Report',
        'follow' => 'Follow',
        'following' => 'Following',
        'episode_details' => 'Episode Details'
    ],

    'selftopup' => [
        'self_service' => "Self-service",
        'top_up' => 'top-up',
        'product_name' => 'Product name',
        'points' => 'Points',
        'order_amount' => 'Order amount',
        'payment_method' => 'Payment method',
        'need_to_pay' => 'Need to pay',
        'pay_immediately' => 'Pay immediately'
    ],


    'user' => [
        "profile_tab" => [
            "profile" => "Profile",
            "user_has_not_write_anything_yet" => "User Has not write anything yet",
            "form" => [
                "field" => [
                    "user_name" => "User name",
                    "email_address" => "Email address",
                    "profile_image" => "Profile image",
                    "about_your_self" => "About your self"
                ]
            ]
        ],

        "basic_infomation_tab" => [
            "basic_infomation" => "Basic information",
            'personal_information' => "Personal information",
            'personal_info_text' => "Manage your personal information, including phone numbers and email address where you can be contacted.",
            "user_name" => "User name",
            "uid" => "Uid",
            "email_status" => "Email status",
            "email_address" => "Email address",
            "active_profile" => "Active profile",
            "registration_time" => "Registration time",
            "registration_ip" => "Registration IP",
            "last_visited_ip" => "Last visited IP",
            "last_visited_ip" => "Last visited IP",
            "statistics" => "Statistics",
            "points" => "Points"
        ],

        "change_password_tab" => [
            "change_password" => "Change password",
            "old_password" => "Old password",
            "new_password" => "New password",
            "confirm_password" => "Confirm password",


        ],

        "credit_history_tab" => [
            "credit_history" => "Credit history",
            "points_record" => "Points record",
            "serial_number" => "S.no",
            "type" => "Type",
            "points" => "Points",
            "date_time" => "Date & Time",
            "Transection_not_find" => "Transection not find"
        ],

        "post_history_tab" => [
            "post" => "Post",
            "history" => "history",
            "post_history" => "Post history",
            "posters_not_available" => "Posters not available",
        ],

        "blacklist_user_tab" => [
            "blacklist" => "Blacklist",
            "user" => "User",
            "blacklist_users" => "Blacklist User",
            "users_not_available" => "Blacklist users not available",
        ]

        
        ],


    'site_statistics' => [
        'basic' => "Basic",
        'profile' => 'Profile',
        'site' => 'Site statistics'
    ],

    'blacklist_user' => [
        'form' => [
            'fields' => [
                'email' => 'Email',
                'ip_address' => 'IP Address',
            ],
        ],
    ],

    

        
    
];



