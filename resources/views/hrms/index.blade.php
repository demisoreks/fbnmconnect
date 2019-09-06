@extends('hrms.module', ['page_title' => 'HRMS Home', 'menu' => 'employee'])

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header bg-white">
                <strong>DEPARTMENT DISTRIBUTION</strong>
            </div>
            <div class="card-body">
                {!! $departments->container() !!}
                {!! $departments->script() !!}
            </div>
            <div class="card-footer">
                <a class="btn btn-primary btn-sm float-right"><i class="fas fa-eye"></i> View More</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4" style="margin-bottom: 20px;">
        <div class="card">
            <div class="card-header bg-white">
                <strong>GRADE DISTRIBUTION</strong>
            </div>
            <div class="card-body">
                {!! $grades->container() !!}
                {!! $grades->script() !!}
            </div>
            <div class="card-footer">
                <a class="btn btn-primary btn-sm float-right"><i class="fas fa-eye"></i> View More</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4" style="margin-bottom: 20px;">
        <div class="card">
            <div class="card-header bg-white">
                <strong>GENDER DISTRIBUTION</strong>
            </div>
            <div class="card-body">
                {!! $gender->container() !!}
                {!! $gender->script() !!}
            </div>
            <div class="card-footer">
                <a class="btn btn-primary btn-sm float-right"><i class="fas fa-eye"></i> View More</a>
            </div>
        </div>
    </div>
    <div class="col-lg-12" style="margin-bottom: 20px;">
        <div class="card">
            <div class="card-header bg-white">
                <strong>TALENT ACQUISITION</strong>
            </div>
            <div class="card-body">
                {!! $talents->container() !!}
                {!! $talents->script() !!}
            </div>
            <div class="card-footer">
                <a class="btn btn-primary btn-sm float-right"><i class="fas fa-eye"></i> View More</a>
            </div>
        </div>
    </div>
</div>
@endsection