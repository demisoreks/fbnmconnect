<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Redirect;
use App\HrmEmployee;

class EmployeesController extends Controller
{
    public function index() {
        $employees = HrmEmployee::where('status', 'Active')->get();
        return view('hrms.employees.index', compact('employees'));
    }
    
    public function create() {
        return view('hrms.employees.create');
    }
    
    public function store() {
        $input = Input::all();
        $error = "";
        if (HrmEmployee::where('number', $input['number'])->count() != 0) {
            $error .= "Employee number already exists.<br />";
        }
        if (HrmEmployee::where('username', $input['username'])->count() != 0) {
            $error .= "Username already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Oops!</span><br />'.$error)
                    ->withInput();
        } else {
            $input['first_name'] = strtoupper($input['first_name']);
            $input['middle_name'] = strtoupper($input['middle_name']);
            $input['surname'] = strtoupper($input['surname']);
            $input['status'] = "New";
            $employee = HrmEmployee::create($input);
            if ($employee) {
                HrmsController::logActivity('Employee was created - '.$employee->username.'.');
                return Redirect::route('employees.create')
                        ->with('success', '<span class="font-weight-bold">Successful!</span><br />Employee has been created for approval.');
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function edit(HrmEmployee $employee) {
        return view('hrms.employees.edit', compact('employee'));
    }
    
    public function update(HrmEmployee $employee) {
        $input = array_except(Input::all(), '_method');
        $error = "";
        if (HrmEmployee::where('number', $input['number'])->where('id', '<>', $employee->id)->count() != 0) {
            $error .= "Employee number already exists.<br />";
        }
        if (HrmEmployee::where('username', $input['username'])->where('id', '<>', $employee->id)->count() != 0) {
            $error .= "Employee username already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Oops!</span><br />'.$error)
                    ->withInput();
        } else {
            if ($employee->update($input)) {
                HrmsController::logActivity('Employee was updated - '.$employee->name.'.');
                return Redirect::route('employees.index')
                        ->with('success', '<span class="font-weight-bold">Successful!</span><br />Employee has been updated.');
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function pending() {
        $employees = HrmEmployee::where('status', 'New')->get();
        return view('hrms.employees.pending', compact('employees'));
    }
    
    public function show(HrmEmployee $employee) {
        return view('hrms.employees.show', compact('employee'));
    }
    
    public function destroy(HrmEmployee $employee) {
        $employee->delete();
        return Redirect::route('approvals')
                ->with('success', '<span class="font-weight-bold">Successful!</span><br />Employee has been completely deleted.');
    }
    
    public function approve(HrmEmployee $employee) {
        return view('hrms.employees.approve', compact('employee'));
    }
    
    public function submit_approval(HrmEmployee $employee) {
        $input = array_except(Input::all(), '_method');
        unset($input['unit_id']);
        unset($input['department_id']);
        $input['status'] = "Active";
        if ($employee->update($input)) {
            HrmsController::logActivity('Employee was approved - '.$employee->username.'.');
            return Redirect::route('employees.pending')
                    ->with('success', '<span class="font-weight-bold">Successful!</span><br />Employee has been approved.');
        } else {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                    ->withInput();
        }
    }
}
