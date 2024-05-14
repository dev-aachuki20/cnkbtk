<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

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
                        <td align="center" style="padding:20px 0;background:#00235d;">
                            <img src="logo.png" alt="" width="300" style="height:auto;display:block;" />
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;">Project Confirmation Request Notification</p>
                                        <p>Hello {{$creator->user_name}},</p>
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;">{{$authUser->user_name}} has requested to confirm the project. Please review the details and confirm the project as soon as possible.</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;">Project Details:</p>
                                        <p>Project ID: {{$project->id}}</p>
                                        <p>Project Type: {{$project->type}}</p>
                                        <p>Description: {{$project->comment}}</p>
                                        <p>Requested by: {{$authUser->user_name}}</p>
                                        <p>Date of Request: {{$project->created_at->format('Y-m-d h:i:s A')}}</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;">Please use the below link to view project details</p>
                                    </td>
                                </tr>
                                @if($creator->id != null)
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <p style="margin:0;font-size:16px;line-height:24px;"><a href="{{route('user.project.detail', ['creator_id' => $creator->id, 'project_id' => $project->id])}}" style="display: block; padding: 10px; background: #00255b; width: fit-content; color: #fff; text-decoration: none; font-size: 14px;">View Project</a></p>
                                    </td>
                                </tr>
                                @endif

                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <p style="margin:0;font-size:16px;line-height:24px;">
                                            <a href="{{route('user.project.confirm',['creator_id' => $creator->id, 'project_id' => $project->id])}}" style="display: block; padding: 10px; background: #00255b; width: fit-content; color: #fff; text-decoration: none; font-size: 14px;">
                                                Confirm Project
                                            </a>
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;">Thank you for your attention to this matter.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px;background:#00235d;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;">
                                <tr>
                                    <td style="padding:0;width:50%;" align="center">
                                        <p style="margin:0;font-size:14px;line-height:16px;color:#ffffff;">
                                            © 2024 All Rights Reserved.
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