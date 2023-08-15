<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

class RolePermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all() , [
            'role_id' => 'required|string|exists:roles,id',
            'permission_id' => 'required|string|exists:permissions,id'
        ]);

        if (! $validator->fails()) {

            $role = Role::where('id',$request->get('role_id'))->first();
            $permission = Permission::where('id',$request->get('permission_id'))->first();

            if($role->hasPermissionTo($permission)){

                $role->revokePermissionTo($permission);
            }else{
                $role->givePermissionTo($permission);
            }

            $saved = $role->save();
            return response()->json(
                ['message' => $saved ? 'Permission Added successfuly' : 'Permission Adding failed'],
                $saved ? Response::HTTP_OK  : Response::HTTP_BAD_REQUEST
            );
        }else {
            return response()->json(
                [
                    'message' => $validator->getMessageBag()->first()
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        $rolePermissions = $role->permissions;
        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            $permission->setAttribute('assign' , false);

            foreach ($rolePermissions as $rolePermission) {
                if($rolePermission->id == $permission->id){
                    $permission->setAttribute('assign' , true);
                    break;
                }
            }
        }

        return view('admin.roles.role-permissions' , compact('role' ,'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
