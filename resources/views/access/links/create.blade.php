@extends('access.module', ['page_title' => 'Links', 'menu' => 'access'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('links.index') }}"><i class="fas fa-list"></i> Existing Links</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Link</legend>
        {!! Form::model(new App\AccLink, ['route' => ['links.store'], 'class' => 'form-group']) !!}
            @include('access/links/form', ['submit_text' => 'Create Link'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
