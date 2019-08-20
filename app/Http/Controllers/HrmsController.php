<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\HrmActivity;

class HrmsController extends Controller
{
    public function index() {
        return view('hrms.index');
    }
    
    static function logActivity($detail) {
        HrmActivity::create([
            'employee_id' => Session::get('fbnm_user')['id'],
            'detail' => $detail,
            'source_ip' => $_SERVER['REMOTE_ADDR']
        ]);
    }
}
