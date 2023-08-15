<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Admin::where('id', '!=', auth()->id())->get();
        return view('admin.admins.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:20',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = new Admin();
        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        $admin->password = Hash::make($request->get('password'));

        $saved = $admin->save();
        foreach ($request->get('roles') as $role_id) {

            $role = Role::find($role_id);
            $admin->assignRole($role);
        }

        if ($saved) {
            session()->flash('message', 'Admin Created Successfuly');
            return redirect()->route('admins.index');
        } else {
            session()->flash('message', 'Admin creating failed');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $roles = Role::all();
        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:20',
            'email' => 'required|email',
        ]);

        $admin->name = $request->get('name');
        $admin->email = $request->get('email');

        $saved = $admin->save();

        $roles = Role::all();
        $returned_roles = $request->get('roles');
        foreach ($roles as $role) {
            if ( $returned_roles!= null && in_array($role->id , $returned_roles)) {

                $admin->assignRole($role);

            } elseif ($admin->hasRole($role)) {
                $admin->removeRole($role);
            }
        }

        if ($saved) {
            session()->flash('message', 'Admin Created Successfuly');
            return redirect()->route('admins.index');
        } else {
            session()->flash('message', 'Admin creating failed');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $deleted = $admin->delete();
        return response()->json(
            [
                'message' => $deleted ? 'Admin deleted successfuly' : 'Admin deleting failed',
                'icon' => $deleted ? 'success' : 'danger'
            ],
            $deleted ? Response::HTTP_OK  : Response::HTTP_BAD_REQUEST
        );
    }
}
