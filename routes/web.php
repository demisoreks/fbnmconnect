<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    'as' => 'welcome', 'uses' => 'LoginController@index'
]);
Route::post('authenticate', [
    'as' => 'authenticate', 'uses' => 'LoginController@authenticate'
]);
Route::get('change_password/{employee}', [
    'as' => 'change_password', 'uses' => 'LoginController@change_password'
]);
Route::post('update_password/{employee}', [
    'as' => 'update_password', 'uses' => 'LoginController@update_password'
]);
Route::get('dashboard', [
    'as' => 'dashboard', 'uses' => 'LoginController@dashboard'
])->middleware('auth.user');
Route::get('logout', [
    'as' => 'logout', 'uses' => 'LoginController@logout'
]);

Route::get('hrms', [
    'as' => 'hrms', 'uses' => 'HrmsController@index'
])->middleware('auth.user:HRManager,HROfficer');

Route::get('hrms/grades/{grade}/disable', [
    'as' => 'grades.disable', 'uses' => 'GradesController@disable'
])->middleware('auth.user:HRManager');
Route::get('hrms/grades/{grade}/enable', [
    'as' => 'grades.enable', 'uses' => 'GradesController@enable'
])->middleware('auth.user:HRManager');
Route::resource('hrms/grades', 'GradesController')->middleware('auth.user:HRManager');
Route::bind('grades', function($value, $route) {
    return App\HrmGrade::findBySlug($value)->first();
});

Route::get('hrms/departments/{department_id}/get_units', [
    'as' => 'departments.get_units', 'uses' => 'DepartmentsController@get_units'
]);
Route::get('hrms/departments/{department}/disable', [
    'as' => 'departments.disable', 'uses' => 'DepartmentsController@disable'
])->middleware('auth.user:HRManager');
Route::get('hrms/departments/{department}/enable', [
    'as' => 'departments.enable', 'uses' => 'DepartmentsController@enable'
])->middleware('auth.user:HRManager');
Route::resource('hrms/departments', 'DepartmentsController')->middleware('auth.user:HRManager');
Route::bind('departments', function($value, $route) {
    return App\HrmDepartment::findBySlug($value)->first();
});

Route::get('hrms/units/{unit_id}/get_job_functions', [
    'as' => 'units.get_job_functions', 'uses' => 'UnitsController@get_job_functions'
]);
Route::get('hrms/departments/{department}/units/{unit}/disable', [
    'as' => 'departments.units.disable', 'uses' => 'UnitsController@disable'
])->middleware('auth.user:HRManager');
Route::get('hrms/departments/{department}/units/{unit}/enable', [
    'as' => 'departments.units.enable', 'uses' => 'UnitsController@enable'
])->middleware('auth.user:HRManager');
Route::resource('hrms/departments.units', 'UnitsController')->middleware('auth.user:HRManager');
Route::bind('units', function($value, $route) {
    return App\HrmUnit::findBySlug($value)->first();
});

Route::get('hrms/departments/{department}/units/{unit}/job_functions/{job_function}/disable', [
    'as' => 'departments.units.job_functions.disable', 'uses' => 'JobFunctionsController@disable'
])->middleware('auth.user:HRManager');
Route::get('hrms/departments/{department}/units/{unit}/job_functions/{job_function}/enable', [
    'as' => 'departments.units.job_functions.enable', 'uses' => 'JobFunctionsController@enable'
])->middleware('auth.user:HRManager');
Route::resource('hrms/departments.units.job_functions', 'JobFunctionsController')->middleware('auth.user:HRManager');
Route::bind('job_functions', function($value, $route) {
    return App\HrmJobFunction::findBySlug($value)->first();
});

Route::get('hrms/branches/{branch}/disable', [
    'as' => 'branches.disable', 'uses' => 'BranchesController@disable'
])->middleware('auth.user:HRManager');
Route::get('hrms/branches/{branch}/enable', [
    'as' => 'branches.enable', 'uses' => 'BranchesController@enable'
])->middleware('auth.user:HRManager');
Route::resource('hrms/branches', 'BranchesController')->middleware('auth.user:HRManager');
Route::bind('branches', function($value, $route) {
    return App\HrmBranch::findBySlug($value)->first();
});

Route::post('hrms/employees/{employee}/submit_approval', [
    'as' => 'employees.submit_approval', 'uses' => 'EmployeesController@submit_approval'
])->middleware('auth.user:HRManager');
Route::get('hrms/employees/{employee}/approve', [
    'as' => 'employees.approve', 'uses' => 'EmployeesController@approve'
])->middleware('auth.user:HRManager');
Route::get('hrms/employees/pending', [
    'as' => 'employees.pending', 'uses' => 'EmployeesController@pending'
])->middleware('auth.user:HRManager');
Route::resource('hrms/employees', 'EmployeesController')->middleware('auth.user:HRManager,HROfficer');
Route::bind('employees', function($value, $route) {
    return App\HrmEmployee::findBySlug($value)->first();
});

Route::get('hrms/approvals', [
    'as' => 'approvals', 'uses' => 'HrmsController@approvals'
])->middleware('auth.user:HRManager');

Route::get('access', [
    'as' => 'access', 'uses' => 'AccessController@index'
])->middleware('auth.user:AccessAdmin');

Route::get('access/links/{link}/disable', [
    'as' => 'links.disable', 'uses' => 'LinksController@disable'
])->middleware('auth.user:AccessAdmin');
Route::get('access/links/{link}/enable', [
    'as' => 'links.enable', 'uses' => 'LinksController@enable'
])->middleware('auth.user:AccessAdmin');
Route::resource('access/links', 'LinksController')->middleware('auth.user:AccessAdmin');
Route::bind('links', function($value, $route) {
    return App\AccLink::findBySlug($value)->first();
});

Route::get('access/links/{link}/roles/{role}/disable', [
    'as' => 'links.roles.disable', 'uses' => 'RolesController@disable'
])->middleware('auth.user:AccessAdmin');
Route::get('access/links/{link}/roles/{role}/enable', [
    'as' => 'links.roles.enable', 'uses' => 'RolesController@enable'
])->middleware('auth.user:AccessAdmin');
Route::resource('access/links.roles', 'RolesController')->middleware('auth.user:AccessAdmin');
Route::bind('roles', function($value, $route) {
    return App\AccRole::findBySlug($value)->first();
});

Route::get('hrms/directory', [
    'as' => 'directory', 'uses' => 'EmployeesController@directory'
])->middleware('auth.user');
Route::post('hrms/employees/{employee}/upload_picture', [
    'as' => 'employees.upload_picture', 'uses' => 'EmployeesController@upload_picture'
])->middleware('auth.user');