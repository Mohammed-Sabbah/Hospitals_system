<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Permission::all();
        return view('admin.permissions.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');
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

        $permission = new Permission();
        $permission->name=$request->get('name');
        $permission->guard_name=$request->get('guard_name');

        $saved=$permission->save();
        if($saved){
            session()->flash('message', 'permission Created Successfuly');
            return redirect()->route('permissions.index');
        }
        else{
            session()->flash('message', 'permission creating failed');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name'=>'required|string|min:3|max:20',
            'guard_name'=>'required|string|in:admin,web'
        ]);

        $permission->name=$request->get('name');
        $permission->guard_name=$request->get('guard_name');

        $saved=$permission->save();
        if($saved){
            session()->flash('message', 'permission Updated Successfuly');
            return redirect()->route('permissions.index');
        }
        else{
            session()->flash('message', 'permission updating failed');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $deleted=$permission->delete();
        return response()->json(
            [
                'message' => $deleted ? 'permission deleted successfuly' : 'permission deleting failed',
                'icon' => $deleted ? 'success' : 'danger'
            ],
            $deleted ? Response::HTTP_OK  : Response::HTTP_BAD_REQUEST
        );
    }
}
