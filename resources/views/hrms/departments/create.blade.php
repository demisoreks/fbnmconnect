@extends('hrms.module', ['page_title' => 'Departments', 'menu' => 'settings'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('departments.index') }}"><i class="fas fa-list"></i> Existing Departments</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Department</legend>
        {!! Form::model(new App\HrmDepartment, ['route' => ['departments.store'], 'class' => 'form-group']) !!}
            @include('hrms/departments/form', ['submit_text' => 'Create Department'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
