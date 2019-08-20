@extends('hrms.module', ['page_title' => 'Units', 'menu' => 'settings'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('departments.units.index', [$department->slug()]) }}"><i class="fas fa-list"></i> Existing Units</a>
        <a class="btn btn-primary" href="{{ route('departments.index') }}"><i class="fas fa-arrow-left"></i> Back to Departments</a>
    </div>
</div>
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <h4>Department: {{ $department->name }}</h4>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>Edit Unit</legend>
        {!! Form::model($unit, ['route' => ['departments.units.update', $department->slug(), $unit->slug()], 'class' => 'form-group']) !!}
        @method('PUT')
        @include('hrms/units/form', ['submit_text' => 'Update Unit'])
        {!! Form::close() !!}
    </div>
</div>
@endsection