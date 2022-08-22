<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['autocomplete' => 'title', 'class' => 'form-control','maxlength' => 100, 'required' => '', 'autofocus' => '']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => '']) !!}
</div>

@if(\Request::route()->getName() == 'videos.create')
<!-- Filename Field -->
<div class="form-group col-sm-6">
    {!! Form::label('filename', 'Filename:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('filename', ['class' => 'custom-file-input', 'accept' => 'video/mp4', 'required' => '']) !!}
            {!! Form::label('filename', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>
@endif