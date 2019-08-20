@extends('hrms.module', ['page_title' => 'Branches', 'menu' => 'settings'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('branches.index') }}"><i class="fas fa-list"></i> Existing Branches</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>Edit Branch</legend>
        {!! Form::model($branch, ['route' => ['branches.update', $branch->slug()], 'class' => 'form-group']) !!}
        @method('PUT')
        @include('hrms/branches/form', ['submit_text' => 'Update Branch'])
        {!! Form::close() !!}
    </div>
</div>
@endsection