<div class="col1 col">
	<span class="title">{{ trans('web.services') }}</span>
		<span class="separation_line"></span>
		@foreach ($services as $key => $service)
			<div><a class="service_nav_item" data-id="{{$service->id}}" data-image="{{$service->service->image}}">{{ $service->title }}</a></div>
		@endforeach	
	<div class="arrow_service arrow"></div>
</div>
<div id="services_container" class="col2 col">
	<div class="container">
		<span class="title"></span>
		<span class="separation_line"></span>
	</div>
	<div class="cross_service cross">
		<a class="show_service">
			<span></span>
			<span></span>
		</a>
	</div>
</div>

<!--
<div class="service_img">
	{{-- @foreach ($services as $key => $service)
		<img class="service_img{{($key+1)}}" data-id="{{$service->id}}" style="z-index: {{ 1000-$key }}" src="{{$service->service->image}}" />
	@endforeach --}}
</div>
-->

<div class="service_img" style="background-image: url({{$services->first()->image }}); background-size: cover;">
</div>

@push('pre_body_closed')
	{{ Html::script('js/external/jquery-custom-scrollbar/jquery.custom-scrollbar.js') }}
    <script type="text/javascript">
    var services_content = {!! $json_services_content !!};
    var services_img = {!! $json_services_img !!};
	</script>
    {{ Html::script('js/services_widget.js') }}
@endpush
@push('pre_head_closed')
    {{ Html::style('css/external/jquery-custom-scrollbar/jquery.custom-scrollbar.css') }}
    {{ Html::style('css/services_widget.css') }}
@endpush