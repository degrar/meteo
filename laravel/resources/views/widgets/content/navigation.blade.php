<nav>
    <a href="#" class="scroll_to" data-scroll_to="section2">{{ trans('web.about_us') }}</a>
    <a href="#" class="scroll_to" data-scroll_to="section4">{{ trans('web.services') }}</a>
    <a href="#" class="scroll_to" data-scroll_to="section5">{{ trans('web.team') }}</a>
    <a href="#" class="scroll_to" data-scroll_to="section6">{{ trans('web.contact') }}</a>
</nav>
@push('pre_head_closed')
    {{ Html::style('css/widgets/navigation.css') }}
@endpush
@push('pre_body_closed')
    <script language="javascript">
        @if($simple_scroll === true)
            window.simple_scroll = true;
        @else
            window.simple_scroll = false;
        @endif
    </script>
	{{ Html::script('js/widgets/navigation.js') }}
@endpush