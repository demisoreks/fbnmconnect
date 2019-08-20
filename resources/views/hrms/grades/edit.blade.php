@extends('hrms.module', ['page_title' => 'Grades', 'menu' => 'settings'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('grades.index') }}"><i class="fas fa-list"></i> Existing Grades</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>Edit Grade</legend>
        {!! Form::model($grade, ['route' => ['grades.update', $grade->slug()], 'class' => 'form-group']) !!}
        @method('PUT')
        @include('hrms/grades/form', ['submit_text' => 'Update Grade'])
        {!! Form::close() !!}
    </div>
</div>
@endsection