<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Department;
use App\Designation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employeecount = Employee::all()->count();
        $departmentcount = Department::all()->count();
        $designationcount = Designation::all()->count();

        return view('home');
    }
}
