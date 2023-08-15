<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitals = Hospital::paginate(5);
        return response()->json([
            'message'=>'All Hospitals',
            'data'=>$hospitals
        ] , 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator($request->all(),[
            'name'=>'required|string',
            'is_active'=>'required|boolean',
            'location'=>'required|string'
        ]);

        $hospital = new Hospital();
        // $hospital->create($request->all());
        // $hospital->refresh();
        $hospital->name = $request->get('name');
        $hospital->is_active = $request->get('is_active');
        $hospital->location = $request->get('location');
        return response()->json([
            'message'=>'Hospital Created Successfuly',
            'data'=>$hospital
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hospital = Hospital::findOrFail($id);
        return $hospital;
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
        $hospital = Hospital::findOrFail($id);
        $hospital->delete();
        return response()->json([
            'message' => 'hospitals deleted successfuly',
            'data' => $hospital
        ]);
    }
}
