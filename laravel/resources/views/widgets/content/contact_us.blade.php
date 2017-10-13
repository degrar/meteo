<div id="contact_us">
    <div class="contact_us_container">
        <span class="title">{{ trans('web.contact_us') }}</span>
        <div class="separation_line"></div>
        <div class="located_at">
            <span class="title">{{ trans('web.located_at') }}</span>
            <span class="location_info">C/ León y Castillo, 64</span>
            <span class="location_info">1º Derecha, 35003</span>
            <span class="location_info">Las Palmas de Gran Canaria</span>
        </div>
        <div class="contact_data">
            <span class="title">{{ trans('web.data') }}</span>
            <span class="contact_data_info"><a href="mailto:clinicaimplantis@gmail.com">clinicaimplantis@gmail.com</a></span>
            <span class="contact_data_info">928 38 01 43</span>
        </div>
        <div class="clboth"></div>
        <span class="form_title">{{ trans('web.contact') }}</span>
        {{ Form::open() }}
            {{ Form::text( 'form_name', '', ['placeholder'=>trans('web.form_name'), 'class'=>'noSwipe'] ) }}
            {{ Form::text( 'form_phone', '', ['placeholder'=>trans('web.form_phone'), 'class'=>'noSwipe'] ) }}
            {{ Form::text( 'form_mail', '', ['placeholder'=>trans('web.form_mail'), 'class'=>'noSwipe'] ) }}
            {{ Form::text( 'form_subject', '', ['placeholder'=>trans('web.form_subject'), 'class'=>'noSwipe'] ) }}
            {{ Form::textarea( 'form_body', '', ['placeholder'=>trans('web.form_body'), 'class'=>'noSwipe'] ) }}
            <span class="privacy_policy">
                {{ Form::checkbox( 'form_terms_and_conditions', null, null, ['class' => 'css-checkbox', 'id' => 'checkboxform'] ) }}
                <label for="checkboxform" class="css-label lite-x-gray">{!! trans('web.terms_and_conditions') !!}</label>
            </span>
            {{ Form::submit( trans('web.send'), ['class'=>'noSwipe'] ) }}
        {{ Form::close() }}
    </div>
</div>
@push('pre_body_closed')
    {{ Html::script( '/js/contact_us.js' ) }}
    <script>
        form_error = '{{ trans('web.field_required') }}';
    </script>
@endpush
@push('pre_head_closed')
    {{ Html::style( '/css/contact_us.css') }}
    {{ Html::style( '/css/external/checkboxkit/style.css') }}
@endpush