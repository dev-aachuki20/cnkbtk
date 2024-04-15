<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmailTemplate;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emailTemplate  = [
            [
                'id'         => 1,
                'name'       => 'Creator',
                'subject'    => 'Become a creator',
                'email_body' => '<div style=""><font face="Montserrat, sans-serif">Dear&nbsp;</font><span style="font-weight: 700; font-family: var(--font-Barlow); font-size: var(--body-font-size);">{{name}}</span></div><div style="">Congratulation!&nbsp;<span style="font-family: var(--font-Barlow); font-size: var(--body-font-size); font-weight: var(--body-font-weight);">Your are a creator now.</span></div>',
                'short_codes' => '{"name":"User Name"}',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        EmailTemplate::insert($emailTemplate);
    }
}
