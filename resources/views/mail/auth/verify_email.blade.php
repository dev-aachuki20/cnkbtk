<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" xmlns="http://www.w3.org/1999/xhtml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title>CNKBTK</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&display=swap"
        rel="stylesheet">
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
    <table role="presentation"
        style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation"
                    style="width: 100%; max-width:602px;border-collapse:collapse;border-spacing:0;text-align:left;">
                    <tr>
                        <td align="center" style="padding:20px 0;background:#ff6359;">
                            <h1 style="text-align: center; margin:0;font-size:14px;line-height:16px;color:#ffffff;">
                                {{ config('app.name') }}</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0; color:#4c4c4c;">
                                        <h3 style="text-align: center margin-bottom:20px;">{{trans('verification.subject')}}</h3>
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px; font-weight:600;">
                                            {{ trans('verification.greeting') }}</p>
                                        <p style="margin:0;font-size:16px;line-height:24px;">
                                            {{ trans('verification.line1') }}</p>
                                        <p style="margin:20px 0;">
                                            <a href="{{ $url }}" style="display: block; padding: 10px 20px; background:#ff6359; width: fit-content; color: #ffffff; text-decoration: none; font-size: 14px;">
                                                {{ trans('verification.action') }}
                                            </a>
                                        </p>
                                        <p style="margin:0;font-size:16px;line-height:24px;">
                                            {{ trans('verification.line2') }}</p>
                                        <p style="margin:0;font-size:16px;line-height:24px;">
                                            {{ trans('verification.salutation', ['app_name' => config('app.name')]) }}
                                        </p>
                                        {{-- <p style="margin:0;font-size:16px;line-height:24px;">
                                            {{ trans('verification.trouble', ['actionText' => trans('verification.verify_email_button'), 'url' => $url]) }}
                                        </p> --}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px;background:#ff6359;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;">
                                <tr>
                                    <td style="padding:0;width:50%;" align="center">
                                        <p
                                            style="text-align: center; margin:0;font-size:14px;line-height:16px;color:#ffffff;">
                                            {{ trans('verification.copy') }}
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
