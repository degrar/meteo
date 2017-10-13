<div id="about_us_container">
    <div class="container">
        <span class="title">{{ $title }}</span>
        <span class="subtitle">{{ $subtitle }}</span>
        <div class="separation_line"></div>
        <div class="scrollbar_container">
            <div class="default-skin">{!! $content !!}</div>
        </div>
    </div>
</div>
@pushonce('pre_head_closed:scrollbars')
    {{ Html::style('css/external/jquery-custom-scrollbar/jquery.custom-scrollbar.css') }}
    {{ Html::style('css/about_us_widget.css') }}
@endpushonce
@pushonce('pre_body_closed:scrollbars')
    {{ Html::script('js/external/jquery-custom-scrollbar/jquery.custom-scrollbar.js') }}
@endpushonce
