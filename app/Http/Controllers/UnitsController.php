<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Redirect;
use App\HrmDepartment;
use App\HrmUnit;
use App\HrmJobFunction;

class UnitsController extends Controller
{
    public function index(HrmDepartment $department) {
        $units = HrmUnit::where('department_id', $department->id)->get();
        return view('hrms.units.index', compact('department', 'units'));
    }
    
    public function create(HrmDepartment $department) {
        return view('hrms.units.create', compact('department'));
    }
    
    public function store(HrmDepartment $department) {
        $input = Input::all();
        $error = "";
        if (HrmUnit::where('name', $input['name'])->where('department_id', $department->id)->count() != 0) {
            $error .= "Unit name already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Oops!</span><br />'.$error)
                    ->withInput();
        } else {
            $input['department_id'] = $department->id;
            $unit = HrmUnit::create($input);
            if ($unit) {
                HrmsController::logActivity('Unit was created - '.$unit->name.'.');
                return Redirect::route('departments.units.index', [$department->slug()])
                        ->with('success', '<span class="font-weight-bold">Successful!</span><br />Unit has been created.');
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function edit(HrmDepartment $department, HrmUnit $unit) {
        return view('hrms.units.edit', compact('department', 'unit'));
    }
    
    public function update(HrmDepartment $department, HrmUnit $unit) {
        $input = array_except(Input::all(), '_method');
        $error = "";
        if (HrmUnit::where('name', $input['name'])->where('department_id', $department->id)->where('id', '<>', $unit->id)->count() != 0) {
            $error .= "Unit name already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Oops!</span><br />'.$error)
                    ->withInput();
        } else {
            if ($unit->update($input)) {
                HrmsController::logActivity('Unit was updated - '.$unit->name.'.');
                return Redirect::route('departments.units.index', [$department->slug()])
                        ->with('success', '<span class="font-weight-bold">Successful!</span><br />Unit has been updated.');
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function disable(HrmDepartment $department, HrmUnit $unit) {
        $input['active'] = false;
        $unit->update($input);
        HrmsController::logActivity('Unit was disabled - '.$unit->name.'.');
        return Redirect::route('departments.units.index', [$department->slug()])
                ->with('success', '<span class="font-weight-bold">Successful!</span><br />Unit has been disabled.');
    }
    
    public function enable(HrmDepartment $department, HrmUnit $unit) {
        $input['active'] = true;
        $unit->update($input);
        HrmsController::logActivity('Unit was enabled - '.$unit->name.'.');
        return Redirect::route('departments.units.index', [$department->slug()])
                ->with('success', '<span class="font-weight-bold">Successful!</span><br />Unit has been enabled.');
    }
    
    public function get_job_functions(int $unit_id) {
        return HrmJobFunction::where('unit_id', $unit_id)->where('active', true)->orderBy('name')->get()->toJson();
    }
}
