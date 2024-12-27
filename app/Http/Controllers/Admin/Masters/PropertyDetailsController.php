<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StorePropertyDetailsRequest;
use App\Http\Requests\Admin\Masters\UpdatePropertyDetailsRequest;
use App\Models\PropertyDetails;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Slot;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PropertyDetailsController extends Controller
{
    public function index()
    {
        $propertytype = DB::table('propertytype')->whereNull('deleted_at')->latest()->get();
        $propertytypename = DB::table('property')->whereNull('deleted_at')->latest()->get();
        $slots = DB::table('slot')->whereNull('deleted_at')->latest()->get();
        
        $data = DB::table('propertydetails')
        ->join('propertytype', 'propertytype.id', '=', 'propertydetails.propertytypename') 
        ->join('property', 'property.id', '=', 'propertydetails.propertyname') 
        ->leftjoin('slot', 'slot.id', '=', 'propertydetails.slot') 
        ->select(
            'propertydetails.*', 
            'propertytype.name as Pname', 
            'property.name as PropertyName', 
            'slot.name as SlotName'
        )
        ->whereNull('propertydetails.deleted_at')
        ->latest() 
        ->get();
   
    return view('admin.masters.propertydetails', compact('propertytype','propertytypename','slots','data'));
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
    public function store(StorePropertyDetailsRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $input = $request->validated();
        
            PropertyDetails::create($input);
            DB::commit();

            return response()->json(['success' => 'Property Details created successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'propertydetails');
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
    public function edit(PropertyDetails $propertydetail)
    {
        if ($propertydetail)
        {
            return response()->json([
                'result' => 1,
                'propertydetail' => $propertydetail
            ]);
         
        }
        else
        {
            return response()->json(['result' => 0]);
        }
    }         
    
    

    public function update(UpdatePropertyDetailsRequest $request, PropertyDetails $propertydetail)
    {
        try
        {
            DB::beginTransaction();
            
            $input = $request->validated();
            
            $propertydetail->update($input);
            
            DB::commit();

            return response()->json(['success' => 'PropertyDetails updated successfully!']);
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => 'There was an error updating the PropertyDetails.']);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyDetails $propertydetail)
    {
      
        try
        {
            DB::beginTransaction();
            $propertydetail->delete();
            DB::commit();

            return response()->json(['success'=> 'PropertyDetails deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'PropertyDetails');
        }
    }

}
