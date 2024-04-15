<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | 这 following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => '这 :attribute 必须接受.',
    'accepted_if' => '这 :attribute 必须是 accepted when :other is :value.',
    'active_url' => '这 :attribute 不是有效的 URL.',
    'after' => '这 :attribute 必须是之后的日期 :date.',
    'after_or_equal' => '这 :attribute 必须是晚于或等于的日期 :date.',
    'alpha' => '这 :attribute 只能包含字母.',
    'alpha_dash' => '这 :attribute 只能包含字母、数字、破折号和下划线.',
    'alpha_num' => '这 :attribute 只能包含字母和数字.',
    'array' => '这 :attribute 必须是一个数组.',
    'ascii' => '这 :attribute 只能包含单字节字母数字字符和符号.',
    'before' => '这 :attribute 必须是之前的日期 :date.',
    'before_or_equal' => '这 :attribute 必须是早于或等于的日期 :date.',
    'between' => [
        'array' => '这 :attribute 之间必须有 :min 和 :max 项目.',
        'file' => '这 :attribute 必须介于 :min 和 :max 千字节.',
        'numeric' => '这 :attribute 必须介于 :min 和 :max.',
        'string' => '这 :attribute 必须介于 :min 和 :max 人物.',
    ],
    'boolean' => '这 :attribute 字段必须为 true 或 false.',
    'confirmed' => '这 :attribute 确认不符.',
    'current_password' => '这 密码不正确.',
    'date' => '这 :attribute 不是有效日期.',
    'date_equals' => '这 :attribute 日期必须等于 :date.',
    'date_format' => '这 :attribute 格式不匹配 :format.',
    'decimal' => '这 :attribute一定有 :decimal 小数位.',
    'declined' => '这 :attribute 必须是 拒绝.',
    'declined_if' => '这 :attribute 必须是 拒绝时 :other 是 :value.',
    'different' => '这 :attribute 和 :other 必须是 different.',
    'digits' => '这 :attribute 必须是 :digits 数字.',
    'digits_between' => '这 :attribute 必须介于 :min 和 :max 数字.',
    'dimensions' => '这 :attribute 图像尺寸无效.',
    'distinct' => '这 :attribute 字段有重复值.',
    'doesnt_end_with' => '这 :attribute 不得以下列之一结尾: :values.',
    'doesnt_start_with' => '这 :attribute may not start with one of the following: :values.',
    'email' => '这 :attribute 必须是 有效的电子邮件地址.',
    'ends_with' => '这 :attribute must end with one of the following: :values.',
    'enum' => '这 已选择 :attribute 是无效的.',
    'exists' => '这 已选择 :attribute 是无效的.',
    'file' => '这 :attribute 必须是 一份文件.',
    'filled' => '这 :attribute field一定有 a value.',
    'gt' => [
        'array' => '这 :attribute一定有 多于 :value 项目.',
        'file' => '这 :attribute 必须是 比...更棒 :value 千字节.',
        'numeric' => '这 :attribute 必须是 比...更棒 :value.',
        'string' => '这 :attribute 必须是 比...更棒 :value 人物.',
    ],
    'gte' => [
        'array' => '这 :attribute一定有 :value 项目 或者更多.',
        'file' => '这 :attribute 必须是 比...更棒 或等于 :value 千字节.',
        'numeric' => '这 :attribute 必须是 比...更棒 或等于 :value.',
        'string' => '这 :attribute 必须是 比...更棒 或等于 :value 人物.',
    ],
    'image' => '这 :attribute 必须是 一个图像.',
    'in' => '这 selected :attribute 是无效的.',
    'in_array' => '这 :attribute 字段不存在于 :other.',
    'integer' => '这 :attribute 必须是 一个整数.',
    'ip' => '这 :attribute 必须是 有效的 IP 地址.',
    'ipv4' => '这 :attribute 必须是 有效的 IPv4 地址.',
    'ipv6' => '这 :attribute 必须是 有效的 IPv6 地址.',
    'json' => '这 :attribute 必须是 有效的 JSON 字符串.',
    'lowercase' => '这 :attribute 必须是 小写.',
    'lt' => [
        'array' => '这 :attribute一定有 少于 :value 项目.',
        'file' => '这 :attribute 必须是 少于 :value 千字节.',
        'numeric' => '这 :attribute 必须是 少于 :value.',
        'string' => '这 :attribute 必须是 少于 :value 人物.',
    ],
    'lte' => [
        'array' => '这 :attribute 不得超过 :value 项目.',
        'file' => '这 :attribute 必须是 少于 或等于 :value 千字节.',
        'numeric' => '这 :attribute 必须是 少于 或等于 :value.',
        'string' => '这 :attribute 必须是 少于 或等于 :value 人物.',
    ],
    'mac_address' => '这 :attribute 必须是 a valid MAC address.',
    'max' => [
        'array' => '这 :attribute 不得超过 :max 项目.',
        'file' => '这 :attribute 必须不 比...更棒 :max 千字节.',
        'numeric' => '这 :attribute 必须不 比...更棒 :max.',
        'string' => '这 :attribute 必须不 比...更棒 :max 人物.',
    ],
    'max_digits' => '这 :attribute 不得超过 :max 数字.',
    'mimes' => '这 :attribute 必须是 一个文件 type: :values.',
    'mimetypes' => '这 :attribute 必须是 一个文件 type: :values.',
    'min' => [
        'array' => '这 :attribute一定有 至少 :min 项目.',
        'file' => '这 :attribute 必须是 至少 :min 千字节.',
        'numeric' => '这 :attribute 必须是 至少 :min.',
        'string' => '这 :attribute 必须是 至少 :min 人物.',
    ],
    'min_digits' => '这 :attribute一定有 至少 :min 数字.',
    'missing' => '这 :attribute field 必须是 missing.',
    'missing_if' => '这 :attribute field 必须是 missing when :other is :value.',
    'missing_unless' => '这 :attribute field 必须是 missing unless :other is :value.',
    'missing_with' => '这 :attribute field 必须是 missing when :values is present.',
    'missing_with_all' => '这 :attribute field 必须是 missing when :values are present.',
    'multiple_of' => '这 :attribute 必须是 a multiple of :value.',
    'not_in' => '这 selected :attribute 是无效的.',
    'not_regex' => '这 :attribute format 是无效的.',
    'numeric' => '这 :attribute 必须是 一个号码.',
    'password' => [
        'letters' => '这 :attribute 必须至少包含一个 信.',
        'mixed' => '这 :attribute 必须至少包含一个 大写 和 一个小写字母.',
        'numbers' => '这 :attribute 必须至少包含一个 数字.',
        'symbols' => '这 :attribute 必须至少包含一个 象征.',
        'uncompromised' => '这 给定 :attribute 已经出现数据泄露。请选择不同的 :attribute.',
    ],
    'present' => '这 :attribute field 必须是 present.',
    'prohibited' => '这 :attribute field is prohibited.',
    'prohibited_if' => '这 :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => '这 :attribute field is prohibited unless :other is in :values.',
    'prohibits' => '这 :attribute field prohibits :other from being present.',
    'regex' => '这 :attribute format 是无效的.',
    'required' => '这 :attribute 字段为必填项.',
    'required_array_keys' => '这 :attribute field must contain entries for: :values.',
    'required_if' => '这 :attribute 字段为必填项 when :other is :value.',
    'required_if_accepted' => '这 :attribute 字段为必填项 when :other is accepted.',
    'required_unless' => '这 :attribute 字段为必填项 unless :other is in :values.',
    'required_with' => '这 :attribute 字段为必填项 when :values is present.',
    'required_with_all' => '这 :attribute 字段为必填项 when :values are present.',
    'required_without' => '这 :attribute 字段为必填项 when :values is not present.',
    'required_without_all' => '这 :attribute 字段为必填项 when none of :values are present.',
    'same' => '这 :attribute 和 :other must match.',
    'size' => [
        'array' => '这 :attribute 必须包含 :size 项目.',
        'file' => '这 :attribute 必须是 :size 千字节.',
        'numeric' => '这 :attribute 必须是 :size.',
        'string' => '这 :attribute 必须是 :size 人物.',
    ],
    'starts_with' => '这 :attribute 必须以下列之一开头: :values.',
    'string' => '这 :attribute 必须是一个字符串.',
    'timezone' => '这 :attribute 必须是有效的时区.',
    'unique' => '这 :attribute 已有人带走了.',
    'uploaded' => '这 :attribute 上传失败.',
    'uppercase' => '这 :attribute 必须是大写.',
    'url' => '这 :attribute 必须是有效的 URL.',
    'ulid' => '这 :attribute 必须是有效的 ULID.',
    'uuid' => '这 :attribute 必须是有效的 UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | 这 following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
