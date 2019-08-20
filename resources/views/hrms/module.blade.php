@extends('app', ['module' => 'HRMS'])

@section('module')
<div class="row">
    <div class="col-md-2">
        <div id="accordion" style="margin-bottom: 10px;">
            <div class="card">
                <div class="card-header bg-white" id="heading1" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                            <strong>Employee Mgt.</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse1" class="collapse @if ($menu == 'employee') show @endif" aria-labelledby="heading1" data-parent="#accordion">
                    <div class="card-body">
                        <nav class="nav flex-column">
                            <a class="nav-link" href="{{ route('hrms') }}">Home</a>
                            <a class="nav-link" href="#">Employees</a>
                        </nav>
                    </div>
                </div> 
            </div>
            <div class="card">
                <div class="card-header bg-white" id="heading2" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                            <strong>Settings</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse2" class="collapse @if ($menu == 'settings') show @endif" aria-labelledby="heading2" data-parent="#accordion">
                    <div class="card-body">
                        <nav class="nav flex-column">
                            <a class="nav-link" href="{{ route('branches.index') }}">Branches</a>
                            <a class="nav-link" href="{{ route('departments.index') }}">Departments</a>
                            <a class="nav-link" href="{{ route('grades.index') }}">Grades</a>
                        </nav>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="card">
            <div class="card-body bg-white" style="padding: 20px;">
                @yield('content')
            </div>
        </div>
    </div>
</div>
@endsection