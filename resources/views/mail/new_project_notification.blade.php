<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Hello!! {{$creator->user_name}}</h1>
    <h2>New Project Created</h2>
    @if($creator->id != null)
    <a class="btn btn-primary" href="{{route('user.project.request', ['creator_id' => $creator->id, 'project_id' => $project->id])}}">View Project</a>
    @else
    <h1>dff</h1>
    @endif

    <h1>Thank you!</h1>
</body>

</html>