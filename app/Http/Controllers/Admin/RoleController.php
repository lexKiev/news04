<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Permission;
use App\Model\admin\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
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
    	
    	$roles = Role::all();
        return view('admin.roles.list',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$permissions = Permission::all();
    	
	    return view('admin.roles.role',compact('roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
	        	'name' => 'required|max:50|unique:roles',
	        ]);
        $role = new Role;
        $role->name = $request->name;
        $role->save();
	    $role->permissions()->sync($request->permission);
        return redirect(route('roles.index'));
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
	    $permissions = Permission::all();
    	$role = Role::find($id);
        return view('admin.roles.edit', compact('role','permissions'));
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
	    $this->validate($request, [
		    'name' => 'required|max:50',
	    ]);
	    
	    $role = Role::find($id);
	    $role->name = $request->name;
	    $role->save();
	    $role->permissions()->sync($request->permission);
	    return redirect(route('roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::where('id',$id)->delete();
        return redirect()->back();
    }
}
