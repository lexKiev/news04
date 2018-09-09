<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Admin;
use App\Model\admin\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('can:admin.view');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$users = Admin::all();
        return view('admin.user.list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$roles = Role::all();
	    return view('admin.user.user',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
	        'name' => 'required|string|max:255',
	        'email' => 'required|string|email|max:255|unique:admins',
	        'phone' => 'required|numeric',
	        'password' => 'required|string|min:6|confirmed',
        ]);
        
        $request['password'] = bcrypt($request->password);
        
        $user = Admin::create($request->all());
	    $user->roles()->sync($request->role);
        
        return redirect(route('user.index'))->with('message', "User $request->name successfully created");
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
    	$user = Admin::find($id);
    	$roles = Role::all();
        return view('admin.user.edit',compact('user','roles'));
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
	    $this->validate($request,[
		    'name' => 'required|string|max:255',
		    'email' => 'required|string|email|max:255',
		    'phone' => 'required|numeric',
	    ]);
	    
		//if status not 1 (active selected) setting to 0
	    if (!isset($request->status)){
		    $request->request->add(['status'=>'0']);
	    }
	    
	    $user = Admin::where('id',$id)->update($request->except('_token','_method','role'));
	    Admin::find($id)->roles()->sync($request->role);
	    
	    return redirect(route('user.index'))->with('message', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::where('id',$id)->delete();
        return redirect()->back()->with('message','User deleted');
    }
}
