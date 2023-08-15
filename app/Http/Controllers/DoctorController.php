<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Doctor::all();
        return view('admin.doctors.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospitals = Hospital::all();
        return view('admin.doctors.create' , compact('hospitals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'min:3|string|required',
            'email' => "required|string|unique:doctors,email",
            'phone' => "required|string|unique:doctors,phone",
            'descrption' => 'nullable|string',
            'cover' => 'nullable|image|mimes:png,jpg',
            'hospital_id' => 'nullable|string'
        ]);

        if (!$validator->fails()) {
            $doctor = new Doctor();
            $doctor->name = $request->get('name');
            $doctor->email = $request->get('email');
            $doctor->phone = $request->get('phone');
            $doctor->descrption = $request->get('descrption');
            $doctor->hospital_id = $request->get('hospital_id');

            if ($request->has('cover')) {
                $image = $request->file('cover');
                $imageName = time() . $doctor->name . '.' . $image->getClientOriginalExtension();
                $image->storePubliclyAs('doctors', $imageName, ['disk' => 'public']);
                $doctor->cover = $imageName;
            }

            $saved = $doctor->save();

            return response()->json(
                ['message' => $saved ? 'doctor created successfuly' : 'doctor creating failed'],
                $saved ? Response::HTTP_OK  : Response::HTTP_BAD_REQUEST
            );
        } else {
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
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $hospitals = Hospital::all();
        return view('admin.doctors.edit', compact('doctor' , 'hospitals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {


        $validator = Validator($request->all(), [
            'name' => 'min:3|string|required',
            'email'=>"required|string|unique:doctors,email,$doctor->id,id",
            'phone'=>"required|string|unique:doctors,phone,$doctor->id,id",
            'descrption' => 'nullable|string',
            'cover' => 'nullable|image|mimes:png,jpg',
            'hospital_id' => 'nullable|string'
        ]);

        if (!$validator->fails()) {
            $doctor->name = $request->get('name');
            $doctor->email = $request->get('email');
            $doctor->phone = $request->get('phone');
            $doctor->descrption = $request->get('descrption');
            $doctor->hospital_id = $request->get('hospital_id');

            if ($request->has('cover')) {
                $image = $request->file('cover');
                $imageName = time() . $doctor->name . '.' . $image->getClientOriginalExtension();
                $image->storePubliclyAs('doctors', $imageName, ['disk' => 'public']);
                $doctor->cover = $imageName;
            }

            $saved = $doctor->save();

            return response()->json(
                ['message' => $saved ? 'doctor updated successfuly' : 'doctor updating failed'],
                $saved ? Response::HTTP_OK  : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                [
                    'message' => $validator->getMessageBag()->first()
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        Storage::disk('public')->delete('doctors/' . $doctor->cover);
        $deleted = $doctor->delete();

        return response()->json(
            [
                'message' => $deleted ? 'doctor deleted successfuly' : 'doctor deleting failed',
                'icon' => $deleted ? 'success' : 'danger'
            ],
            $deleted ? Response::HTTP_OK  : Response::HTTP_BAD_REQUEST
        );
    }
}
