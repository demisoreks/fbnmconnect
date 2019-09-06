<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\HrmActivity;
use App\HrmEmployee;
use App\HrmGrade;
use App\HrmDepartment;

use App\Charts\TalentAcquisition;
use App\Charts\Distribution;

class HrmsController extends Controller
{
    public function index() {
        $departments = new Distribution();
        $department_names = [];
        $department_employees = [];
        $department_color_codes = [];
        $i = 0;
        foreach (HrmDepartment::where('active', true)->orderBy('name')->get() as $department) {
            $department_names[$i] = $department->name;
            $department_employees[$i] = 0;
            foreach (HrmEmployee::where('status', 'Active')->whereNotNull('job_function_id')->get() as $employee) {
                if ($employee->jobFunction->unit->department->id == $department->id) {
                    $department_employees[$i] += 1;
                }
            }
            $department_color_codes[$i] = '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            $i ++;
        }
        $departments->labels($department_names);
        $departments->dataset('Departments', 'doughnut', $department_employees)->backgroundColor($department_color_codes);
        
        $grades = new Distribution();
        $grade_codes = [];
        $grade_employees = [];
        $grade_color_codes = [];
        $i = 0;
        foreach (HrmGrade::where('active', true)->orderBy('level')->get() as $grade) {
            $grade_codes[$i] = $grade->code;
            $grade_employees[$i] = count(HrmEmployee::where('status', 'Active')->where('grade_id', $grade->id)->get());
            $grade_color_codes[$i] = '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            $i ++;
        }
        $grades->labels($grade_codes);
        $grades->dataset('Grades', 'doughnut', $grade_employees)->backgroundColor($grade_color_codes);
        
        $gender = new Distribution();
        $gender_codes = ['M', 'F', 'O'];
        $gender_employees = [];
        $gender_color_codes = [];
        $i = 0;
        foreach ($gender_codes as $gender_code) {
            $gender_employees[$i] = count(HrmEmployee::where('status', 'Active')->where('gender', $gender_code)->get());
            $gender_color_codes[$i] = '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            $i ++;
        }
        $gender->labels($gender_codes);
        $gender->dataset('Gender', 'doughnut', $gender_employees)->backgroundColor($gender_color_codes);
        
        $talents = new TalentAcquisition();
        $talents_labels = [];
        $new_talents_count = [];
        for ($i=0; $i<12; $i++) {
            $age = 11-$i;
            $talents_labels[$i] = date('Y-m', strtotime('- '.$age.' months'));
            $new_talents_count[$i] = count(HrmEmployee::where('status', 'Active')->whereMonth('employment_date', '=', date('n')-$age)->get());
        }
        $talents->labels($talents_labels);
        $talents->dataset('New Talents', 'line', $new_talents_count);
        //$talents->dataset('Exited Staff', 'line', [2,3,1,0,3,6,4,3,2,1,3,4]);
        
        return view('hrms.index', compact('talents', 'departments', 'grades', 'gender'));
    }
    
    static function logActivity($detail) {
        HrmActivity::create([
            'employee_id' => Session::get('fbnm_user')['id'],
            'detail' => $detail,
            'source_ip' => $_SERVER['REMOTE_ADDR']
        ]);
    }
    
    public function approvals() {
        return view('hrms.approvals');
    }
}
