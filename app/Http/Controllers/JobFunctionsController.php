<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Redirect;
use App\HrmDepartment;
use App\HrmUnit;
use App\HrmJobFunction;

class JobFunctionsController extends Controller
{
    public function index(HrmDepartment $department, HrmUnit $unit) {
        $job_functions = HrmJobFunction::where('unit_id', $unit->id)->get();
        return view('hrms.job_functions.index', compact('department', 'unit', 'job_functions'));
    }
    
    public function create(HrmDepartment $department, HrmUnit $unit) {
        return view('hrms.job_functions.create', compact('department', 'unit'));
    }
    
    public function store(HrmDepartment $department, HrmUnit $unit) {
        $input = Input::all();
        $error = "";
        if (HrmJobFunction::where('name', $input['name'])->where('unit_id', $unit->id)->count() != 0) {
            $error .= "Job function name already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Oops!</span><br />'.$error)
                    ->withInput();
        } else {
            $input['unit_id'] = $unit->id;
            $job_function = HrmJobFunction::create($input);
            if ($job_function) {
                HrmsController::logActivity('Job function was created - '.$job_function->name.'.');
                return Redirect::route('departments.units.job_functions.index', [$department->slug(), $unit->slug()])
                        ->with('success', '<span class="font-weight-bold">Successful!</span><br />Job function has been created.');
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function edit(HrmDepartment $department, HrmUnit $unit, HrmJobFunction $job_function) {
        return view('hrms.job_functions.edit', compact('department', 'unit', 'job_function'));
    }
    
    public function update(HrmDepartment $department, HrmUnit $unit, HrmJobFunction $job_function) {
        $input = array_except(Input::all(), '_method');
        $error = "";
        if (HrmJobFunction::where('name', $input['name'])->where('unit_id', $unit->id)->where('id', '<>', $job_function->id)->count() != 0) {
            $error .= "Job function name already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Oops!</span><br />'.$error)
                    ->withInput();
        } else {
            if ($job_function->update($input)) {
                HrmsController::logActivity('Job function was updated - '.$unit->name.'.');
                return Redirect::route('departments.units.job_functions.index', [$department->slug(), $unit->slug()])
                        ->with('success', '<span class="font-weight-bold">Successful!</span><br />Job function has been updated.');
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function disable(HrmDepartment $department, HrmUnit $unit, HrmJobFunction $job_function) {
        $input['active'] = false;
        $job_function->update($input);
        HrmsController::logActivity('Job function was disabled - '.$job_function->name.'.');
        return Redirect::route('departments.units.job_functions.index', [$department->slug(), $unit->slug()])
                ->with('success', '<span class="font-weight-bold">Successful!</span><br />Job function has been disabled.');
    }
    
    public function enable(HrmDepartment $department, HrmUnit $unit, HrmJobFunction $job_function) {
        $input['active'] = true;
        $job_function->update($input);
        HrmsController::logActivity('Job function was enabled - '.$job_function->name.'.');
        return Redirect::route('departments.units.job_functions.index', [$department->slug(), $unit->slug()])
                ->with('success', '<span class="font-weight-bold">Successful!</span><br />Job function has been enabled.');
    }
}
