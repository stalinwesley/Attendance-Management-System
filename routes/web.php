<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('login','Auth\LoginController@index');
Route::get('register','Auth\LoginController@register');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/employee', 'EmployeeController@index')->name('employee.index');
// Route::get('/employee/add', 'EmployeeController@create')->name('employee.create');
// Route::post('/employee/store', 'EmployeeController@store')->name('employee.store');

Route::resources([
    'holiday' => 'HolidayController',
    'department' => 'DepartmentController',
    'designation' => 'DesignationController',
    'leave' => 'LeaveController',
    'employee' => 'EmployeeController',
    'attendance' => 'AttendanceController',
    'skill' => 'SkillsController',
    'users' => 'UsersController',
    'roles' => 'RolesController',
    'permissions' => 'PermissionsController',
    'test' => 'TestController',
]);  
Route::get('listdepartments', 'DepartmentController@getDepartments')->name('deparment.list');

Route::get('listdesignations', 'DesignationController@getDesignations')->name('designation.list');

Route::get('listemployees', 'EmployeeController@getEmployees')->name('employee.list');

Route::get('listusers', 'UsersController@getUsers')->name('users.list');

Route::get('listroles', 'RolesController@getRoles')->name('roles.list');

Route::get('listskills', 'SkillsController@getSkills')->name('skill.list');

Route::get('listpermissions', 'PermissionsController@getPermissions')->name('permissions.list');

Route::get('listholidays', 'HolidayController@getHolidays')->name('holiday.list');

Route::get('listattendances', 'AttendanceController@getAttendances')->name('attendance.list');

Route::post('storemediaemployee', 'EmployeeController@storeMedia')->name('employee.storemedia');


Route::get('attendance/mark/{id}/{day}/{month}/{year}', ['uses' => 'AttendanceController@mark'])->name('attendance.mark');

Route::get('employeeinfo/{id}','EmployeeController@show')->name('employee.info');


Route::get('attendanceinfo/{id}','AttendanceController@detail')->name('attendance.info');