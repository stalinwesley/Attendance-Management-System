<?php

namespace App\Http\Controllers;

use Datatables;
use App\Holiday;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\HolidayRequest;
use App\Http\Requests\UpdateHolidayRequest;

class HolidayController extends Controller
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
        $years = [];
       $lastFiveYear = (int)Carbon::now()->subYears(5)->format('Y');
       $nextYear = (int)Carbon::now()->addYear()->format('Y');
        $year = Carbon::now()->format('Y');
       for($i=$lastFiveYear;$i <= $nextYear;$i++ ){
           $years [] =$i;
       }
    //    dd($years);
        return view('holiday.index',compact('years','year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('holiday.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HolidayRequest $request)
    {
        $holiday = new Holiday;
        $holiday->date = $request->date;
        $holiday->occassion = $request->occassion;
        $holiday->save();
        return \redirect()->route('holiday.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Holiday $holiday)
    {
        //
        return view('holiday.show',compact('holiday'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        //
        return view('holiday.edit',compact('holiday'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHolidayRequest $request, Holiday $holiday)
    {
        //
        $holiday->update($request->only(['date','occassion']));

        return \redirect()->route('holiday.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        //
        $skill->delete();
        return back();

    }
    public function getHolidays()
    {
        $holidays = Holiday::latest()->get();
        return Datatables::of($holidays)
        ->addColumn('action',function($data){
                $button = "<a href='".route('holiday.edit',$data->id)."'  class='btn btn-danger btn-circle btn-sm mr-2'><i class='fas fa-edit'></i></a>";
                $button .= "<a href='javascript:void(0)' onclick='deleteskill(this)' data-id='".$data->id."' class='btn btn-danger btn-circle btn-sm'><i class='fas fa-trash'></i></a>";
                return $button;
        })->addColumn('created_at',function($data){
            $created_at = new Carbon($data->created_at);
            return $created_at->diffForHumans();
        })
        ->rawColumns(['action','created_at'])
        ->make(true);
        // return Datatables::of(Department::query())->make();
    }
}
