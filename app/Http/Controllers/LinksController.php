<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Redirect;
use App\AccLink;

class LinksController extends Controller
{
    public function index() {
        $links = AccLink::all();
        return view('access.links.index', compact('links'));
    }
    
    public function create() {
        return view('access.links.create');
    }
    
    public function store() {
        $input = Input::all();
        $error = "";
        if (AccLink::where('title', $input['title'])->count() != 0) {
            $error .= "Link title already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Oops!</span><br />'.$error)
                    ->withInput();
        } else {
            $link = AccLink::create($input);
            if ($link) {
                AccessController::logActivity('Link was created - '.$link->title.'.');
                return Redirect::route('links.index')
                        ->with('success', '<span class="font-weight-bold">Successful!</span><br />Link has been created.');
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function edit(AccLink $link) {
        return view('access.links.edit', compact('link'));
    }
    
    public function update(AccLink $link) {
        $input = array_except(Input::all(), '_method');
        $error = "";
        if (AccLink::where('title', $input['title'])->where('id', '<>', $link->id)->count() != 0) {
            $error .= "Link title already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Oops!</span><br />'.$error)
                    ->withInput();
        } else {
            if ($link->update($input)) {
                AccessController::logActivity('Link was updated - '.$link->title.'.');
                return Redirect::route('links.index')
                        ->with('success', '<span class="font-weight-bold">Successful!</span><br />Link has been updated.');
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function disable(AccLink $link) {
        $input['active'] = false;
        $link->update($input);
        AccessController::logActivity('Link was disabled - '.$link->title.'.');
        return Redirect::route('links.index')
                ->with('success', '<span class="font-weight-bold">Successful!</span><br />Link has been disabled.');
    }
    
    public function enable(AccLink $link) {
        $input['active'] = true;
        $link->update($input);
        AccessController::logActivity('Link was enabled - '.$link->title.'.');
        return Redirect::route('links.index')
                ->with('success', '<span class="font-weight-bold">Successful!</span><br />Link has been enabled.');
    }
}
