<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AadharCard;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AdhaarDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aadharcard = AadharCard::latest()->whereNull('deleted_at')->get();

        return view('admin.masters.adhaardetails')->with(['aadharcard'=> $aadharcard]);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'citizen_type' => 'required|in:General,Senior Citizen',
            'image' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240', 
            'is_required' => 'nullable|required',  
        ]);

        $existingAadharCard = AadharCard::where('name', $request->input('name'))
                                        ->where('citizen_type', $request->input('citizen_type'))
                                        ->first();

        if ($existingAadharCard) {
            return response()->json(['error' => 'Aadhar Card with this name and citizen type already exists!'], 400);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('aadharcard_images', 'public');
        } else {
            $imagePath = null;  
        }

        AadharCard::create([
            'name' => $request->input('name'),
            'citizen_type' => $request->input('citizen_type'),
            'image_path' => $imagePath, 
            'is_required' => $request->has('is_required'), 
        ]);

        return response()->json(['success' => 'Aadhar Card created successfully!']);
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
    public function edit($id)
    {
        $aadhar = AadharCard::find($id);

        if ($aadhar) {
            return response()->json([
                'result' => 1,
                'aadhar' => $aadhar
            ]);
        } else {
            return response()->json(['result' => 0]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $aadharCard = AadharCard::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'citizen_type' => 'required|in:General,Senior Citizen',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'is_required' => 'nullable|required',  
        ]);
        if ($request->hasFile('image')) {
            if ($aadharCard->image_path && Storage::exists('public/' . $aadharCard->image_path)) {
                Storage::delete('public/' . $aadharCard->image_path);
            }
    
            $imagePath = $request->file('image')->store('aadharcard_images', 'public');
        } else {
            $imagePath = $aadharCard->image_path;
        }
    
        $aadharCard->update([
            'name' => $request->input('name'),
            'citizen_type' => $request->input('citizen_type'),
            'image_path' => $imagePath, 
            'is_required' => $request->has('is_required'),
        ]);
    
        return response()->json(['success' => 'Aadhar Card updated successfully!']);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try
        {
            DB::beginTransaction();
            $aadhar = AadharCard::find($id);
            $aadhar->delete();
            DB::commit();
    
            return response()->json(['success'=> 'AadharCard deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Department');
        }
    }
     
}

    
    
