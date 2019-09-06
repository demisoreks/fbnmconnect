@extends('hrms.module', ['page_title' => 'Employees', 'menu' => 'employee'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('employees.pending') }}"><i class="fas fa-list"></i> Back to List</a>
    </div>
</div>
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <strong>Employee Number:</strong> {{ $employee->number }}<br />
        <strong>Username:</strong> {{ $employee->username }}
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>Approve Employee</legend>
        {!! Form::model($employee, ['route' => ['employees.submit_approval', $employee->slug()], 'class' => 'form-group']) !!}
            @include('hrms/employees/form1', ['submit_text' => 'Approve Employee'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
