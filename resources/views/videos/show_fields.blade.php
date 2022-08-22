@if(Auth::user()->role == 'admin' || \Session::get('hasAccess'))
<!-- The Video -->
<div class="col-sm-12 d-flex justify-content-center">
    <video controls autoplay>
        <source src="{{ asset('storage/videos') . '/' . $videos->filename }}" type="video/mp4">
        Your browser does not support the video tag.
    </video> 
</div>
<div class="clearfix"></div>
@endif

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $videos->title }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $videos->description }}</p>

    @if(Auth::user()->role == 'customer' && \Session::get('hasAccess'))
        <p>{{ \Session::get('message') }}</p>
    @endif
</div>

@if(Auth::user()->role == 'admin')
<!-- Filename Field -->
<div class="col-sm-12">
    {!! Form::label('filename', 'Filename:') !!}
    <p>{{ $videos->filename }}</p>
</div>

<!-- Created By Field -->
<div class="col-sm-12">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $videos->created_by }}</p>
</div>

<!-- Updated By Field -->
<div class="col-sm-12">
    {!! Form::label('updated_by', 'Updated By:') !!}
    <p>{{ $videos->updated_by }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $videos->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $videos->updated_at }}</p>
</div>
@endif