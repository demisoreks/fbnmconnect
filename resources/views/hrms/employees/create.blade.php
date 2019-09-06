@extends('hrms.module', ['page_title' => 'Employees', 'menu' => 'employee'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('employees.index') }}"><i class="fas fa-list"></i> Active Employees</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Employee</legend>
        {!! Form::model(new App\HrmEmployee, ['route' => ['employees.store'], 'class' => 'form-group']) !!}
            @include('hrms/employees/form', ['submit_text' => 'Create Employee'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
