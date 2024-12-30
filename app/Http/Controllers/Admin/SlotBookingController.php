<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Property;
use App\Models\SlotBooking;
use App\Models\PropertyType;
use App\Models\User;

class SlotBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   

    public function index()
    {
        $user = Auth::user(); 
        $userName = $user->name;  

        $propertytypes = DB::table('propertytype')
            ->whereNull('deleted_at')
            ->latest()
            ->get();

        $slots = DB::table('slot')
            ->whereNull('deleted_at')
            ->get();

            $data = DB::table('slotbookings')
            ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
            ->join('slot', 'slot.id', '=', 'slotbookings.slot')
            ->select(
                'slotbookings.*',
                'propertytype.name as Pname',
                'slot.name as SlotName',
                'slot.totime',   
                'slot.fromtime'  
            )
            ->whereNull('slotbookings.deleted_at')
            ->where('slotbookings.fullname', '=', $user->name)
            ->where(function ($query) {
                $query->where('slotbookings.activestatus', '=', 'pending')
                      ->orWhere('slotbookings.activestatus', '=', 'approve');
            })
            
            ->latest()
            ->get();
        
            
        return view('admin.slotbooking', compact('propertytypes', 'slots', 'user' ,'data'));
    }
    



    public function propertynamefetch(Request $request)
    {
        $propertyTypeId = $request->input('propertytypename');

        $properties = DB::table('property')
            ->where('propertytypename', $propertyTypeId)
            ->whereNull('deleted_by')  
            ->select('id', 'name')  
            ->get();
       

        return response()->json([
            'properties' => $properties
        ]);
    }

    public function amount_fetch(Request $request){
        $propertyId = $request->input('propertyname');
        
        $property = DB::table('propertydetails')
            ->where('id', $propertyId)
            ->whereNull('deleted_at') 
            ->first();
           
        if ($property) {
            return response()->json([
                'slot'=>$property->slot,
                'gamount' => $property->gamount,
                'sdamount' => $property->sdamount,
                'citizenamount' => $property->citizenamount,
                'citizensdamount' => $property->citizensdamount
            ]);
        } else {
            return response()->json([
                'error' => 'Amount not found.'
            ], 404);
        }
    }

    public function fetch_address(Request $request)
    {
        $propertyId = $request->input('propertyname');
    
        $property = DB::table('property')
            ->where('id', $propertyId)
            ->whereNull('deleted_by') 
            ->first();
    
        if ($property) {
            return response()->json([
                'address' => $property->address
            ]);
        } else {
            return response()->json([
                'error' => 'Property not found.'
            ], 404);
        }
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
        $rules = [
            'propertytypename' => 'required',
            'propertyname' => 'required',
            'address' => 'required',
            'fullname' => 'required',
            'mobileno' => 'required',
            'bookingpurpose' => 'required|string',
            'citizentype' => 'required|in:1,2',
            'slot' => 'required|nullable',
            'files' => 'required',
        ];
    
        $citizentype = (int) $request->input('citizentype');
    
        if ($citizentype === 1) {
            $rules['sdamount'] = 'required|numeric';
            $rules['scamount'] = 'required|numeric';
            $rules['registrationno'] = 'nullable';
            $rules['files'] = 'nullable';
        } elseif ($citizentype === 2) {
            $rules['sdamount'] = 'required|numeric';
            $rules['scamount'] = 'required|numeric';
            $rules['registrationno'] = 'required';
            $rules['files'] = 'required';
        }
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
    
        $existingBooking = SlotBooking::where('slot', $request->input('slot'))
        ->where('booking_date', $request->input('booking_date'))
        ->first();

        if ($existingBooking) {
        return response()->json([
        'error' => 'This slot is already booked for the selected date with a different property type. Please choose another slot or date.'
        ], 422);
        }

    
        try {
            $slotBooking = new SlotBooking();
            $slotBooking->propertytype = $request->input('propertytypename');
            $slotBooking->propertytypename = $request->input('propertyname');
            $slotBooking->address = $request->input('address');
            $slotBooking->fullname = $request->input('fullname');
            $slotBooking->mobileno = $request->input('mobileno');
            $slotBooking->bookingpurpose = $request->input('bookingpurpose');
            $slotBooking->citizentype = $citizentype;
            $slotBooking->slot = $request->input('slot');
            $slotBooking->sdamount = $request->input('sdamount');
            $slotBooking->scamount = $request->input('scamount');
            $slotBooking->registrationno = $request->input('registrationno');
            $slotBooking->booking_date = $request->input('booking_date');
    
            if ($request->hasFile('files')) {
                $file = $request->file('files');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/registration_certificates', $fileName);
                $slotBooking->files = $fileName;
            } else {
                if ($citizentype === 2) {
                    \Log::error('File not uploaded when citizentype is 2.');
                    return response()->json(['error' => 'File is required for citizentype 2.'], 422);
                }
            }
    
            $slotBooking->save();
    
            DB::table('dataapprove')->insert([
                'applicationid' => $slotBooking->id
            ]);
    
            return response()->json([
                'success' => 'Slot booking created successfully!',
            ]);
    
        } catch (\Exception $e) {
            \Log::error('Error in slot booking: ' . $e->getMessage());
    
            return response()->json([
                'error' => 'Something went wrong, please try again.',
            ], 500);
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
    public function edit(SlotBooking $slotbooking)
    {
        
        if ($slotbooking)
        {
            $response = [
                'result' => 1,
                'slotbooking' => $slotbooking,
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
    public function update(Request $request, SlotBooking $slotbooking)
    {
        $rules = [
            'propertytypename' => 'required',
            'propertyname' => 'required',
            'address' => 'required',
            'fullname' => 'required',
            'mobileno' => 'required',
            'bookingpurpose' => 'required|string',
            'citizentype' => 'required|in:1,2',
            'slot' => 'required',
            'files' => 'nullable',  
        ];

        $citizentype = (int) $request->input('citizentype');

        if ($citizentype === 1) {
            $rules['sdamount'] = 'required|numeric';
            $rules['scamount'] = 'nullable|numeric';
            $rules['registrationno'] = 'nullable';
        } elseif ($citizentype === 2) {
            $rules['sdamount'] = 'required|numeric';
            $rules['scamount'] = 'required|numeric';
            $rules['registrationno'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();
            
            $slotbooking->propertytype = $request->input('propertytypename');
            $slotbooking->propertytypename = $request->input('propertyname');
            $slotbooking->address = $request->input('address');
            $slotbooking->fullname = $request->input('fullname');
            $slotbooking->mobileno = $request->input('mobileno');
            $slotbooking->bookingpurpose = $request->input('bookingpurpose');
            $slotbooking->citizentype = $citizentype;
            $slotbooking->slot = $request->input('slot');
            $slotbooking->sdamount = $request->input('sdamount');
            $slotbooking->scamount = $request->input('scamount');
            $slotbooking->registrationno = $request->input('registrationno');
            $slotbooking->booking_date = $request->input('booking_date');
            $slotbooking->activestatus = 'pending';

            if ($request->hasFile('files')) {
                $file = $request->file('files');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/registration_certificates', $fileName);
                $slotbooking->files = $fileName;
            }

            $slotbooking->save();

            DB::commit();

            return response()->json([
                'success' => 'SlotBooking updated successfully!',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error updating SlotBooking: ' . $e->getMessage());

            return response()->json([
                'error' => 'Something went wrong, please try again.',
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SlotBooking $slotbooking)
    {
        try
        {
            DB::beginTransaction();
            $slotbooking->delete();
            DB::commit();

            return response()->json(['success'=> 'SlotBooking deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'SlotBooking');
        }
    }

   
}
