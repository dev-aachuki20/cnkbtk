<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title>CNKBTK</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
        }

        table,
        td,
        div,
        h1,
        p {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body style="margin:0;padding:0;">

    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation" style="width: 100%; max-width:602px;border-collapse:collapse;border-spacing:0;text-align:left;">
                    <tr>
                        <td align="center" style="padding:20px 0;background:#ff6359;">
                            {{-- <img src="" alt="" width="300" style="height:auto;display:block;" /> --}}
                            <h1 style="text-align: center; margin:0;font-size:14px;line-height:16px;color:#ffffff;">{{ config('app.name') }}</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <h3>{{trans('passwords.reset_email_subject')}}</h3>
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;">
                                            
                                            {{trans('passwords.reset_email_line1')}}
                                        </p>
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;">
                                            {{trans('passwords.reset_email_line2')}}
                                        </p>
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;">
                                            {{trans('passwords.reset_email_line3')}}
                                        </p>
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px; text-align: center;">
                                            <a href="{{ url(config('app.url').route('password.reset', $token, false)) }}" style="display: block; padding: 10px 20px; background:#ff6359; width: fit-content; color: #ffffff; text-decoration: none; font-size: 14px;">
                                                {{ trans('passwords.reset_email_button') }}
                                            </a>
                                        </p>
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;">
                                            {{trans('passwords.reset_email_line4')}}
                                        </p>
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;">
                                            {{trans('passwords.reset_email_notice', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')])}}
                                        </p>
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;">
                                            {{trans('passwords.reset_email_salutation', ['app_name' => config('app.name')])}}
                                        </p>
                                        {{-- <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;">
                                            {{trans('passwords.email_trouble_message')}}
                                            {{ trans('passwords.email_trouble_message', ['actionText' => trans('passwords.reset_email_button'), 'url' => url(config('app.url').route('password.reset', $token, false))]) }}
                                        </p> --}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px;background:#ff6359;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;">
                                <tr>
                                    <td style="padding:0;width:50%;" align="center">
                                        <p style="text-align: center; margin:0;font-size:14px;line-height:16px;color:#ffffff;">
                                            {{trans('passwords.email_copyright')}}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>