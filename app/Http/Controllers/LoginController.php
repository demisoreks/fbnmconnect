<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Redirect;
use Session;
use App\HrmEmployee;
use App\HrmJobFunction;
use App\HrmUnit;
use App\HrmDepartment;
use App\AccLink;
use App\AccRole;

use App\Charts\Performance;

class LoginController extends Controller
{
    public function index() {
        if (Session::has('fbnm_user')) {
            return Redirect::route('dashboard');
        }
        
        return view('welcome')
                ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    }
    
    public static function hashPassword($password, $times) {
        $hashed_password = hash("sha512", $password, false);
        if ($times > 1) {
            return LoginController::hashPassword($hashed_password, $times-1);
        } else {
            return $hashed_password;
        }
    }
    
    public function authenticate() {
        $input = Input::all();
        $employees = HrmEmployee::where('username', $input['username'])->where('status', 'Active');
        if ($employees->count() != 0) {
            $employee = $employees->first();
            if ($input['password'] == "default") {
                $user = ['id' => $employee->id, 'username' => $employee->username, 'first_name' => $employee->first_name, 'surname' => $employee->surname];
                Session::put('fbnm_user', $user);
                $employee->update([
                    'last_login' => date("Y-m-d H:i:s"),
                    'last_login_ip' => $_SERVER['REMOTE_ADDR']
                ]);
                return Redirect::route('dashboard');
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Login error!</span><br />Invalid password.');
            }
        } else {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Login error!</span><br />Username does not exist.');
        }
    }
    
    static function checkAccess() {
        if (Session::has('fbnm_user')) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function getRoles(AccLink $link) {
        $employee = HrmEmployee::whereId(Session::get('fbnm_user')['id'])->first();
        $roles = [];
        foreach (AccRole::where('link_id', $link->id)->get() as $role) {
            if ($role->all) {
                array_push($roles, $role->id);
            } else {
                $employees = explode(',', $role->employees);
                if (in_array($employee->id, $employees)) {
                    array_push($roles, $role->id);
                } else {
                    if ($employee->job_function_id != null) {
                        $job_functions = explode(',', $role->job_functions);
                        if (in_array($employee->job_function_id, $job_functions)) {
                            array_push($roles, $role->id);
                        } else {
                            $unit_id = HrmJobFunction::whereId($employee->job_function_id)->first()->unit_id;
                            $units = explode(',', $role->units);
                            if (in_array($unit_id, $units)) {
                                array_push($roles, $role->id);
                            } else {
                                $department_id = HrmUnit::whereId($unit_id)->first()->department_id;
                                $departments = explode(',', $role->departments);
                                if (in_array($department_id, $departments)) {
                                    array_push($roles, $role->id);
                                }
                            }
                        }
                    }
                }
            }
        }
        return $roles;
    }
    
    public static function getAllRoles() {
        $all_roles = [];
        foreach (AccLink::where('active', true)->get() as $link) {
            $all_roles = array_merge($all_roles, LoginController::getRoles($link));
        }
        return $all_roles;
    }
    
    public static function allowed($roles) {
        $allowed = false;
        foreach ($roles as $role) {
            $r = AccRole::where('title', $role)->where('active', true);
            if ($r->count() > 0) {
                $role_id = $r->first()->id;
                if (in_array($role_id, LoginController::getAllRoles())) {
                    $allowed = true;
                    break;
                }
            }
        }
        return $allowed;
    }

    /*
    public function change_password(AccEmployee $employee) {
        return view('change_password', compact('employee'));
    }
    
    public function update_password(AccEmployee $employee) {
        $input = array_except(Input::all(), '_method');
        $input['password'] = LoginController::hashPassword($input['password'].$employee->salt, 8);
        $input['change_password'] = false;
        unset($input['password2']);
        if ($employee->update($input)) {
            $halo_user = $employee;
            AccActivity::create([
                'employee_id' => $halo_user->id,
                'detail' => 'Password was updated - '.$employee->username.'.',
                'source_ip' => $_SERVER['REMOTE_ADDR']
            ]);
            return Redirect::route('welcome')
                    ->with('success', '<span class="font-weight-bold">Password change successful!</span><br />You can now log in.');
        } else {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Unknown error!</span><br />Please contact administrator.')
                    ->withInput();
        }
    }
     * */
    
    public function dashboard() {
        $cabal = new Performance();
        $cabal->labels(['Deposits', 'Loans']);
        $i = 0;
        $budget = [500000, 400000];
        $actual = [350000, 220000];
        $cabal->dataset('Budget', 'bar', $budget)->color('#0d47a1')->backgroundColor('#4285f4');
        $cabal->dataset('Actual', 'bar', $actual)->color('#cc0000')->backgroundColor('#ff4444');
        $cabal->title('My Performance (in \'000s)');
        
        return view('dashboard', compact('cabal'));
    }
    
    public function logout() {
        if (Session::has('fbnm_user')) {
            //$employee = Session::get('halo_user');
            Session::forget('fbnm_user');
            if (!isset($_SESSION)) session_start();
            unset($_SESSION['fbnm_user']);
            /*AccActivity::create([
                'employee_id' => $employee->id, 
                'detail' => 'User logged out.', 
                'source_ip' => $_SERVER["REMOTE_ADDR"]
            ]);*/
        }
        return Redirect::route('welcome')
                ->with('success', '<span class="font-weight-bold">Successful!</span><br />You have logged out.');
    }
}
