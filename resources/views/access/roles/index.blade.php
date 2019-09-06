@extends('access.module', ['page_title' => 'Roles', 'menu' => 'access'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('links.roles.create', [$link->slug()]) }}"><i class="fas fa-plus"></i> New Role</a>
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
                                    <th><strong>TITLE</strong></th>
                                    <th width="10%"><strong>ALL</strong></th>
                                    <th width="15%"><strong>DEPARTMENTS</strong></th>
                                    <th width="15%"><strong>UNITS</strong></th>
                                    <th width="15%"><strong>JOB FUNCTIONS</strong></th>
                                    <th width="20%"><strong>EMPLOYEES</strong></th>
                                    <th width="10%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    @if ($role->active)
                                <tr>
                                    <td>{{ $role->title }}</td>
                                    <td>
                                        @if ($role->all)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                    <td>
                                        <?php
                                        if ($role->departments != "" && $role->departments != null) {
                                            $departments = [];
                                            $i = 0;
                                            foreach (explode(",", $role->departments) as $department_id) {
                                                $departments[$i] = App\HrmDepartment::whereId($department_id)->first()->name;
                                                $i ++;
                                            }
                                            echo implode("<br />", $departments);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($role->units != "" && $role->units != null) {
                                            $units = [];
                                            $i = 0;
                                            foreach (explode(",", $role->units) as $unit_id) {
                                                $units[$i] = App\HrmUnit::whereId($unit_id)->first()->name;
                                                $i ++;
                                            }
                                            echo implode("<br />", $units);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($role->job_functions != "" && $role->job_functions != null) {
                                            $job_functions = [];
                                            $i = 0;
                                            foreach (explode(",", $role->job_functions) as $job_function_id) {
                                                $job_functions[$i] = App\HrmJobFunction::whereId($job_function_id)->first()->name;
                                                $i ++;
                                            }
                                            echo implode("<br />", $job_functions);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($role->employees != "" && $role->employees != null) {
                                            $employees = [];
                                            $i = 0;
                                            foreach (explode(",", $role->employees) as $employee_id) {
                                                $employees[$i] = App\HrmEmployee::whereId($employee_id)->first()->surname.', '.App\HrmEmployee::whereId($employee_id)->first()->first_name;
                                                $i ++;
                                            }
                                            echo implode("<br />", $employees);
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a title="Edit" href="{{ route('links.roles.edit', [$link->slug(), $role->slug()]) }}"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                        <a title="Trash" href="{{ route('links.roles.disable', [$link->slug(), $role->slug()]) }}" onclick="return confirmDisable()"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
            <div class="card">
                <div class="card-header bg-white text-primary" id="heading4" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                            <strong>Inactive</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion1">
                    <div class="card-body">
                        <table id="myTable2" class="display-1 table table-condensed table-hover table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th><strong>TITLE</strong></th>
                                    <th width="10%"><strong>ALL</strong></th>
                                    <th width="15%"><strong>DEPARTMENTS</strong></th>
                                    <th width="15%"><strong>UNITS</strong></th>
                                    <th width="15%"><strong>JOB FUNCTIONS</strong></th>
                                    <th width="20%"><strong>EMPLOYEES</strong></th>
                                    <th width="10%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    @if (!$role->active)
                                <tr>
                                    <td>{{ $role->title }}</td>
                                    <td>
                                        @if ($role->all)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                    <td>
                                        <?php
                                        if ($role->departments != "" && $role->departments != null) {
                                            $departments = [];
                                            $i = 0;
                                            foreach (explode(",", $role->departments) as $department_id) {
                                                $departments[$i] = App\HrmDepartment::whereId($department_id)->first()->name;
                                                $i ++;
                                            }
                                            echo implode("<br />", $departments);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($role->units != "" && $role->units != null) {
                                            $units = [];
                                            $i = 0;
                                            foreach (explode(",", $role->units) as $unit_id) {
                                                $units[$i] = App\HrmUnit::whereId($unit_id)->first()->name;
                                                $i ++;
                                            }
                                            echo implode("<br />", $units);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($role->job_functions != "" && $role->job_functions != null) {
                                            $job_functions = [];
                                            $i = 0;
                                            foreach (explode(",", $role->job_functions) as $job_function_id) {
                                                $job_functions[$i] = App\HrmJobFunction::whereId($job_function_id)->first()->name;
                                                $i ++;
                                            }
                                            echo implode("<br />", $job_functions);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($role->employees != "" && $role->employees != null) {
                                            $employees = [];
                                            $i = 0;
                                            foreach (explode(",", $role->employees) as $employee_id) {
                                                $employees[$i] = App\HrmEmployee::whereId($employee_id)->first()->surname.', '.App\HrmEmployee::whereId($employee_id)->first()->first_name;
                                                $i ++;
                                            }
                                            echo implode("<br />", $employees);
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a title="Restore" href="{{ route('links.roles.enable', [$link->slug(), $role->slug()]) }}"><i class="fas fa-undo"></i></a>
                                    </td>
                                </tr>
                                    @endif
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