<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Redirect;
use App\HrmGrade;

class GradesController extends Controller
{
    public function index() {
        $grades = HrmGrade::all();
        return view('hrms.grades.index', compact('grades'));
    }
    
    public function create() {
        return view('hrms.grades.create');
    }
    
    public function store() {
        $input = Input::all();
        $error = "";
        if (HrmGrade::where('name', $input['name'])->count() != 0) {
            $error .= "Grade name already exists.<br />";
        }
        if (HrmGrade::where('code', $input['code'])->count() != 0) {
            $error .= "Grade code already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Oops!</span><br />'.$error)
                    ->withInput();
        } else {
            $grade = HrmGrade::create($input);
            if ($grade) {
                HrmsController::logActivity('Grade was created - '.$grade->name.'.');
                return Redirect::route('grades.index')
                        ->with('success', '<span class="font-weight-bold">Successful!</span><br />Grade has been created.');
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function edit(HrmGrade $grade) {
        return view('hrms.grades.edit', compact('grade'));
    }
    
    public function update(HrmGrade $grade) {
        $input = array_except(Input::all(), '_method');
        $error = "";
        if (HrmGrade::where('name', $input['name'])->where('id', '<>', $grade->id)->count() != 0) {
            $error .= "Grade name already exists.<br />";
        }
        if (HrmGrade::where('code', $input['code'])->where('id', '<>', $grade->id)->count() != 0) {
            $error .= "Grade code already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Oops!</span><br />'.$error)
                    ->withInput();
        } else {
            if ($grade->update($input)) {
                HrmsController::logActivity('Grade was updated - '.$grade->name.'.');
                return Redirect::route('grades.index')
                        ->with('success', '<span class="font-weight-bold">Successful!</span><br />Grade has been updated.');
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function disable(HrmGrade $grade) {
        $input['active'] = false;
        $grade->update($input);
        HrmsController::logActivity('Grade was disabled - '.$grade->name.'.');
        return Redirect::route('grades.index')
                ->with('success', '<span class="font-weight-bold">Successful!</span><br />Grade has been disabled.');
    }
    
    public function enable(HrmGrade $grade) {
        $input['active'] = true;
        $grade->update($input);
        HrmsController::logActivity('Grade was enabled - '.$grade->name.'.');
        return Redirect::route('grades.index')
                ->with('success', '<span class="font-weight-bold">Successful!</span><br />Grade has been enabled.');
    }
}
