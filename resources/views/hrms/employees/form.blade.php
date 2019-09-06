<div class="form-group row">
    {!! Form::label('number', 'Employee Number *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('number', $value = null, ['class' => 'form-control', 'placeholder' => 'Employee Number', 'required' => true, 'maxlength' => 50]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('username', 'Username *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('username', $value = null, ['class' => 'form-control', 'placeholder' => 'Username', 'required' => true, 'maxlength' => 100]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('first_name', 'First Name *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('first_name', $value = null, ['class' => 'form-control', 'placeholder' => 'First Name', 'required' => true, 'maxlength' => 50]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('middle_name', 'Middle Name', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('middle_name', $value = null, ['class' => 'form-control', 'placeholder' => 'Middle Name', 'maxlength' => 50]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('surname', 'Surname *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('surname', $value = null, ['class' => 'form-control', 'placeholder' => 'Surname', 'required' => true, 'maxlength' => 50]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('date_of_birth', 'Date of Birth *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::date('date_of_birth', $value = null, ['class' => 'form-control', 'placeholder' => 'Date of Birth', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('gender', 'Gender *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::select('gender', ['M' => 'Male', 'F' => 'Female', 'O' => 'Other'], $value = null, ['class' => 'form-control', 'placeholder' => '- Select Option -', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('address', 'Contact Address', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('address', $value = null, ['class' => 'form-control', 'placeholder' => 'Contact Address', 'rows' => 4]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('mobile_number', 'Mobile Number', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('mobile_number', $value = null, ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'maxlength' => 20]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('alternate_number', 'Alternate Number', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('alternate_number', $value = null, ['class' => 'form-control', 'placeholder' => 'Alternate Number', 'maxlength' => 20]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('alternate_email', 'Alternate Email', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('alternate_email', $value = null, ['class' => 'form-control', 'placeholder' => 'Alternate Email', 'maxlength' => 50]) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-10 offset-md-2">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>