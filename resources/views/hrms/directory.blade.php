@extends('app', ['page_title' => 'Employee Directory'])

@section('module')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="myTable3" class="display-1 table table-condensed table-hover table-striped">
                    <thead>
                        <tr class="text-center">
                            <th width="5%"><strong>GRADE LEVEL</strong></th>
                            <th><strong>NAME</strong></th>
                            <th width="15%"><strong>BRANCH</strong></th>
                            <th width="15%"><strong>DEPARTMENT</strong></th>
                            <th width="15%"><strong>UNIT</strong></th>
                            <th width="15%"><strong>JOB FUNCTION</strong></th>
                            <th width="10%"><strong>MOBILE NO.</strong></th>
                            <th width="15%"><strong>EMAIL</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)

                        <tr>
                            <td align="right">@if ($employee->grade_id) {{ $employee->grade->level }} @endif</td>
                            <td>{{ $employee->surname.', '.$employee->first_name.' '.$employee->middle_name  }}</td>
                            <td>@if ($employee->branch_id) {{ $employee->branch->code.' - '.$employee->branch->name }} @endif</td>
                            <td>@if ($employee->job_function_id) {{ $employee->jobFunction->unit->department->name }} @endif</td>
                            <td>@if ($employee->job_function_id) {{ $employee->jobFunction->unit->name }} @endif</td>
                            <td>@if ($employee->job_function_id) {{ $employee->jobFunction->name }} @endif</td>
                            <td>{{ $employee->mobile_number }}</td>
                            <td>{{ $employee->username }}</td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

