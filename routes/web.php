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
])->middleware('auth.user');

Route::get('hrms/grades/{grade}/disable', [
    'as' => 'grades.disable', 'uses' => 'GradesController@disable'
])->middleware('auth.user');
Route::get('hrms/grades/{grade}/enable', [
    'as' => 'grades.enable', 'uses' => 'GradesController@enable'
])->middleware('auth.user');
Route::resource('hrms/grades', 'GradesController')->middleware('auth.user');
Route::bind('grades', function($value, $route) {
    return App\HrmGrade::findBySlug($value)->first();
});

Route::get('hrms/departments/{department}/disable', [
    'as' => 'departments.disable', 'uses' => 'DepartmentsController@disable'
])->middleware('auth.user');
Route::get('hrms/departments/{department}/enable', [
    'as' => 'departments.enable', 'uses' => 'DepartmentsController@enable'
])->middleware('auth.user');
Route::resource('hrms/departments', 'DepartmentsController')->middleware('auth.user');
Route::bind('departments', function($value, $route) {
    return App\HrmDepartment::findBySlug($value)->first();
});

Route::get('hrms/departments/{department}/units/{unit}/disable', [
    'as' => 'departments.units.disable', 'uses' => 'UnitsController@disable'
])->middleware('auth.user');
Route::get('hrms/departments/{department}/units/{unit}/enable', [
    'as' => 'departments.units.enable', 'uses' => 'UnitsController@enable'
])->middleware('auth.user');
Route::resource('hrms/departments.units', 'UnitsController')->middleware('auth.user');
Route::bind('units', function($value, $route) {
    return App\HrmUnit::findBySlug($value)->first();
});

Route::get('hrms/departments/{department}/units/{unit}/job_functions/{job_function}/disable', [
    'as' => 'departments.units.job_functions.disable', 'uses' => 'JobFunctionsController@disable'
])->middleware('auth.user');
Route::get('hrms/departments/{department}/units/{unit}/job_functions/{job_function}/enable', [
    'as' => 'departments.units.job_functions.enable', 'uses' => 'JobFunctionsController@enable'
])->middleware('auth.user');
Route::resource('hrms/departments.units.job_functions', 'JobFunctionsController')->middleware('auth.user');
Route::bind('job_functions', function($value, $route) {
    return App\HrmJobFunction::findBySlug($value)->first();
});

Route::get('hrms/branches/{branch}/disable', [
    'as' => 'branches.disable', 'uses' => 'BranchesController@disable'
])->middleware('auth.user');
Route::get('hrms/branches/{branch}/enable', [
    'as' => 'branches.enable', 'uses' => 'BranchesController@enable'
])->middleware('auth.user');
Route::resource('hrms/branches', 'BranchesController')->middleware('auth.user');
Route::bind('branches', function($value, $route) {
    return App\HrmBranch::findBySlug($value)->first();
});