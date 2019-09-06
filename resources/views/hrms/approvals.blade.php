@extends('hrms.module', ['page_title' => 'Approvals', 'menu' => 'employee'])

@section('content')
<div class="row">
    <div class="col-12">
        <div id="accordion1">
            <div class="card">
                <div class="card-header bg-white text-primary" id="heading3" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                            <strong>Pending Approvals</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordion1">
                    <div class="card-body">
                        <table id="myTable1" class="display-1 table table-condensed table-hover table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th><strong>APPROVAL TYPE</strong></th>
                                    <th width="20%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td>New Employees <span class="badge badge-dark">{{ App\HrmEmployee::where('status', 'New')->count() }}</span></td>
                                    <td class="text-center">
                                        <a title="View List" href="{{ route('employees.pending') }}" class="btn btn-sm btn-primary btn-block"><i class="fas fa-eye"></i> View List</a>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection