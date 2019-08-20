@extends('hrms.module', ['page_title' => 'Job Functions', 'menu' => 'settings'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('departments.units.job_functions.index', [$department->slug(), $unit->slug()]) }}"><i class="fas fa-list"></i> Existing Units</a>
        <a class="btn btn-primary" href="{{ route('departments.units.index', [$department->slug()]) }}"><i class="fas fa-arrow-left"></i> Back to Units</a>
    </div>
</div>
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <h4>Department: {{ $department->name }}<br />Unit: {{ $unit->name }}</h4>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Job Function</legend>
        {!! Form::model(new App\HrmJobFunction, ['route' => ['departments.units.job_functions.store', $department->slug(), $unit->slug()], 'class' => 'form-group']) !!}
            @include('hrms/job_functions/form', ['submit_text' => 'Create Job Function'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
