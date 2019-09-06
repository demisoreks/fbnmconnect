<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Redirect;
use App\AccLink;
use App\AccRole;

class RolesController extends Controller
{
    public function index(AccLink $link) {
        $roles = AccRole::where('link_id', $link->id)->get();
        return view('access.roles.index', compact('link', 'roles'));
    }
    
    public function create(AccLink $link) {
        return view('access.roles.create', compact('link'));
    }
    
    public function store(AccLink $link) {
        $input = Input::all();
        $error = "";
        if (AccRole::where('title', $input['title'])->where('link_id', $link->id)->count() != 0) {
            $error .= "Role title already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Oops!</span><br />'.$error)
                    ->withInput();
        } else {
            $input['link_id'] = $link->id;
            if ($input['all'] == 1) {
                $input['departments'] = "";
                $input['units'] = "";
                $input['job_functions'] = "";
                $input['employees'] = "";
            } else {
                if (isset($input['departments'])) {
                    $input['departments'] = implode(",", $input['departments']);
                } else {
                    $input['departments'] = "";
                }
                if (isset($input['units'])) {
                    $input['units'] = implode(",", $input['units']);
                } else {
                    $input['units'] = "";
                }
                if (isset($input['job_functions'])) {
                    $input['job_functions'] = implode(",", $input['job_functions']);
                } else {
                    $input['job_functions'] = "";
                }
                if (isset($input['employees'])) {
                    $input['employees'] = implode(",", $input['employees']);
                } else {
                    $input['employees'] = "";
                }
            }
            $role = AccRole::create($input);
            if ($role) {
                AccessController::logActivity('Role was created - '.$role->title.'.');
                return Redirect::route('links.roles.index', [$link->slug()])
                        ->with('success', '<span class="font-weight-bold">Successful!</span><br />Role has been created.');
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function edit(AccLink $link, AccRole $role) {
        return view('access.roles.edit', compact('link', 'role'));
    }
    
    public function update(AccLink $link, AccRole $role) {
        $input = array_except(Input::all(), '_method');
        $error = "";
        if (AccRole::where('title', $input['title'])->where('link_id', $link->id)->where('id', '<>', $role->id)->count() != 0) {
            $error .= "Role title already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Oops!</span><br />'.$error)
                    ->withInput();
        } else {
            if ($input['all'] == 1) {
                $input['departments'] = "";
                $input['units'] = "";
                $input['job_functions'] = "";
                $input['employees'] = "";
            } else {
                if (isset($input['departments'])) {
                    $input['departments'] = implode(",", $input['departments']);
                } else {
                    $input['departments'] = "";
                }
                if (isset($input['units'])) {
                    $input['units'] = implode(",", $input['units']);
                } else {
                    $input['units'] = "";
                }
                if (isset($input['job_functions'])) {
                    $input['job_functions'] = implode(",", $input['job_functions']);
                } else {
                    $input['job_functions'] = "";
                }
                if (isset($input['employees'])) {
                    $input['employees'] = implode(",", $input['employees']);
                } else {
                    $input['employees'] = "";
                }
            }
            if ($role->update($input)) {
                AccessController::logActivity('Role was updated - '.$role->title.'.');
                return Redirect::route('links.roles.index', [$link->slug()])
                        ->with('success', '<span class="font-weight-bold">Successful!</span><br />Role has been updated.');
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function disable(AccLink $link, AccRole $role) {
        $input['active'] = false;
        $role->update($input);
        AccessController::logActivity('Role was disabled - '.$role->title.'.');
        return Redirect::route('links.roles.index', [$link->slug()])
                ->with('success', '<span class="font-weight-bold">Successful!</span><br />Role has been disabled.');
    }
    
    public function enable(AccLink $link, AccRole $role) {
        $input['active'] = true;
        $role->update($input);
        AccessController::logActivity('Role was enabled - '.$role->title.'.');
        return Redirect::route('links.roles.index', [$link->slug()])
                ->with('success', '<span class="font-weight-bold">Successful!</span><br />Role has been enabled.');
    }
}
