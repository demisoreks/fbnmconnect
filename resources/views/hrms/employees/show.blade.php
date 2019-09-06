@extends('hrms.module', ['page_title' => 'Employee Details', 'menu' => 'employee'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <form action="{{ route('employees.destroy', [$employee->slug()]) }}" method="POST">
        @if ($employee->status == 'New')
        <a class="btn btn-success" href="{{ route('employees.approve', [$employee->slug()]) }}"><i class="fas fa-check"></i> Approve</a>
        
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button class="btn btn-danger" onclick="return confirmDelete()"><i class="fas fa-times"></i> Delete</button>
        
        @endif
        <a class="btn btn-primary" href="{{ route('employees.edit', [$employee->slug()]) }}"><i class="fas fa-edit"></i> Edit</a>
        @if ($employee->status == 'Active')
        <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Actions
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="#">Branch Change</a>
                <a class="dropdown-item" href="#">Grade Change</a>
                <a class="dropdown-item" href="#">Job Function Change</a>
                <a class="dropdown-item" href="#">Supervisor Change</a>
            </div>
        </div>
        @endif
        </form>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header bg-white">
                <strong>BASIC INFORMATION</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <tr>
                        <td width="35%" style="font-weight: bold;">First Name</td>
                        <td>{{ $employee->first_name }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Middle Name</td>
                        <td>{{ $employee->middle_name }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Surname</td>
                        <td>{{ $employee->surname }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Date of Birth</td>
                        <td>{{ date('j F, Y', strtotime($employee->date_of_birth)) }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Gender</td>
                        <td>{{ $employee->gender }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header bg-white">
                <strong>CONTACT INFORMATION</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <tr>
                        <td width="35%" style="font-weight: bold;">Contact Address</td>
                        <td>{!! nl2br($employee->address) !!}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Mobile Number</td>
                        <td>{{ $employee->mobile_number }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Alternate Number</td>
                        <td>{{ $employee->alternate_number }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Alternate Email</td>
                        <td>{{ $employee->alternate_email }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6">
        @if ($employee->status == 'Active')
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header bg-white">
                <strong>EMPLOYMENT INFORMATION</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <tr>
                        <td width="35%" style="font-weight: bold;">Employee Number</td>
                        <td>{{ $employee->number }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Username</td>
                        <td>{{ $employee->username }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Branch</td>
                        <td>@if ($employee->branch_id) {{ $employee->branch->code.' - '.$employee->branch->name }} @endif</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Grade</td>
                        <td>@if ($employee->grade_id) {{ $employee->grade->name.' ('.$employee->grade->code.')' }} @endif</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Department</td>
                        <td>@if ($employee->job_function_id) {{ $employee->jobFunction->unit->department->name }} @endif</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Unit</td>
                        <td>@if ($employee->job_function_id) {{ $employee->jobFunction->unit->name }} @endif</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Job Function</td>
                        <td>@if ($employee->job_function_id) {{ $employee->jobFunction->name }} @endif</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Supervisor</td>
                        <td>@if ($employee->supervisor) {{ App\HrmEmployee::whereId($employee->supervisor)->first()->first_name.' '.App\HrmEmployee::whereId($employee->supervisor)->first()->surname }} @endif</td>
                    </tr>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection