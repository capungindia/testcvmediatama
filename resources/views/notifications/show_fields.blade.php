<!-- Reference Field -->
<div class="col-sm-12">
    {!! Form::label('reference', 'Reference:') !!}
    <p>
        @if($notifications->reference_type == 'videoRequests')
            Video Request
        @else
            Something Else
        @endif
    </p>
</div>

<!-- Message Field -->
<div class="col-sm-12">
    {!! Form::label('message', 'Message:') !!}
    <p>
        {!! $notifications->message !!}
    </p>
</div>

<!-- Read At Field -->
<div class="col-sm-12">
    {!! Form::label('read_at', 'Read At:') !!}
    <p>
        {{ $notifications->read_at->format('Y-m-d H:i:s') }}
    </p>
</div>

@if(Auth::user()->role == 'admin')
<!-- Created By Field -->
<div class="col-sm-12">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>
        {{ $notifications->created_by }}
    </p>
</div>

<!-- Updated By Field -->
<div class="col-sm-12">
    {!! Form::label('updated_by', 'Updated By:') !!}
    <p>
        {{ $notifications->updated_by }}
    </p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>
        {{ $notifications->created_at->format('Y-m-d H:i:s') }}
    </p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>
        {{ $notifications->updated_at->format('Y-m-d H:i:s') }}
    </p>
</div>
@endif