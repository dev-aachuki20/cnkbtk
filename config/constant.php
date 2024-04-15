<?php
return [
    // User Roles
    "role" => [
        "admin" => 1,
        "creator" => 2,
        "user" => 3
    ],

    "sectionLevel" => [
        "level1" => 1,
        "level2" => 2,
        "level3" => 3
    ],

    "creatorCanPost" => [
        "yes" => 1,
        "no" => 0
    ],

    "userCanPost" => [
        "yes" => 1,
        "no" => 0
    ],

    "option" => [
        "yes" => 1,
        "no" => 0   
    ],

    

    "advertisementType" => [
        "home_banner_image" => ["en" => "Home Banner Image" , "ch" => "主页横幅图片"],
        // "home_banner_upper_img" => "Home Banner Uppper Image",
        // "home_banner_lower_img" => "Home Banner Lower Image",
        "notification_image" => ["en" => "Notification Image" , "ch" => "通知图片"],
    ],

    "language" => [
        "english" => "en",
        "chinese" => "ch"
    ],
    
    "datatableLangUrl" => [
        'english' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json',
        'chinese' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json'
    ],

    "setting_type" => [
        'basic_details' => 1,
        'footer_details' => 2,
        'social_links' => 3,
    ],

    "point_type" => [
        'general' => 1,
        'integral' => 2
    ]

];


?>