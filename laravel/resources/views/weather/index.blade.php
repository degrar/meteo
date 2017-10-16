<!DOCTYPE html>
<html>
<head>
    <title>Current Weather</title>
</head>
<body>
<ul>
    @foreach( $current_weather as $weather )
        <li>
            <a href="/current_weather/{{ $weather->id}}">{{ $weather->temp_actual}}</a>
        </li>
    @endforeach
</ul>
</body>
</html>
