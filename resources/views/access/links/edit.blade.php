@extends('access.module', ['page_title' => 'Links', 'menu' => 'access'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('links.index') }}"><i class="fas fa-list"></i> Existing Links</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>Edit Link</legend>
        {!! Form::model($link, ['route' => ['links.update', $link->slug()], 'class' => 'form-group']) !!}
        @method('PUT')
        @include('access/links/form', ['submit_text' => 'Update Link'])
        {!! Form::close() !!}
    </div>
</div>
@endsection