<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Major::all();
        return view('admin.majors.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.majors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return response($request);

        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'is_active' => 'in:true,false|string',
            'cover' => 'nullable|image|mimes:png,jpg'
        ]);

        if (!$validator->fails()) {
            $major = new Major();
            $major->name = $request->get('name');
            if ($request->has('cover')) {
                $image = $request->file('cover');
                $imageName = time() . $major->name . '.' . $image->getClientOriginalExtension();
                $image->storePubliclyAs('majors', $imageName, ['disk' => 'public']);
                $major->cover = $imageName;
            }
            $major->is_active = $request->has('is_active');
            $saved = $major->save();


            return response()->json(
                ['message' => $saved ? 'major created successfuly' : 'major creating failed'],
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
    public function show(Major $major)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Major $major)
    {
        return view('admin.majors.edit', compact('major'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Major $major)
    {

        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'is_active' => 'in:true,false|string',
            'cover' => 'nullable|image|mimes:png,jpg',
        ]);

        if (!$validator->fails()) {
            $major->name = $request->get('name');
            $major->is_active = $request->has('is_active');
            if ($request->has('cover')) {
                $image = $request->file('cover');
                $imageName = time() . $major->name . '.' . $image->getClientOriginalExtension();
                $image->storePubliclyAs('majors', $imageName, ['disk' => 'public']);
                $major->cover = $imageName;
            }

            $saved = $major->save();


            return response()->json(
                ['message' => $saved ? 'major updated successfuly'  : 'major updating failed'],
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
    public function destroy(Major $major)
    {
        Storage::disk('public')->delete('majors/' . $major->cover);
        $deleted = $major->delete();

        return response()->json(
            [
                'message' => $deleted ? 'major deleted successfuly' : 'major deleting failed',
                'icon' => $deleted ? 'success' : 'danger'
            ],
            $deleted ? Response::HTTP_OK  : Response::HTTP_BAD_REQUEST
        );
    }
}
