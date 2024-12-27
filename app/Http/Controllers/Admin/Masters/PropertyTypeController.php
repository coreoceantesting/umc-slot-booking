<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StorePropertyTypeRequest;
use App\Http\Requests\Admin\Masters\UpdatePropertyTypeRequest;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PropertyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $propertytypes = PropertyType::latest()->get();

        return view('admin.masters.propertytype')->with(['propertytypes'=> $propertytypes]);
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
    public function store(StorePropertyTypeRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $input = $request->validated();
            
            $existingPropertyType = PropertyType::withTrashed()
                ->where('name', $input['name'])
                ->first();

            if ($existingPropertyType) {
                PropertyType::create($input);
            } else {
                PropertyType::create($input);
            }

            DB::commit();

            return response()->json(['success' => 'PropertyType created successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondWithAjax($e, 'creating', 'PropertyType');
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
    public function edit(PropertyType $propertytype)
    {
        if ($propertytype)
        {
            $response = [
                'result' => 1,
                'propertytype' => $propertytype,
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyTypeRequest $request, PropertyType $propertytype)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $propertytype->update($input);
            DB::commit();

            return response()->json(['success'=> 'PropertyType updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'PropertyType');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyType $propertytype)
    {
        try
        {
            DB::beginTransaction();
            $propertytype->delete();
            DB::commit();

            return response()->json(['success'=> 'PropertyType deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'PropertyType');
        }
    }
}
