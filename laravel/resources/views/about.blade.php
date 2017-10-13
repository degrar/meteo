<!DOCTYPE html>
<html>
<head>
    <title>About</title>
</head>
<body>
    <ul>

        @foreach($tasks as $task)
        <li>{{ $task }}</li>
        @endforeach

    </ul>
</body>
</html>
