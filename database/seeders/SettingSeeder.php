<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'id'         => 1,
                'key'        => 'site_title',
                'label'     =>  json_encode([
                                    'en' => 'Site Title',
                                    'ch' => '网站标题'
                                ],JSON_UNESCAPED_UNICODE),
                'value'   => "CNKBKT",
                'type'   =>  'text',
                'options'     =>  null,
                'restrictions'  =>  null,
                'status'     =>  1,
                'detail_type' => 1,
                'position' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'id'         => 2,
                'key'        => 'logo',
                'label'     =>  json_encode([
                                    'en' => 'Logo',
                                    'ch' => '标识'
                                ],JSON_UNESCAPED_UNICODE),
                'value'   =>  null,
                'type'   =>  'file',
                'options'     =>  null,
                'restrictions'  =>  null,
                'status'     =>  1,
                'detail_type' => 1,
                'position' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'id'         => 3,
                'key'        => 'contact_email',
                'label' =>  json_encode([
                                'en' => 'Contact Email',
                                'ch' => '联系电子邮件'
                            ],JSON_UNESCAPED_UNICODE),
                'value'   =>  null,
                'type'   =>  'email',
                'options'     =>  null,
                'restrictions'  =>  null,
                'status'     =>  1,
                'detail_type' => 1,
                'position' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'id'         => 4,
                'key'        => 'contact_no',
                'label' =>  json_encode([
                                'en' => 'Contact Number',
                                'ch' => '联系电话'
                            ],JSON_UNESCAPED_UNICODE),
                'value'   =>  null,
                'type'   =>  'number',
                'options'     =>  null,
                'restrictions'  =>  null,
                'status'     =>  1,
                'detail_type' => 1,
                'position' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            [
                'id'         => 5,
                'key'        => 'engilish_address',
                'label' =>  json_encode([
                                'en' => 'English Address',
                                'ch' => '英文地址'
                            ],JSON_UNESCAPED_UNICODE),
                'value'   =>  null,
                'type'   =>  'text',
                'options'     =>  null,
                'restrictions'  =>  null,
                'status'     =>  1,
                'detail_type' => 2,
                'position' => 5,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'id'         => 6,
                'key'        => 'chinese_address',
                'label' =>  json_encode([
                                'en' => 'Chinese Address',
                                'ch' => '中文地址'
                            ],JSON_UNESCAPED_UNICODE),
                'value'   =>  null,
                'type'   =>  'text',
                'options'     =>  null,
                'restrictions'  =>  null,
                'status'     =>  1,
                'detail_type' => 2,
                'position' => 6,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            

            // Footer Details 
            [
                'id'         => 7,
                'key'        => 'english_disclaimer',
                'label'      => json_encode([
                                    'en' => 'English Disclaimer',
                                    'ch' => '英文免责声明'
                                ],JSON_UNESCAPED_UNICODE),
                'value'     =>  null,
                'type'      =>  'text',
                'options'    =>  null,
                'restrictions'  =>  null,
                'status'     =>  1,
                'detail_type' => 2,
                'position' => 7,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'id'         => 8,
                'key'        => 'chinese_disclaimer',
                'label'      => json_encode([
                                    'en' => 'Chinese Disclaimer',
                                    'ch' => '中文免责声明'
                                ],JSON_UNESCAPED_UNICODE),
                'value'     =>  null,
                'type'      =>  'text',
                'options'    =>  null,
                'restrictions'  =>  null,
                'status'     =>  1,
                'detail_type' => 2,
                'position' => 8,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            [
                'id'         => 9,
                'key'        => 'english_content',
                'label'      => json_encode([
                                    'en' => 'English Content',
                                    'ch' => '英文内容'
                                ],JSON_UNESCAPED_UNICODE),
                'value'     =>  null,
                'type'      =>  'text',
                'options'    =>  null,
                'restrictions'  =>  null,
                'status'     =>  1,
                'detail_type' => 2,
                'position' => 9,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'id'         => 10,
                'key'        => 'chinese_content',
                'label'      => json_encode([
                                    'en' => 'Chinese Content',
                                    'ch' => '中文内容'
                                ],JSON_UNESCAPED_UNICODE),
                'value'     =>  null,
                'type'      =>  'text',
                'options'    =>  null,
                'restrictions'  =>  null,
                'status'     =>  1,
                'detail_type' => 2,
                'position' => 10,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            [
                'id'         => 11,
                'key'        => 'facebook_url',
                'label' =>  json_encode([
                                'en' => 'Facebook URL',
                                'ch' => 'Facebook URL'
                            ],JSON_UNESCAPED_UNICODE),
                'value'   =>  null,
                'type'   =>  'url',
                'options'     =>  null,
                'restrictions'  =>  null,
                'status'     =>  1,
                'detail_type' => 3,
                'position' => 11,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'         => 12,
                'key'        => 'instagram_url',
                'label' =>  json_encode([
                                'en' => 'Instagram URL',
                                'ch' => 'Instagram URL'
                            ],JSON_UNESCAPED_UNICODE),
                'value'   =>  null,
                'type'   =>  'url',
                'options'     =>  null,
                'restrictions'  =>  null,
                'status'     =>  1,
                'detail_type' => 3,
                'position' => 12,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'id'         => 13,
                'key'        => 'linkedin_url',
                'label' =>  json_encode([
                                'en' => 'Linkedin URL',
                                'ch' => 'Linkedin URL'
                            ],JSON_UNESCAPED_UNICODE),
                'value'   =>  null,
                'type'   =>  'url',
                'options'     =>  null,
                'restrictions'  =>  null,
                'status'     =>  1,
                'detail_type' => 3,
                'position' => 13,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'id'         => 14,
                'key'        => 'youtube_url',
                'label' =>  json_encode([
                                'en' => 'Youtube URL',
                                'ch' => 'Youtube URL'
                            ]),
                'value'   =>  null,
                'type'   =>  'url',
                'options'     =>  null,
                'restrictions'  =>  null,
                'status'     =>  1,
                'detail_type' => 3,
                'position' => 14,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'id'         => 15,
                'key'        => 'wechat_url',
                'label' =>  json_encode([
                                'en' => 'Wechat URL',
                                'ch' => 'Wechat URL'
                            ],JSON_UNESCAPED_UNICODE),
                'value'   =>  null,
                'type'   =>  'url',
                'options'     =>  null,
                'restrictions'  =>  null,
                'status'     =>  1,
                'detail_type' => 3,
                'position' => 15,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
           
        ];
        foreach($settings as $key => $value){
            Setting::create($value);
        }
    }
}
