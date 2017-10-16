@include('layouts.header')

<ul>
    @foreach( $current_weather as $weather )
        <li>
            <a href="/current_weather/{{ $weather->id}}">{{ $weather->temp_actual}}</a>
        </li>
    @endforeach
</ul>
@include('layouts.footer')