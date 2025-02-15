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
use App\Models\Ward;

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
                    ->orWhere('slotbookings.activestatus', '=', 'approve')
                    ->orWhere('slotbookings.activestatus', '=', 'return');
            })

            ->latest()
            ->get();

        $wardslot = Ward::latest()->pluck('name', 'id');


        return view('admin.slotbooking', compact('propertytypes', 'slots', 'user', 'data', 'wardslot'));
    }


    // remark retuurn ka code working 
    // public function index()
    // {
    //     $user = Auth::user(); 
    //     $userName = $user->name;  

    //     $propertytypes = DB::table('propertytype')
    //         ->whereNull('deleted_at')
    //         ->latest()
    //         ->get();

    //     $slots = DB::table('slot')
    //         ->whereNull('deleted_at')
    //         ->get();

    //         $data = DB::table('slotbookings')
    //         ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
    //         ->join('slot', 'slot.id', '=', 'slotbookings.slot')
    //         ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
    //         ->select(
    //             'slotbookings.*',
    //             'propertytype.name as Pname',
    //             'slot.name as SlotName',
    //             'slot.totime',   
    //             'slot.fromtime',
    //             'dataapprove.id',
    //             'dataapprove.applicationid',
    //             'dataapprove.warduserid',
    //             'dataapprove.wardapprovaldate',
    //             'dataapprove.wardremark',
    //             'dataapprove.wardstatus',
    //             'dataapprove.officeruserid',
    //             'dataapprove.officerapprovaldate',
    //             'dataapprove.officerremark',
    //             'dataapprove.officerstatus',
    //             'dataapprove.clerkuserid',
    //             'dataapprove.clerkapprovaldate',
    //             'dataapprove.clerkremark',
    //             'dataapprove.clerkstatus',
    //             'dataapprove.hoduserid',
    //             'dataapprove.hodapprovaldate',
    //             'dataapprove.hodremark',
    //             'dataapprove.hodstatus',
    //             'dataapprove.assuserid',
    //             'dataapprove.assapprovaldate',
    //             'dataapprove.assremark',
    //             'dataapprove.assstatus',
    //             'dataapprove.adduserid',
    //             'dataapprove.addapprovaldate',
    //             'dataapprove.addremark',
    //             'dataapprove.addstatus',
    //         )
    //         ->whereNull('slotbookings.deleted_at') 
    //         ->where('slotbookings.fullname', '=', $user->name)  
    //         ->where(function ($query) {
    //             $query->where('slotbookings.activestatus', '=', 'pending')
    //                 ->orWhere('slotbookings.activestatus', '=', 'approve')
    //                 ->orWhere('slotbookings.activestatus', '=', 'return')
    //                 ->orWhereNotNull('dataapprove.wardremark')
    //                 ->orWhereNotNull('dataapprove.warduserid')
    //                 ->orWhereNotNull('dataapprove.wardstatus', '=', 'pending')
    //                 ->orWhereNotNull('dataapprove.officerremark')
    //                 ->orWhereNotNull('dataapprove.officeruserid')
    //                 ->orWhereNotNull('dataapprove.officerstatus', '=', 'pending')
    //                 ->orWhereNotNull('dataapprove.clerkremark')
    //                 ->orWhereNotNull('dataapprove.clerkuserid')
    //                 ->orWhereNotNull('dataapprove.clerkstatus', '=', 'pending')
    //                 ->orWhereNotNull('dataapprove.hodremark')
    //                 ->orWhereNotNull('dataapprove.hoduserid')
    //                 ->orWhereNotNull('dataapprove.hodstatus', '=', 'pending')
    //                 ->orWhereNotNull('dataapprove.assremark')
    //                 ->orWhereNotNull('dataapprove.assuserid')
    //                 ->orWhereNotNull('dataapprove.assstatus', '=', 'pending')
    //                 ->orWhereNotNull('dataapprove.addremark')
    //                 ->orWhereNotNull('dataapprove.adduserid')
    //                 ->orWhereNotNull('dataapprove.addstatus', '=', 'pending');
    //         })
    //         ->latest()
    //         ->get();



    //     return view('admin.slotbooking', compact('propertytypes', 'slots', 'user' ,'data'));
    // }





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

    public function amount_fetch(Request $request)
    {
        $propertyId = $request->input('propertyname');


        $property = DB::table('propertydetails')
            ->where('id', $propertyId)
            ->whereNull('deleted_at')
            ->first();
        // print_r($property);
        // die;

        if ($property) {
            return response()->json([
                'slot' => $property->slot,
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
        // dd($request->all());

        $rules = [
            'propertytypename' => 'required',
            'propertyname' => 'required',
            'address' => 'required',
            'fullname' => 'required',
            'mobileno' => 'required',
            'bookingpurpose' => 'required|string',
            // 'citizentype' => 'required|in:1,2',
            // 'slot' => 'required|nullable',

            'filesaadhar' => 'required|file|mimes:jpeg,png,pdf',
            'filesresidency' => 'required|file|mimes:jpeg,png,pdf',
            'filesevents' => 'required|file|mimes:jpeg,png,pdf',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Handle file uploads
            $fileAadhar = $request->file('filesaadhar');
            $fileNameAadhar = time() . '_aadhar.' . $fileAadhar->getClientOriginalExtension();
            $fileAadhar->storeAs('public/aadhar_certificates', $fileNameAadhar);

            $fileResidency = $request->file('filesresidency');
            $fileNameResidency = time() . '_residency.' . $fileResidency->getClientOriginalExtension();
            $fileResidency->storeAs('public/residency_certificates', $fileNameResidency);

            $fileEvents = $request->file('filesevents');
            $fileNameEvents = time() . '_events.' . $fileEvents->getClientOriginalExtension();
            $fileEvents->storeAs('public/events_certificates', $fileNameEvents);

            // Create the slot booking record
            $slotBooking = new SlotBooking();
            $slotBooking->propertytype = $request->input('propertytypename');
            $slotBooking->propertytypename = $request->input('propertyname');
            $slotBooking->address = $request->input('address');
            $slotBooking->fullname = $request->input('fullname');
            $slotBooking->mobileno = $request->input('mobileno');
            $slotBooking->bookingpurpose = $request->input('bookingpurpose');
            $slotBooking->slot = $request->input('slot');
            $slotBooking->wardslot = $request->input('wardslot');
            // print_r($slotBooking);
            // die();
            $slotBooking->sdamount = $request->input('sdamount');
            $slotBooking->scamount = $request->input('scamount');
            $slotBooking->registrationno = $request->input('registrationno');
            $slotBooking->booking_date = $request->input('booking_date');

            // Store file names
            $slotBooking->filesaadhar = $fileNameAadhar;
            $slotBooking->filesresidency = $fileNameResidency;
            $slotBooking->filesevents = $fileNameEvents;

            $slotBooking->save();

            // Generate slot application ID
            $slotapplicationid = 'SLOT/' . date('Y') . '/' . $slotBooking->id;
            $slotBooking->slotapplicationid = $slotapplicationid;
            $slotBooking->save();

            DB::table('dataapprove')->insert([
                'applicationid' => $slotBooking->id
            ]);

            DB::commit();

            return response()->json([
                'success' => 'Slot successfully booked!',
                'slotapplicationid' => $slotapplicationid
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
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

        if ($slotbooking) {
            $response = [
                'result' => 1,
                'slotbooking' => $slotbooking,
            ];
        } else {
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
            // 'citizentype' => 'required|in:1,2',
            // 'slot' => 'required',
            'filesaadhar' => 'file|mimes:jpeg,png,pdf',
            'filesresidency' => 'file|mimes:jpeg,png,pdf',
            'filesevents' => 'file|mimes:jpeg,png,pdf',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Handle file uploads
            $fileAadhar = $request->file('filesaadhar');
            $fileNameAadhar = time() . '_aadhar.' . $fileAadhar->getClientOriginalExtension();
            $fileAadhar->storeAs('public/aadhar_certificates', $fileNameAadhar);

            $fileResidency = $request->file('filesresidency');
            $fileNameResidency = time() . '_residency.' . $fileResidency->getClientOriginalExtension();
            $fileResidency->storeAs('public/residency_certificates', $fileNameResidency);

            $fileEvents = $request->file('filesevents');
            $fileNameEvents = time() . '_events.' . $fileEvents->getClientOriginalExtension();
            $fileEvents->storeAs('public/events_certificates', $fileNameEvents);

            // Update the slot booking record
            $slotbooking->propertytype = $request->input('propertytypename');
            $slotbooking->propertytypename = $request->input('propertyname');
            $slotbooking->address = $request->input('address');
            $slotbooking->fullname = $request->input('fullname');
            $slotbooking->mobileno = $request->input('mobileno');
            $slotbooking->bookingpurpose = $request->input('bookingpurpose');
            $slotbooking->slot = $request->input('slot');
            $slotbooking->wardslot = $request->input('wardslot');
            $slotbooking->sdamount = $request->input('sdamount');
            $slotbooking->scamount = $request->input('scamount');
            $slotbooking->registrationno = $request->input('registrationno');
            $slotbooking->booking_date = $request->input('booking_date');

            // Store file names
            $slotbooking->filesaadhar = $fileNameAadhar;
            $slotbooking->filesresidency = $fileNameResidency;
            $slotbooking->filesevents = $fileNameEvents;

            $slotbooking->activestatus = 'pending'; // You can change the status if needed

            $slotbooking->save();

            DB::commit();

            return response()->json([
                'success' => 'SlotBooking updated successfully!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Something went wrong, please try again.',
            ], 500);
        }
        print_r($request->all());
        exit;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SlotBooking $slotbooking)
    {
        try {
            DB::beginTransaction();
            $slotbooking->delete();
            DB::commit();

            return response()->json(['success' => 'SlotBooking deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'SlotBooking');
        }
    }
}
