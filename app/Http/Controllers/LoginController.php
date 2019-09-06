<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Redirect;
use Session;
use App\HrmEmployee;

use App\Charts\Performance;

class LoginController extends Controller
{
    public function index() {
        return view('welcome');
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
                $login_attempts = $employee->login_attempts + 1;
                $employee->update(['login_attempts' => $login_attempts, 'last_attempt' => date('Y-m-d H:i:s')]);
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Login error!</span><br />Invalid password.');
            }
        } else {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Login error!</span><br />Username does not exist.');
        }
        if ($input['username'] == "system" && $input['password'] == "default") {
            $user = ['id' => 1, 'username' => 'system', 'first_name' => 'System', 'surname' => 'Administrator'];
            Session::put('fbnm_user', $user);
            return Redirect::route('dashboard');
        } else {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Login error!</span><br />Invalid username or password.');
        }
    }
    
    static function checkAccess() {
        if (Session::has('fbnm_user')) {
            return true;
        } else {
            return false;
        }
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
