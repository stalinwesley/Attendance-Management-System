<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Designation;
use Illuminate\Http\Request;
use App\Http\Requests\DesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;
use Datatables;

class DesignationController extends Controller
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
        return \view('designation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('designation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DesignationRequest $request)
    {
        $designation = new Designation;
        $designation->name = $request->name;
        $designation->user_id = auth()->id();
        $designation->save();
        //
        return \redirect()->route('designation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        //
        return view('designation.show',compact('designation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        //
        return view('designation.edit',compact('designation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        //
        $designation->update(array_merge($request->only(['name']),['user_id'=>auth()->id()]));

        return \redirect()->route('designation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        //
        $designation->delete();
        return back();

    }
    public function getDesignations()
    {
        $designation = Designation::latest()->get();
        return Datatables::of($designation)
        ->addColumn('action',function($data){
                $button = "<a href='".route('designation.edit',$data->id)."'  class='btn btn-danger btn-circle btn-sm mr-2'><i class='fas fa-edit'></i></a>";
                $button .= "<a href='javascript:void(0)' onclick='deletedepartment(this)' data-id='".$data->id."' class='btn btn-danger btn-circle btn-sm'><i class='fas fa-trash'></i></a>";
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
