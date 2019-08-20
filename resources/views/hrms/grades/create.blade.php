@extends('hrms.module', ['page_title' => 'Grades', 'menu' => 'settings'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('grades.index') }}"><i class="fas fa-list"></i> Existing Grades</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Grade</legend>
        {!! Form::model(new App\HrmGrade, ['route' => ['grades.store'], 'class' => 'form-group']) !!}
            @include('hrms/grades/form', ['submit_text' => 'Create Grade'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
