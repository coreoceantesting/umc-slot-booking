<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StorePropertyRequest;
use App\Http\Requests\Admin\Masters\UpdatePropertyRequest;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\Ward;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    public function index()
    {
        $propertytype = DB::table('propertytype')->whereNull('deleted_at')->latest()->get();

        $data = Property::join('propertytype', 'propertytype.id', 'property.propertytypename')
            ->get(['property.*', 'propertytype.name as Pname']);


        $wards = Ward::latest()->pluck('name', 'id');


        return view('admin.masters.property', compact('propertytype', 'data', 'wards'));
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
    public function store(StorePropertyRequest $request)
    {
        try {
            DB::beginTransaction();

            $input = $request->validated();

            $existingProperty = Property::withTrashed()
                ->where('name', $input['name'])
                ->first();




            if ($existingProperty) {
                Property::create($input);
            } else {
                Property::create($input);
            }

            DB::commit();


            return response()->json(['success' => 'Property created successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondWithAjax($e, 'creating', 'Property');
        }
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
    public function edit(Property $property)
    {

        if ($property) {
            return response()->json([
                'result' => 1,
                'property' => $property
            ]);
        } else {
            return response()->json(['result' => 0]);
        }
    }

    // public function editnewone(Property $property)
    // {
    //     // Check if property exists
    //     if ($property) {
    //         // Fetch wards from Ward model (you should have a `Ward` model)
    //         $wards = Ward::pluck('name', 'id'); // This will return an associative array (id => name)

    //         // Return the view with property and wards data
    //         return response()->json([
    //             'result' => 1,
    //             'property' => $property
    //         ]);
    //         //dd($property);  // Dumps the entire property data and stops the script

    //     } else {
    //         return redirect()->route('property.index')->with('error', 'Property not found.');
    //     }
    // }





    public function update(UpdatePropertyRequest $request, Property $property)

    {
        // dd($request);
        try {
            DB::beginTransaction();

            $input = $request->validated();


            $property->update($input);


            DB::commit();

            return response()->json(['success' => 'Property updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'There was an error updating the property.']);
        }
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        try {
            DB::beginTransaction();
            $property->delete();
            DB::commit();

            return response()->json(['success' => 'Property deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'Property');
        }
    }
}
