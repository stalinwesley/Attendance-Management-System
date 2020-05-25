<?php

namespace App\Http\Controllers;

use Datatables;
use App\Holiday;
use App\Employee;
use Carbon\Carbon;
use App\Attendance;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
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
        $employees = Employee::with('user')->get()->pluck('user.name','user.id');
        $departments = Department::all()->pluck('name','id');        
        $now = Carbon::now();
        $year = $now->format('Y');
        $month = $now->format('m');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        // dd($employees,$departments,$month,$year);
        return \view('attendance.index',compact('employees','departments','month','year','daysInMonth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attendance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $date_format = 'd-m-Y';
        $time_format = 'h:i a';
        $timezone = 'Asia/Kolkata';
        $date = Carbon::createFromFormat($date_format, $request->attendancedate)->format('Y-m-d');
        $clockIn = Carbon::createFromFormat($time_format, $request->timein, $timezone);
        // $clockIn->setTimezone('UTC');
        $clockIn = $clockIn->format('H:i:s');
        if ($request->timeout != '') {
            $clockOut = Carbon::createFromFormat('h:i A', $request->timeout, $timezone);
            // $clockOut->setTimezone('UTC');
            $clockOut = $clockOut->format('H:i:s');
            $clockOut = $date . ' ' . $clockOut;
        } else {
            $clockOut = null;
        }

        $attendance = Attendance::where('employee_id', $request->userid)
            ->where(DB::raw('DATE(`clock_in_time`)'), "$date")
            ->whereNull('clock_out_time')
            ->first();

        $clockInCount = Attendance::getTotalUserClockIn($date, $request->userid);

        if (!is_null($attendance)) {
            $attendance->update([
                'employee_id' => $request->userid,
                'clock_in_time' => $date . ' ' . $clockIn,
                'clock_out_time' => $clockOut,
                'working_from' => $request->workfrom,
                'late' => ($request->late) ? 'yes' : 'no',
                'half_day' => ($request->halfday) ? 'yes' : 'no'
            ]);
        } else {

                Attendance::create([
                    'employee_id' => $request->userid,
                    'clock_in_time' => $date . ' ' . $clockIn,
                    'clock_out_time' => $clockOut,
                    'working_from' => $request->workfrom,
                    'late' => ($request->late) ? 'yes' : 'no',
                    'half_day' => ($request->halfday) ? 'yes' : 'no'
                ]);
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
    }

    public function getAttendances()
    {
        $request = request();
        // dd($request->month);
        $employees = 
        // Employee::with('attendance')->get();

        Employee::with(['attendance'=>function($query)use($request){
            if($request->input('month')){
                $query->whereRaw('MONTH(attendances.clock_in_time) = ?', [$request->month]);
            }
            if($request->input('year')){
                $query->whereRaw('YEAR(attendances.clock_in_time) = ?', [$request->year]);
            }
        }
        
        ])
        ->join('users','users.id','=','employees.user_id')
        ->join('images','images.imageable_id','=','users.id')
        ->select('users.id','users.name','users.email','users.created_at','employees.department_id','images.url');


      
        if($request->input('department')){
            $employees->where('department_id', $request->department);
        }
        if($request->input('employee')){
            $employees->where('users.id', $request->employee);
        }
        // $employees->

        // dd($employees->get()->toArray());
        return Datatables::of($employees)
        ->addColumn('action',function($data){
                $button = "<a href='".route('department.edit',$data->id)."'  class='btn btn-danger btn-circle btn-sm mr-2'><i class='fas fa-edit'></i></a>";
                $button .= "<a href='javascript:void(0)' onclick='deletedattendance(this)' data-id='".$data->id."' class='btn btn-danger btn-circle btn-sm'><i class='fas fa-trash'></i></a>";
                return $button;
        })->addColumn('created_at',function($data){
            $created_at = new Carbon($data->created_at);
            return $created_at->diffForHumans();
        })
        ->addColumn('attendace',function($data){
            $r = $this->getEmployeeAttendance($data);
            return $r;
        })
        ->rawColumns(['action','created_at','attendace'])
        ->make(true);
    }

    public function getEmployeeAttendance($employee)
    {
        $request = request();
        $now = Carbon::now();
        $year = $now->format('Y');
        $month = $now->format('m');
        
        $request->input('month',$month);
        $request->input('year',$year);
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);
        $timezone = 'Asia/Kolkata';
       $now = Carbon::now()->timezone($timezone);
       $requestedDate = Carbon::parse(Carbon::parse('01-' . $request->month . '-' . $request->year))->endOfMonth();

            $dataTillToday = array_fill(1, $now->copy()->format('d'), 'Absent');
 
            $dataFromTomorrow = [];
            if (($now->copy()->addDay()->format('d') != $daysInMonth) && !$requestedDate->isPast()) {
                $dataFromTomorrow = array_fill($now->copy()->addDay()->format('d'), ($daysInMonth - $now->copy()->format('d')), '-');
            } else {
                $dataFromTomorrow = array_fill($now->copy()->addDay()->format('d'), ($daysInMonth - $now->copy()->format('d')), 'Absent');
            }  
            $final[$employee->id . '#' . $employee->name] = array_replace($dataTillToday, $dataFromTomorrow);

            $holidays = Holiday::whereRaw('MONTH(holidays.date) = ?', [$request->month])->whereRaw('YEAR(holidays.date) = ?', [$request->year])->get();

 
            foreach ($employee->attendance as $attendance) {
                $final[$employee->id . '#' . $employee->name][Carbon::parse($attendance->clock_in_time)->timezone($timezone)->day] = '<a href="javascript:;" class="view-attendance" data-toggle="modal" data-target="#viewattModel" data-attendance-id="' . $attendance->id . '"><i class="fa fa-check text-success"></i></a>';
            }
 
            $image = ($employee->url) ? 
            '<img src="' . Storage::url($employee->url). '" alt="user" class="img-circle" width="30" height="30"> ' : '<img src="' . asset('img/default-profile-3.png') . '" alt="user" class="img-circle" width="30" height="30"> ';

            $final[$employee->id . '#' . $employee->name][] = '<a class="userData" id="userID' . $employee->id . '" data-employee-id="' . $employee->id . '"  href="' . route('employee.info', $employee->id) . '">' . $image . ' ' . ucwords($employee->name) . '</a>';
            
            foreach ($holidays as $holiday) {
                $date = new Carbon($holiday->date);
                $final[$employee->id . '#' . $employee->name][$date->format('j')] = 'Holiday';
            }
                // dd($final);
            $view = view('attendance.summary_data', compact('daysInMonth','final'))->render();
        return $view;
    }
    

    public function detail($id)
    {

        $date_format = 'd-m-Y';
        $time_format = 'h:i a';
        $timezone = 'Asia/Kolkata';


        $attendance = Attendance::find($id);
        $attendance->clock_in_time = new Carbon($attendance->clock_in_time);
        $attendance->clock_out_time = new Carbon($attendance->clock_out_time);


        $attendanceActivity = Attendance::userAttendanceByDate($attendance->clock_in_time->format('Y-m-d'), $attendance->clock_in_time->format('Y-m-d'), $attendance->employee_id);



        $firstClockIn = Attendance::where(DB::raw('DATE(attendances.clock_in_time)'), $attendance->clock_in_time->format('Y-m-d'))
            ->where('employee_id', $attendance->employee_id)->orderBy('id', 'asc')->first();
        $lastClockOut = Attendance::where(DB::raw('DATE(attendances.clock_in_time)'), $attendance->clock_in_time->format('Y-m-d'))
            ->where('employee_id', $attendance->employee_id)->orderBy('id', 'desc')->first();

        $startTime = Carbon::parse($firstClockIn->clock_in_time)->timezone($timezone);

        if (!is_null($lastClockOut->clock_out_time)) {
            $endTime = Carbon::parse($lastClockOut->clock_out_time)->timezone($timezone);
        } elseif (($lastClockOut->clock_in_time->timezone($timezone)->format('Y-m-d') != Carbon::now()->timezone($timezone)->format('Y-m-d')) && is_null($lastClockOut->clock_out_time)) {
            $endTime = Carbon::parse($startTime->format('Y-m-d') . ' ' . "18:00:00", $timezone);
            $notClockedOut = true;
        } else {
            $notClockedOut = true;
            $endTime = Carbon::now()->timezone($timezone);
        }

        $totalTime = $endTime->diff($startTime, true)->format('%h.%i');

        $attendance = $attendance;
        $global = new \StdClass;
        $global->time_format = 'h:i a';
        $global->date_format = 'd-m-Y';
        $global->timezone = 'Asia/Kolkata';

        return view('attendance.attendance_info', compact('attendance','totalTime','endTime','notClockedOut','startTime','attendanceActivity','firstClockIn','lastClockOut','global'))->render();
    }
    
}
