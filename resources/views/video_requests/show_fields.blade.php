<!-- Requested Video Field -->
<div class="col-sm-12">
    {!! Form::label('requested_video', 'Requested Video') !!}
    <p>
        <a href="{{ route('videos.show', $videoRequests->video_id) }}" title="{{ $videoRequests->video->title }}">
            {{ $videoRequests->video->title }}
        </a>
    </p>
</div>

<!-- Verified At Field -->
<div class="col-sm-12">
    {!! Form::label('verified_at', 'Verified At:') !!}
    <p>{{ is_null($videoRequests->verified_at) ? 'Not verified yet' : $videoRequests->verified_at->format('Y-m-d h:i:s') }}</p>
</div>

<!-- Verifier Field -->
<div class="col-sm-12">
    {!! Form::label('verifier', 'Verifier:') !!}
    <p>{{ is_null($videoRequests->verifier_id) ? 'Not verified yet' : $videoRequests->verifier->name }}</p>
</div>

<!-- Allowed Duration Field -->
<div class="col-sm-12">
    {!! Form::label('allowed_duration', 'Allowed Duration:') !!}
    <p>{{ $videoRequests->allowed_duration }}</p>
</div>

@if(Auth::user()->role == 'admin')
<!-- Created By Field -->
<div class="col-sm-12">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $videoRequests->created_by }}</p>
</div>

<!-- Updated By Field -->
<div class="col-sm-12">
    {!! Form::label('updated_by', 'Updated By:') !!}
    <p>{{ $videoRequests->updated_by }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $videoRequests->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $videoRequests->updated_at }}</p>
</div>
@endif