<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Redirect;
use App\HrmBranch;

class BranchesController extends Controller
{
    public function index() {
        $branches = HrmBranch::all();
        return view('hrms.branches.index', compact('branches'));
    }
    
    public function create() {
        return view('hrms.branches.create');
    }
    
    public function store() {
        $input = Input::all();
        $error = "";
        if (HrmBranch::where('name', $input['name'])->count() != 0) {
            $error .= "Branch name already exists.<br />";
        }
        if (HrmBranch::where('code', $input['code'])->count() != 0) {
            $error .= "Branch code already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Oops!</span><br />'.$error)
                    ->withInput();
        } else {
            $branch = HrmBranch::create($input);
            if ($branch) {
                HrmsController::logActivity('Branch was created - '.$branch->name.'.');
                return Redirect::route('branches.index')
                        ->with('success', '<span class="font-weight-bold">Successful!</span><br />Branch has been created.');
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function edit(HrmBranch $branch) {
        return view('hrms.branches.edit', compact('branch'));
    }
    
    public function update(HrmBranch $branch) {
        $input = array_except(Input::all(), '_method');
        $error = "";
        if (HrmBranch::where('name', $input['name'])->where('id', '<>', $branch->id)->count() != 0) {
            $error .= "Branch name already exists.<br />";
        }
        if (HrmBranch::where('code', $input['code'])->where('id', '<>', $branch->id)->count() != 0) {
            $error .= "Branch code already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Oops!</span><br />'.$error)
                    ->withInput();
        } else {
            if ($branch->update($input)) {
                HrmsController::logActivity('Branch was updated - '.$branch->name.'.');
                return Redirect::route('branches.index')
                        ->with('success', '<span class="font-weight-bold">Successful!</span><br />Branch has been updated.');
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function disable(HrmBranch $branch) {
        $input['active'] = false;
        $branch->update($input);
        HrmsController::logActivity('Branch was disabled - '.$branch->name.'.');
        return Redirect::route('branches.index')
                ->with('success', '<span class="font-weight-bold">Successful!</span><br />Branch has been disabled.');
    }
    
    public function enable(HrmBranch $branch) {
        $input['active'] = true;
        $branch->update($input);
        HrmsController::logActivity('Branch was enabled - '.$branch->name.'.');
        return Redirect::route('branches.index')
                ->with('success', '<span class="font-weight-bold">Successful!</span><br />Branch has been enabled.');
    }
}
