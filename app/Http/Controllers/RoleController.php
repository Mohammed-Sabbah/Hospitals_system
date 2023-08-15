<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Role::all();
        return view('admin.roles.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|min:3|max:20',
            'guard_name'=>'required|string|in:admin,web'
        ]);

        $role = new Role();
        $role->name=$request->get('name');
        $role->guard_name=$request->get('guard_name');

        $saved=$role->save();
        if($saved){
            session()->flash('message', 'Role Created Successfuly');
            return redirect()->route('roles.index');
        }
        else{
            session()->flash('message', 'Role creating failed');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>'required|string|min:3|max:20',
            'guard_name'=>'required|string|in:admin,web'
        ]);

        $role->name=$request->get('name');
        $role->guard_name=$request->get('guard_name');

        $saved=$role->save();
        if($saved){
            session()->flash('message', 'Role Updated Successfuly');
            return redirect()->route('roles.index');
        }
        else{
            session()->flash('message', 'Role Updating failed');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $deleted=$role->delete();
        return response()->json(
            [
                'message' => $deleted ? 'Role deleted successfuly' : 'Role deleting failed',
                'icon' => $deleted ? 'success' : 'danger'
            ],
            $deleted ? Response::HTTP_OK  : Response::HTTP_BAD_REQUEST
        );
    }
}
