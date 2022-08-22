<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, [ 'autocomplete' => 'name', 'class' => 'form-control','maxlength' => 100, 'required' => '', 'autofocus' => '' ]) !!}
</div>

<div class="col-sm-6"></div>

<!-- Username Field -->
<div class="form-group col-sm-6">
    {!! Form::label('username', 'Username:') !!}
    {!! Form::text('username', null, ['autocomplete' => 'username', 'class' => 'form-control','maxlength' => 50, 'required' => '']) !!}
</div>

<div class="col-sm-6"></div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['autocomplete' => 'email', 'class' => 'form-control','maxlength' => 100, 'required' => '']) !!}
</div>

<div class="col-sm-6"></div>

<!-- Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role', 'Role:') !!}
    <select name='role' id='role' class="form-control" required>
        <option value='admin' @if(\Request::route()->getName() == 'users.edit') @if($users->role=='admin') selected @endif @endif> Admin </option>
        <option value='customer' @if(\Request::route()->getName() == 'users.edit') @if($users->role=='customer') selected @endif @endif> Customer </option>
    </select>
</div>

<div class="col-sm-6"></div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control','minlength' => 8]) !!}
</div>

<div class="col-sm-6"></div>

<!-- Password Confirmation -->
<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', 'Confirm Password:') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control','minlength' => 8]) !!}
</div>