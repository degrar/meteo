<div id="team_slide">
    <div id="team">
        <div class="team_container">
            <span class="title">{{ trans('web.team') }}</span>
            <div class="separation_line"></div>
            <div class="team_general_content">{!! $team_general_content->content !!}</div>
        </div>
    </div>
    <div id="team_images">
        @foreach($team_members as $team_member)
            <div class="team_member" data-id="{{ $team_member->team_member->id }}">
                <img src="{{ $team_member->team_member->image }}" />
                <div class="team_info">
                    <span class="team_memeber_name">{{ $team_member->team_member_name }}</span>
                    <div class="team_member_short_description">{!! $team_member->short_description !!}</div>                   
                </div>
                <img class="cross" src="/img/cross.svg" />
            </div>
        @endforeach
    </div>
</div>
@push('pre_head_closed')
    {{ Html::style('css/team.css') }}
@endpush
@push('pre_body_closed')
    {{ Html::script('js/team.js') }}
    {{ Html::script('js/external/jQueryRotate/jQueryRotate.js') }}
    <script language="javascript">
        var team_cv={!! $json_injected !!};
    </script>
@endpush