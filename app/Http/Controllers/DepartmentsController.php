<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Redirect;
use App\HrmDepartment;
use App\HrmUnit;

class DepartmentsController extends Controller
{
    public function index() {
        $departments = HrmDepartment::all();
        return view('hrms.departments.index', compact('departments'));
    }
    
    public function create() {
        return view('hrms.departments.create');
    }
    
    public function store() {
        $input = Input::all();
        $error = "";
        if (HrmDepartment::where('name', $input['name'])->count() != 0) {
            $error .= "Department name already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Oops!</span><br />'.$error)
                    ->withInput();
        } else {
            $department = HrmDepartment::create($input);
            if ($department) {
                HrmsController::logActivity('Department was created - '.$department->name.'.');
                return Redirect::route('departments.index')
                        ->with('success', '<span class="font-weight-bold">Successful!</span><br />Department has been created.');
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function edit(HrmDepartment $department) {
        return view('hrms.departments.edit', compact('department'));
    }
    
    public function update(HrmDepartment $department) {
        $input = array_except(Input::all(), '_method');
        $error = "";
        if (HrmDepartment::where('name', $input['name'])->where('id', '<>', $department->id)->count() != 0) {
            $error .= "Department name already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Oops!</span><br />'.$error)
                    ->withInput();
        } else {
            if ($department->update($input)) {
                HrmsController::logActivity('Department was updated - '.$department->name.'.');
                return Redirect::route('departments.index')
                        ->with('success', '<span class="font-weight-bold">Successful!</span><br />Department has been updated.');
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function disable(HrmDepartment $department) {
        $input['active'] = false;
        $department->update($input);
        HrmsController::logActivity('Department was disabled - '.$department->name.'.');
        return Redirect::route('departments.index')
                ->with('success', '<span class="font-weight-bold">Successful!</span><br />Department has been disabled.');
    }
    
    public function enable(HrmDepartment $department) {
        $input['active'] = true;
        $department->update($input);
        HrmsController::logActivity('Department was enabled - '.$department->name.'.');
        return Redirect::route('departments.index')
                ->with('success', '<span class="font-weight-bold">Successful!</span><br />Department has been enabled.');
    }
    
    public function get_units(int $department_id) {
        return HrmUnit::where('department_id', $department_id)->where('active', true)->orderBy('name')->get()->toJson();
    }
}
