@include('widgets.content.footer')
{{-- Inject main.js on pre_body_closed : This js contains all the js logic that belongs to the main template --}}
@push('pre_body_closed')
	{{ Html::script('js/main.js') }}
@endpush
