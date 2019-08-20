@extends('hrms.module', ['page_title' => 'Branches', 'menu' => 'settings'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('branches.index') }}"><i class="fas fa-list"></i> Existing Branches</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Branch</legend>
        {!! Form::model(new App\HrmBranch, ['route' => ['branches.store'], 'class' => 'form-group']) !!}
            @include('hrms/branches/form', ['submit_text' => 'Create Branch'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
