<?php

namespace App\Http\Controllers;

use App\User;
use Datatables;
use Carbon\Carbon;
use App\Department;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Department::withCount('employees')->get()->toArray());
        return \view('department.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        $department = new Department;
        $department->name = $request->name;
        $department->notes = $request->notes;
        $department->user_id = auth()->id();
        $department->save();
        //
        return \redirect()->route('department.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
        return view('department.show',compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
        return view('department.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        //
        $department->update($request->all());

        return \redirect()->route('department.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
        $department->delete();
        return back();

    }
    public function getDepartments()
    {
        $departments = Department::withCount('employees')->get();
        // dd($departments);
        return Datatables::of($departments)
        ->addColumn('action',function($data){
                $button = "<a href='".route('department.edit',$data->id)."'  class='btn btn-danger btn-circle btn-sm mr-2'><i class='fas fa-edit'></i></a>";
                $button .= "<a href='javascript:void(0)' onclick='deletedepartment(this)' data-id='".$data->id."' class='btn btn-danger btn-circle btn-sm'><i class='fas fa-trash'></i></a>";
                return $button;
        })->addColumn('created_at',function($data){
            $created_at = new Carbon($data->created_at);
            return $created_at->diffForHumans();
        })->addColumn('employees',function($data){
            $employees_count = "<a href='".route('employee.show',$data->id)."'>".$data->employees_count." employees</a>";
            return $employees_count;
        })
        ->rawColumns(['action','created_at','employees'])
        ->make(true);
        // return Datatables::of(Department::query())->make();
    }
}
