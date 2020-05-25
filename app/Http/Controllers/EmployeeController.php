<?php

namespace App\Http\Controllers;

use App\Image;
use App\Skill;
use Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmpolyeeCreateRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\{Employee,Department,Designation,User};

class EmployeeController extends Controller
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
        //
        return \view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department = Department::all();
        $designation = Designation::all();
        $skills = Skill::all()->pluck('title','id');
        //
        // dd($skills);
        return view('employee.create',compact('department','designation','skills'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        // dd($request->all());
        $user = new User;
        $user->name = $request->employee_name;
        $user->email = $request->employee_email;
        $user->password = bcrypt($request->employee_password);
        $user->status = $request->status;
        $user->mobile = $request->mobile;
        $user->save();
        $employee = new Employee;
        $employee->designation_id = $request->designation;
        $employee->department_id = $request->department;
        $employee->address = $request->address;
        $employee->emp_id = $request->employee_id;
        $employee->joining_date = $request->joiningdate;
        $employee->last_date = $request->lastdate;
        $employee->gender = $request->gender;
       
        // $employee->user_id = $user->id;
        if($request->photo){
            copy(storage_path('tmp/uploads/'.$request->photo),storage_path('app/public/profileimage/').$request->photo);
            if(isset($user->image->id)){
                $image = Image::find($user->image->id);
            }
            else{
                $image = new Image;
            }
            $image->url = "profileimage/".$request->photo;
            $user->image()->save($image);
        }
        $user->employee()->save($employee);
        $employee->skills()->detach($employee->skills);
        $employee->skills()->sync($request->skills,[]);
        // $employee->department()->attach([$request->department]);

        //
        return \redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = User::find($id);
        return view('employee.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $department = Department::all();
        $designation = Designation::all();
        $skills = Skill::all()->pluck('title','id');
     
        //
        return view('employee.edit',compact('employee','department','designation','skills'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        // dd($employee);
        $user = User::find($employee->user_id);
        $user->name = $request->employee_name;
        $user->email = $request->employee_email;
        $user->password = $request->employee_password ? bcrypt($request->employee_password) : $employee->user->password;
        $user->status = $request->status;
        $user->mobile = $request->mobile;
        $user->save();
        $employee = Employee::find($employee->id);
        $employee->designation_id = $request->designation;
        $employee->department_id = $request->department;
        $employee->address = $request->address;
        $employee->emp_id = $request->employee_id;
        $employee->joining_date = $request->joiningdate;
        $employee->last_date = $request->lastdate;
        $employee->gender = $request->gender;
        $employee->skills()->detach($employee->skills);
        $employee->skills()->sync($request->skills,[]);
        if($request->photo){
            copy(storage_path('tmp/uploads/'.$request->photo),storage_path('app/public/profileimage/').$request->photo);
            if(isset($user->image->id)){
                $image = Image::find($user->image->id);
            }
            else{
                $image = new Image;
            }
            $image->url = "profileimage/".$request->photo;
            $user->image()->save($image);
        }
        // $employee->user_id = $user->id;

        $user->employee()->save($employee);

        //
        // $designation->update(array_merge($request->only(['name']),['user_id'=>auth()->id()]));

        return \redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
        $user = User::find($employee->user_id);
        $employee->delete();
        $user->delete();
        return back();

    }
    public function getEmployees()
    {
        $employees = Employee::allemployees();
        return Datatables::of($employees)
        ->addColumn('action',function($data){
                $button = "<a href='".route('employee.edit',$data['id'])."'  class='btn btn-danger btn-circle btn-sm mr-2'><i class='fas fa-edit'></i></a>";
                $button .= "<a href='javascript:void(0)' onclick='deletedepartment(this)' data-id='".$data['id']."' class='btn btn-danger btn-circle btn-sm'><i class='fas fa-trash'></i></a>";
                return $button;
        })->addColumn('name',function($data){
          return $data['user']['name'];  
        })->addColumn('email',function($data){
          return $data['user']['email'];  
        })
        ->rawColumns(['action'])
        ->make(true);
        // return Datatables::of(Department::query())->make();
    }
    public function storeMedia(Request $request)
   {
// Validates file size
       if (request()->has('size')) {
           $this->validate(request(), [
               'file' => 'max:' . request()->input('size') * 1024,
           ]);
       }

// If width or height is preset - we are validating it as an image
       if (request()->has('width') || request()->has('height')) {
           $this->validate(request(), [
               'file' => sprintf(
                   'image|dimensions:max_width=%s,max_height=%s',
                   request()->input('width', 100000),
                   request()->input('height', 100000)
               ),
           ]);
       }

       $path = storage_path('tmp/uploads');

       try {
           if (!file_exists($path)) {
               mkdir($path, 0755, true);
           }
       } catch (\Exception $e) {
       }

       $file = $request->file('file');

       $name = uniqid() . '_' . trim($file->getClientOriginalName());

       $file->move($path, $name);

       return response()->json([
           'name'          => $name,
           'original_name' => $file->getClientOriginalName(),
       ]);
   }
}
