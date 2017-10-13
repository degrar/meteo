<footer class="section_footer">
    <ul>
        <li>
            <span class="footer_section">{{ trans('web.our_team') }}</span>
            <ul class="footer_section_content members">
                @foreach($team as $team_member)
                    <li><a href="#" data-id="{{ $team_member->team_member->id }}">{{ $team_member->team_member_name }}</a></li>
                @endforeach
            </ul>
        </li>
        <li>
            <span class="footer_section">{{ trans('web.our_services') }}</span>
            <ul class="footer_section_content services">
                @foreach($services as $service)
                    <li><a href="#" data-id="{{ $service->id }}">{{ $service->title }}</a></li>
                @endforeach
            </ul>
        </li>
        <li>
            <span class="footer_section">{{ trans('web.contact_us') }}</span>
            <ul class="footer_section_content">
                <li>León y Castillo 64, 1º derecha</li>
                <li>Las Palmas de Gran Canaria 35003</li>
                <li>T./F. +34 928 380 143</li>
                <li>clinicaimplantis@gmail.com</li>
                <li>implantis.es</li>
            </ul>
        </li>
        <li>
            <span class="footer_section">{{ trans('web.hours') }}</span>
            <ul class="footer_section_content">
                <li>{{ trans('web.monday') }}: 9:00-17:00</li>
                <li>{{ trans('web.tuesday') }}: 8:00-16:00</li>
                <li>{{ trans('web.wednesday') }}: 9:00-19:00</li>
                <li>{{ trans('web.thursday') }}: 8:00-16:00</li>
                <li>{{ trans('web.friday') }}: 8:00-15:00</li>
                <li>{{ trans('web.saturday') }}: {{ trans('web.closed') }}</li>
                <li>{{ trans('web.sunday') }}: {{ trans('web.closed') }}</li>
            </ul>
        </li>
        <li>
            <span class="separation_line black"></span>
            <ul class="footer_section_content">
                <li><a href="{{ trans('web.linkprivacy') }}">{{ trans('web.privacypolicy') }}</a></li>
                <li><a href="{{ trans('web.linkcookies') }}">{{ trans('web.cookiespolicy') }}</a></li>
            </ul>
        </li>
    </ul>
    <div class="footer_baseline">&copy; 2017 IMPLANTIS ALL RIGHTS RESERVED</div>
</footer>

{{-- Injections personalized for every slider widgets --}}
@push('pre_head_closed')
    {{ Html::style('css/footer.css') }}
@endpush
@push('pre_head_closed')
    {{ Html::script('js/footer.js') }}
@endpush  