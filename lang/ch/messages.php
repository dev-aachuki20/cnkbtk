<?php
return [
    'add_success' => ':module 已添加成功！',
    'update_success' => ':module 已经更新成功！',
    'delete_success' => ':module 已删除成功！',
    'status_success' => ':module 已更改成功！',

    // Global Error 
    "something_went_wrong" => '出问题了!',
    'error_occured' => '发生了错误!',
    "are_you_sure" => '你确定吗？',
    "delete_warning" => "该记录一旦删除将无法恢复",
    "update_warning" => "您想更新此记录的状态吗？",
    "invalid_request" =>  "无效的请求",
    "invalid_file_format" => "文件格式无效。请上传有效文件",
    "poster_not_found" => "找不到帖子",

    // Registration
    "register.success" => "您已注册成功。我们已发送验证电子邮件。请验证您的电子邮件.",

    // Other messages
    "contact.success" => " 询价已成功提交！",
    "profile.success" => "您的个人资料已成功更新",
    "password.old_not_match" => "旧密码不匹配",
    "password.success" => "你已经成功更改密码",
    'finish_success' => ':module 已成功完成!',

    // Report module messeges 
    "logged_in_report" => "请登录后举报该帖子",
    "you_can_not_report_your_own_post" => "您无法举报自己的帖子",

    //follow module messages
    "logged_in_follow" => "请登录后关注海报",
    "follow_success" => "您已关注成功",
    "unfollow_success" => "您已成功取消关注",

    // Episode Purchase 
    "purchase.logged_in" => "请登录购买此剧集",
    "insufficient_point" => "您的积分不足以购买本集，请充值您的钱包",
    "purchase.success" => "您已成功购买该剧集，现在可以访问内容",
    "you_can_not_purchase_your_own_posters" => "您不能购买自己的海报",
    "user_inactivated" => "您的帐户已停用",

    // Site statistics access
    'logged_in_route_access' => '对不起！请先登入。',
    'access_denied' => '对不起！您无权访问。',

    'most_popular_poster_count' => '最受欢迎的帖子数',
    'tag_type_based_post_count' => '基于标签类型的帖子计数',

    'excel_uploaded' => 'Excel 文件上传并处理成功！',

    'registration_failed' => '注册失败。提供的电子邮件已被列入黑名单',
    'project_request_failed' => '对不起！！由于您已被列入黑名单，您的请求失败',
    'project_locked_successfully' => '项目锁定成功',

    'project_lock_request' => ':module 锁定请求发送成功',

    'finished_project_warning_message' => '完成后您将无法重新打开该项目。',
    'authentication_failed' => '认证失败。提供的电子邮件已被列入黑名单',
    'email_already_blacklisted' => '用户已被列入黑名单。',
    'creator_message' => '如果没有选择，则请求自动发送给所有创建者。',

    'other_reason' => [
        'required_if' => '当原因是其他时，其他原因字段是必需的。',
    ],
    'project_assigned' => '该项目已分配给另一个创建者。您只能查看该项目。',
    'project_not_found' => '没有找到数据',

];
