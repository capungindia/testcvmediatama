{!! Form::hidden('verifier_id', Auth::user()->id, []) !!}

<!-- Allowed Duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('allowed_duration', 'Allowed Duration (minutes):') !!}
    {!! Form::number('allowed_duration', null, ['class' => 'form-control']) !!}
</div>