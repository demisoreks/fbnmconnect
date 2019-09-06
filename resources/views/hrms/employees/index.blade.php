@extends('hrms.module', ['page_title' => 'Active Employees', 'menu' => 'employee'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('employees.create') }}"><i class="fas fa-plus"></i> New Employee</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div id="accordion1">
            <div class="card">
                <div class="card-header bg-white text-primary" id="heading3" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                            <strong>Active</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordion1">
                    <div class="card-body">
                        <table id="myTable1" class="display-1 table table-condensed table-hover table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th width="12%"><strong>EMPLOYEE NUMBER</strong></th>
                                    <th><strong>NAME</strong></th>
                                    <th width="15%"><strong>BRANCH</strong></th>
                                    <th width="20%"><strong>GRADE</strong></th>
                                    <th width="20%"><strong>DEPARTMENT</strong></th>
                                    <th width="10%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    
                                <tr>
                                    <td align="right">{{ $employee->number }}</td>
                                    <td>{{ $employee->surname.', '.$employee->first_name.' '.$employee->middle_name  }}</td>
                                    <td>@if ($employee->branch_id) {{ $employee->branch->code.' - '.$employee->branch->name }} @endif</td>
                                    <td>@if ($employee->grade_id) {{ $employee->grade->name.' ('.$employee->grade->code.')' }} @endif</td>
                                    <td>@if ($employee->job_function_id) {{ $employee->jobFunction->unit->department->name }} @endif</td>
                                    <td class="text-center">
                                        <a title="View Employee" href="{{ route('employees.show', [$employee->slug()]) }}" class="btn btn-sm btn-primary btn-block"><i class="fas fa-eye"></i> View</a>
                                    </td>
                                </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection