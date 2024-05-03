<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>New Project Created</h1>
    <a class="btn btn-primary" href="{{route('user.project.request', $project->id)}}">View Project</a>
    <h1>Thank you!</h1>
</body>

</html>