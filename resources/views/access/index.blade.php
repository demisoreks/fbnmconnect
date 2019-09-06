@extends('access.module', ['page_title' => 'Access Manager', 'menu' => 'access'])

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header bg-white">
                <strong>LINKS</strong>
            </div>
            <div class="card-body">
                {!! $links->container() !!}
                {!! $links->script() !!}
            </div>
            <div class="card-footer">
                <a class="btn btn-primary btn-sm float-right"><i class="fas fa-eye"></i> View More</a>
            </div>
        </div>
    </div>
    <div class="col-lg-8" style="margin-bottom: 20px;">
        <div class="card">
            <div class="card-header bg-white">
                <strong>MOST RECENT LOGINS</strong>
            </div>
            <div class="card-body">
                <table id="myTable3" class="display-1 table table-condensed table-hover table-striped">
                    <thead>
                        <tr class="text-center">
                            <th width="25%"><strong>DATE/TIME</strong></th>
                            <th><strong>USER</strong></th>
                            <th width="25%"><strong>IP ADDRESS</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (App\HrmEmployee::where('status', 'Active')->get() as $employee)
                        <tr>
                            <td>{{ $employee->last_login }}</td>
                            <td>{{ $employee->username }}</td>
                            <td>{{ $employee->last_login_ip }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a class="btn btn-primary btn-sm float-right"><i class="fas fa-eye"></i> View More</a>
            </div>
        </div>
    </div>
</div>
@endsection