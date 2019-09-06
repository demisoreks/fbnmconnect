@extends('access.module', ['page_title' => 'Roles', 'menu' => 'access'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('links.roles.index', [$link->slug()]) }}"><i class="fas fa-list"></i> Existing Roles</a>
        <a class="btn btn-primary" href="{{ route('links.index') }}"><i class="fas fa-arrow-left"></i> Back to Links</a>
    </div>
</div>
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <h4>Link: {{ $link->title }}</h4>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Role</legend>
        {!! Form::model(new App\AccRole, ['route' => ['links.roles.store', $link->slug()], 'class' => 'form-group']) !!}
            @include('access/roles/form', ['submit_text' => 'Create Role'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
