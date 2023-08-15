<?php

namespace App\Http\Controllers;

use App\Http\Requests\HospitalRequest;
use App\Models\Hospital;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Hospital::all();
        return view('admin.hospitals.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majors = Major::all();
        return view('admin.hospitals.create', compact('majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HospitalRequest $request)
    {

        // $request->validate([
        //     'name'=> 'required|string|min:3',
        //     'location'=> 'required|string|min:3',
        //     'info'=> 'nullable|string|max:200',
        //     'is_active'=> 'in:on|string',
        //     'cover'=> 'nullable|image|mimes:png,jpg',
        // ]);

        $hospital = new Hospital();
        $hospital->name = $request->get('name');
        $hospital->location = $request->get('location');
        $hospital->info = $request->get('info');
        $hospital->is_active = $request->has('is_active');

        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imageName = time() . $hospital->name . '.' . $image->getClientOriginalExtension();
            $image->storePubliclyAs('hospitals', $imageName, ['disk' => 'public']);
            $hospital->cover = $imageName;
        }

        $hospital->save();
        $hospital->majors()->attach($request->get('majors'));
        session()->flash('message', 'Hospital Created Successfuly');
        return redirect()->route('hospital.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hospital = Hospital::find($id);
        $majors = Major::all();
        return view('admin.hospitals.edit', compact('hospital','majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HospitalRequest $request, string $id)
    {
        $hospital = Hospital::find($id);
        $hospital->name = $request->get('name');
        $hospital->location = $request->get('location');
        $hospital->info = $request->get('info');
        $hospital->is_active = $request->has('is_active');

        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imageName = time() . $hospital->name . '.' . $image->getClientOriginalExtension();
            $image->storePubliclyAs('hospitals', $imageName, ['disk' => 'public']);
            $hospital->cover = $imageName;
        }

        $hospital->save();
        $hospital->majors()->sync($request->get('majors'));
        session()->flash('message', 'Hospital Updated Successfuly');
        return redirect()->route('hospital.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Hospital::find($id);
        Storage::disk('public')->delete('hospitals/' . $item->cover);
        $deleted = $item->delete();
        if ($deleted) {
            session()->flash('message', 'Hospital Deleted Successfuly');
            return redirect()->route('hospital.index');
        } else {
            return Response::HTTP_BAD_REQUEST;
        }
    }
}
