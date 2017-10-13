 <div class="slider" id="slider_{{ $widget_name }}">
     @foreach($elements as $element)
         <div class="slide" style="background: url('{{ $element->image }}') no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
             <div class="slide_content">
                 <span class="title">{{ $element->title }}</span>
                 <span class="subtitle">{{ $element->subtitle }}</span>
             </div>
         </div>
     @endforeach
 </div>

{{-- Common injections for all slider widgets, will be included just once --}}
@pushonce('pre_body_closed:slider')
    {{ Html::script('js/external/slick/slick.js') }}
@endpushonce
@pushonce('pre_head_closed:slider')
    {{ Html::style('css/external/slick/slick.css') }}
    {{ Html::style('css/external/slick/slick-theme.css') }}
    {{ Html::style('css/external/fontawesome/font-awesome.css') }}
    <link href="https://fonts.googleapis.com/css?family=Lato:300i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
    <style>
        .slider button, .slider button:active, .slider button:focus, .slider button:hover {
            outline: 0;
        }

        .slider button::-moz-focus-inner {
            border: 0;
        }
    </style>
@endpushonce

{{-- Injections personalized for every slider widgets --}}
@push('pre_body_closed')
    {{ Html::script('js/'.$widget_name.'_slider_widget.js') }}
@endpush
@push('pre_head_closed')
    {{ Html::style('css/'.$widget_name.'_slider_widget.css') }}
@endpush