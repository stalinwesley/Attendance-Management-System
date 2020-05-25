<?php

namespace App\Http\Controllers;

use App\Role;
use Datatables;
use Carbon\Carbon;
use App\{User,Image};
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
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
        abort_if(Gate::denies('user_index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $r = new Carbon('2020-05-20 03:47:32');
        // dd($r->diffForHumans());
        // dd(User::find(1)->image);
        return \view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //
        $roles = Role::all()->pluck('title','id');
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate(['status'=>'required']);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->mobile;
        $user->status = $request->status;
        $user->save();
        $image = new Image;
        if(request()->has('profileimage'))
        {
            $image->url = request()->profileimage->store('profileimage','public');
            $user->image()->save($image);
        }
        $user->roles()->sync($request->role);
        return \redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd(Storage::url($user->image->url));
        $roles = Role::all()->pluck('title','id');

        return view('users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        //
        abort_if(Gate::denies('user_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate(['status'=>'required']);
        $user = User::find($user->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->mobile = $request->mobile;
        $user->status = $request->status;
        $user->save();


        if(isset($user->image->url) && $user->image->url != null)
        $image = Image::find($user->image->id);
        else
        $image = new Image;

        // dd($image);
        if(request()->has('profileimage'))
        {
            $image->url = request()->profileimage->store('profileimage','public');
            $user->image()->save($image);
        }
        $user->roles()->sync($request->role);

        return \redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {        
        abort_if(Gate::denies('user_delete '), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //
        if(isset($user->image->id))
        {
            $image = Image::find($user->image->id);
        }
        
        $user->delete();
        if (isset($image)) {
            $image->delete();
        }
        return back();

    }
    public function getUsers()
    {
        $users = User::withCount('employee')->get();
        // dd($users);
        return Datatables::of($users)
        ->addColumn('action',function($data){
                $button = "<a href='".route('users.edit',$data->id)."'  class='btn btn-danger btn-circle btn-sm mr-2'><i class='fas fa-edit'></i></a>";
                $button .= "<a href='javascript:void(0)' onclick='deleteuser(this)' data-id='".$data->id."' class='btn btn-danger btn-circle btn-sm'><i class='fas fa-trash'></i></a>";
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
