<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} @if (isset($module)) | {{ $module }} @endif - {{ $page_title }}</title>
        
        {!! Html::style('css/app.css') !!}
        {!! Html::style('css/mdb.min.css') !!}
        {!! Html::style('css/datatables.min.css') !!}
        {!! Html::style('fontawesome/css/all.css') !!}
        
        {!! Html::script('js/jquery-3.3.1.min.js') !!}
        {!! Html::script('js/popper.min.js') !!}
        {!! Html::script('js/app.js') !!}
        {!! Html::script('js/mdb.min.js') !!}
        {!! Html::script('js/datatables.min.js') !!}
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        
        <script type="text/javascript">
            $(document).ready(function () {
                $('#myTable1').DataTable({
                    fixedHeader: true
                });
                $('#myTable2').DataTable({
                    fixedHeader: true
                });
                $('#myTable3').DataTable({
                    fixedHeader: true,
                    "order": [[ 0, "desc" ]],
                    "columnDefs": [
                        {
                            "targets": [ 0 ],
                            "visible": false,
                            "searchable": false
                        }
                    ]
                });
            });
            
            function confirmDisable() {
                if (confirm("Are you sure you want to disable this item?")) {
                    return true;
                } else {
                    return false;
                }
            }
            
            function confirmDelete() {
                if (confirm("Are you sure you want to completely delete this item?")) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>

        <!-- Styles -->
        
    </head>
    
    <?php
    $employee = App\HrmEmployee::whereId(Session::get('fbnm_user')['id'])->first();
    ?>
    
    <body style="background-color: #f6f7fb;">
        <div class="container-fluid" style="height: 100vh;">
            <div class="row bg-dark" style="padding: 15px 0;">
                <div class="col-md-6">
                    <div class="text-white float-left" style="display: flex; align-items: center; justify-content: center;">
                        <!--{{ Html::image('images/logo-new.jpg', 'Halogen Logo', ['width' => 60]) }}&nbsp;&nbsp;-->
                        <h3><span class="font-weight-bold">FBNM</span>Connect @if (isset($module)) | {{ $module }} @endif</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="float-right text-white" style="display: flex; align-items: center; justify-content: center; height: 100%;">
                        {{ Session::get('fbnm_user')['first_name']." ".Session::get('fbnm_user')['surname'] }}
                        @if (!isset($module))
                        &nbsp;
                        ​<span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if (File::exists('storage/pictures/'.$employee->id.'.jpg'))
                            {{ Html::image('storage/pictures/'.$employee->id.'.jpg', 'Profile picture', ['height' => '50px', 'class' => 'rounded-circle']) }}
                            @else
                            {{ Html::image('images/dummy-profile.png', 'Profile picture', ['height' => '50px', 'class' => 'rounded-circle']) }}
                            @endif
                        </span>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal1"><i class="fas fa-user"></i> My Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row bg-primary">
                <div class="col-12" style="height: 10px;">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="page-header" style="border-bottom: 1px solid #999; padding: 30px 0; margin-bottom: 20px; color: #999;">{{ $page_title }}</h1>
                </div>
            </div>
            @include('commons.message')
            @yield('module')
            <div class="row">
                <div class="col-12 justify-content-end text-right">
                    <div style="border-top: 1px solid #999; margin-top: 20px; padding: 10px 0;">Powered by <a href="http://www.fbnmortgages.com" target="_blank">FBN Mortgages</a></div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1Title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><strong>My Profile</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
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
                            </div>
                            <div class="col-md-4">
                                @if (File::exists('storage/pictures/'.$employee->id.'.jpg'))
                                {{ Html::image('storage/pictures/'.$employee->id.'.jpg', 'Profile picture', ['width' => '100%', 'class' => 'rounded-circle']) }}
                                @else
                                {{ Html::image('images/dummy-profile.png', 'Profile picture', ['width' => '100%', 'class' => 'rounded-circle']) }}
                                @endif
                                <legend>Change Picture</legend>
                                {!! Form::model(null, ['route' => ['employees.upload_picture', $employee->slug()], 'class' => 'form-group', 'files' => true]) !!}
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {!! Form::file('picture', $value = null, ['class' => 'form-control', 'placeholder' => 'Picture']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {!! Form::submit('Update Picture', ['class' => 'btn btn-primary btn-sm']) !!}
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="col-md-12">
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
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
