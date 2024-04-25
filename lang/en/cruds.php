<?php

return [

    'profile' => [
        'title'                     => 'Profiles',
        'title_singular'            => 'Profile',
        'fields' => [
            'user_name' => 'User Name',
            'email' => 'Email',
            'profile_image' => 'Profile Image',
            'role' => 'Role',
        ]
    ],

    'change_password' => [
        'title'                     => 'Change Password',
        'title_singular'            => 'Change Password',
        'fields' => [
            'old_password' => 'Old Password',
            'password' => 'Password',
            'confirm_password' => 'Confirm Password',
        ]
    ],
    //Email Template Cruds
    'email_template'  => [
        'title'                     => 'Email Templates',
        'title_singular'            => 'Email Template',
        'fields' => [
            'id' =>  'ID',
            'name' => "Name",
            'subject' => "Subject",
            'email_body' => "Email Body",
            'short_codes' => "Short Code",
        ]
    ],
    //User Crud
    'user'  => [
        'title'                     => 'Users',
        'title_singular'            => 'User',
        'fields' => [
            'id' =>  'ID',
            'user_name' => "User Name",
            'profile_image' => 'Profile Image',
            'role' => 'Role',
            'email' => 'Email',
            'image' => "Image"
        ]
    ],

    'setting'  => [
        'title'                     => 'Settings',
        'title_singular'            => 'Setting',
        'basic_details'             => 'Basic Details',
        'footer'                    => 'Footer',
        'social_links'              => "Social Links"
    ],

    // Sections Crud
    'section_management'  => [
        'title'                     => 'Sections Management',
        'title_singular'            => 'Section Management',
        // Parent Section
        'parent_section' => [
            'title'              => 'Parent Sections',
            'title_singular'     => 'Parent Section',
            'fields' => [
                'id' =>  'ID',
                'title' => "Title",
                'description' => 'Description',
                'creator_can_post' => 'Creator can post',
                'user_can_post' => 'User can post',
                'show_in_header' => 'Show in header',
                'show_in_footer' => 'Show in footer',
                'position' => 'Position'
            ],
            'delete_message' => 'If you delete parent section all the sub section and child section will delete along with their posters.'
        ],
        // Sub Section 
        'sub_section' => [
            'title'              => 'Sub Sections',
            'title_singular'     => 'Sub Section',
            'fields' => [
                'id' =>  'ID',
                'title' => "Title",
                'description' => 'Description',
                'creator_can_post' => 'Creator can post',
                'user_can_post' => 'User can post',
                'show_in_header' => 'Show in header',
                'show_in_footer' => 'Show in footer',
                'position' => 'Position',
                'parent_section' => "Parent Section",
                'section_logo' => "Section Logo",
            ],
            'delete_message' => 'If you delete sub section all the child section will delete along with their posters.'
        ],
        //Child Section 
        'child_section' => [
            'title'              => 'Child Sections',
            'title_singular'     => 'Child Section',
            'fields' => [
                'id' =>  'ID',
                'title' => "Title",
                'description' => 'Description',
                'creator_can_post' => 'Creator can post',
                'user_can_post' => 'User can post',
                'show_in_header' => 'Show in header',
                'show_in_footer' => 'Show in footer',
                'position' => 'Position',
                'parent_section' => "Parent Section",
                'sub_section' => "Sub Section",
                'section_logo' => "Section Logo",
            ],
            'delete_message' => '如果删除子部分，所有海报都将被删除'
        ]

    ],
    // Tag Type and Tag Cruds
    'tag_management'  => [
        'title'                     => 'Tags Management',
        'title_singular'            => 'Tag Management',
        //Tag Type Cruds
        'tag_type' => [
            'title'              => 'Tag Types',
            'title_singular'     => 'Tag Type',
            'fields' => [
                'id' =>  'ID',
                'title' => "Title",

            ],
            'delete_message' => 'If you delete it , all the tags with in these tag type will delete'
        ],
        //Tags Cruds
        'tag' => [
            'title'              => 'Tags',
            'title_singular'     => 'Tag',
            'fields' => [
                'id' =>  'ID',
                'title' => "Title",
                'tag_type' => "Tag Type",
            ]
        ]
    ],
    //Advertisement Cruds
    'advertisement' => [
        'title'              => 'Advertisements',
        'title_singular'     => 'Advertisement',
        'fields' => [
            'id' =>  'ID',
            'image' => 'Image',
            'advertisement_type' => 'Advertisement Type',
            'url' => 'URL',
        ]
    ],
    //Post management Cruds
    'post_management' => [
        'title'                     => 'Posters Management',
        'title_singular'            => 'Poster Management',

    ],

    'plan' => [
        'title'                     => 'Plans Management',
        'title_singular'            => 'Plan Management',
        'module' => 'Plan',
        'fields' => [
            'id' =>  'ID',
            'title' => 'Title',
            'amount' => 'Amount',
            'points' => 'Points',
        ]

    ],

    'enquiries' => [
        'title' => 'Enquiries',
        'title_singular' => 'Enquiry',
        'fields' => [
            'id' =>  'ID',
            'email' => 'Email',
            'subject' => 'Subject',
            'message' => 'Message',
        ]
    ],

    'reports' => [
        'title' => 'Reports',
        'title_singular' => 'Report',
        'fields' => [
            'id' =>  'ID',
            'reason' => 'Reason',
            'description' => 'Description',
            'username' => 'User Name',
            'poster' => 'Poster'
        ]
    ],

    'point' => [
        'title' => 'Points',
        'title_singular' => 'Point'
    ],

    //  Global
    'global' => [
        'status' => 'Status',
        'created_date' => 'Created Date',
        'updated_date' => 'Updated Date',
        'add' => 'Add',
        'view' => 'View',
        'edit' =>  'Edit',
        'delete' =>  'Delete',
        'action' => 'Action',
        'active' => 'Active',
        'in_active' => 'In-active',
        'short_code' => 'Short Code',
        'description' => 'Description',
        'details' => 'Details',
        'enter' => 'Enter',
        'copy' => 'Copy',
        'save' => 'Save',
        'update' => 'Update',
        'cancel' => 'Cancel',
        'delete_btn_text' => 'Yes, delete it!',
        'cancel_delete_btn_text' => 'No, cancel!',
        'yes' => 'Yes',
        'no' => 'No',
        'select' => "Select",
        'choose_file' => 'Choose file',
        'allowed_file_type' => '(Allowed type jpg | png | jpeg | JPG | JPEG | PNG)',
        'allowed_file_type_png' => '(Allowed type png | PNG)',
        'na' => "N/A",
        'purchase' => "Purchase",
        'apply' => 'Apply',
    ],

    'lang' => [
        'english' => "English",
        'chinese' => "Chinese",
    ],

    'statistics' => [
        'title' => 'Site statistics',
        'statistics_filteration' => [
            'title'             => 'Select Filter:',
            'daterange_title'   => 'Select Date Range:',
            'tag_type_title'    => 'Select Tag Type:',
            'day'               => "Day",
            'week'              => "Week",
            'month'             => "Month",
            'custom_range'      => "Custom Range",
        ]
    ],

    'registered_members' => [
        'title'             => 'Registered Members',
        'title_singular'    => 'Registered Member',
        'fields' => [
            'num_graph'  => 'Members Registration Graph',
            'time'       => 'Members Registration Time',
            'count'      => 'Members Count',
            'graph'      => 'Members Graph',
        ]
    ],

    'number_of_posts' => [
        'title'            => 'Number Of Posts',
        'title_singular'   => 'Number Of Post',
        'fields' => [
            'num_graph'    => 'Number Of Points Graph',
            'time'         => 'Number Of Points Time',
            'count'        => 'Points Count',
            'graph'        => 'Points Graph',
        ]
    ],

    'most_popular_poster' => [
        'title'             => 'Most Popular Posters',
        'title_singular'    => 'Most Popular Poster',
        'fields' => [
            'num_graph'     => 'Most Of Popular Posters Graph',
            'time'          => 'Popular Posters Time',
            'count'         => 'Popular Posters Count',
            'graph'         => 'Popular Posters Graph',
        ]
    ],

    'visiting_users' => [
        'title'             => 'Visiting Users',
        'title_singular'    => 'Visiting User',
        'fields' => [
            'num_graph'     => 'Visiting Users Graph',
            'time'          => 'Visiting Time',
            'count'         => 'Visiting Users Count',
            'graph'         => 'Visiting Graph',
        ]
    ],

    'mobile_access' => [
        'title'             => 'Mobile Access',
        'title_singular'    => 'Mobile Access',
        'fields' => [
            'num_graph'     => 'Mobile Access Users Graph',
            'time'          => 'Mobile Access Time',
            'count'         => 'Mobile Access Count',
            'graph'         => 'Mobile Access Graph',
        ]
    ],
];
