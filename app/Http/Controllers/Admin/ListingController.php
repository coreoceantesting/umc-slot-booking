<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Property;
use App\Models\SlotBooking;
use App\Models\PropertyType;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function pending_list()
    {
        $user = Auth::user();
        $userRole = $user->getRoleNames()->first();
        $query = null;
        if ($userRole == 'Ward Clerk') {
            $query = DB::table('slotbookings')
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
                ->where('slotbookings.activestatus', '=', 'pending')
                ->where('propertytype.name', '=', 'Samaj Mandir')
                ->latest();
        } elseif ($userRole == 'Ward Officer') {
            $query = DB::table('slotbookings')
                ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
                ->join('slot', 'slot.id', '=', 'slotbookings.slot')
                ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
                ->select('slotbookings.*', 'propertytype.name as Pname', 'slot.name as SlotName','slot.totime',   
                'slot.fromtime' )
                ->whereNull('slotbookings.deleted_at')
                ->where('slotbookings.activestatus', '=', 'approve')
                ->where('propertytype.name', '=', 'Samaj Mandir')
                ->where('dataapprove.officerstatus', '=', 'pending')
                ->latest();
        } 
        elseif ($userRole == 'Department Clerk') {
            $query = DB::table('slotbookings')
            ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
            ->join('slot', 'slot.id', '=', 'slotbookings.slot')
            ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
            ->select(
                'slotbookings.*',
                'propertytype.name as Pname',
                'slot.name as SlotName',
                'slot.totime',  
                'slot.fromtime' 
            )
            ->whereNull('slotbookings.deleted_at')
            ->where('slotbookings.activestatus', '=', 'pending') 
            ->where('propertytype.name', '!=', 'Samaj Mandir') 
            ->where('dataapprove.clerkstatus', '=', 'pending')
            ->latest();

            // Execute the query or return the results as needed

            // $query = DB::table('slotbookings')
            // ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
            // ->join('slot', 'slot.id', '=', 'slotbookings.slot')
            // ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
            // ->select(
            //     'slotbookings.*',
            //     'propertytype.name as Pname',
            //     'slot.name as SlotName'
            // )
            // ->whereNull('slotbookings.deleted_at');
            // $propertyTypeName = request()->input('propertytype_name');
            // if (empty($propertyTypeName)) {
            //     $propertyTypeName = $query->first()->Pname ?? null;
              
            // }
            // if ($propertyTypeName == 'Samaj Mandir') {
               
            //     $query->where('slotbookings.activestatus', '=', 'pending')
            //         ->where('propertytype.name', '=', 'Samaj Mandir')
            //         ->where('dataapprove.clerkstatus', '=', 'pending');
            // } else{
            //     $query->where('slotbookings.activestatus', '=', 'pending')
            //         ->where('propertytype.name', '!=', 'Samaj Mandir')
            //         ->where('dataapprove.clerkstatus', '=', 'pending');
            // }
            // $query->latest();
        }        
        elseif ($userRole == 'Department HOD') {
            $query = DB::table('slotbookings')
                ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
                ->join('slot', 'slot.id', '=', 'slotbookings.slot')
                ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
                ->select('slotbookings.*', 'propertytype.name as Pname', 'slot.name as SlotName',
                'slot.totime',   
                'slot.fromtime' )
                ->whereNull('slotbookings.deleted_at')
                ->where('slotbookings.activestatus', '=', 'approve')
                 ->where('propertytype.name', '!=', 'Samaj Mandir')
                ->where('dataapprove.hodstatus', '=', 'pending')
                ->latest();
        } elseif ($userRole == 'Assistant Commissioner') {
            $query = DB::table('slotbookings')
                ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
                ->join('slot', 'slot.id', '=', 'slotbookings.slot')
                ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
                ->select('slotbookings.*', 'propertytype.name as Pname', 'slot.name as SlotName',
                'slot.totime',   
                'slot.fromtime' )
                ->whereNull('slotbookings.deleted_at')
                ->where('slotbookings.activestatus', '=', 'approve')
                ->where('propertytype.name', '!=', 'Samaj Mandir')
                ->where('dataapprove.assstatus', '=', 'pending')
                ->latest();
        } elseif ($userRole == 'Additional  Commissioner') {
            $query = DB::table('slotbookings')
                ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
                ->join('slot', 'slot.id', '=', 'slotbookings.slot')
                ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
                ->select('slotbookings.*', 'propertytype.name as Pname', 'slot.name as SlotName',
                'slot.totime',   
                'slot.fromtime' )
                ->whereNull('slotbookings.deleted_at')
                ->where('slotbookings.activestatus', '=', 'approve')
                ->where('propertytype.name', '!=', 'Samaj Mandir')
                ->where('dataapprove.addstatus', '=', 'pending')
                ->where('dataapprove.assstatus', '=', 'approve')
                ->latest();
               
        }else{
            
        }

        if ($query) {
            $data = $query->get();
            return view('admin.listpending', compact('data'));
        } else {
            return response()->view('admin.listpending', ['data' => []]);
        }
    }



    

    public function approve_list(){
        $user = Auth::user();
        $userRole = $user->getRoleNames()->first();
        $query = null;
        if ($userRole == 'Ward Clerk') {
            $query = DB::table('slotbookings')
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
                ->where('propertytype.name', '=', 'Samaj Mandir')
                ->where('slotbookings.activestatus', '=', 'approve')
                ->latest();
        }elseif ($userRole == 'Department Clerk') {
            $query = DB::table('slotbookings')
            ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
            ->join('slot', 'slot.id', '=', 'slotbookings.slot')
            ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
            ->select(
                'slotbookings.*',
                'propertytype.name as Pname',
                'slot.name as SlotName',
                'slot.totime',   
                'slot.fromtime' 
            )
            ->whereNull('slotbookings.deleted_at')
            ->where('propertytype.name', '!=', 'Samaj Mandir')
            ->where('dataapprove.clerkstatus', '=', 'approve')
            ->latest();
        } elseif ($userRole == 'Ward Officer') {
            $query = DB::table('slotbookings')
                ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
                ->join('slot', 'slot.id', '=', 'slotbookings.slot')
                ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
                ->select('slotbookings.*', 'propertytype.name as Pname', 'slot.name as SlotName',
                'slot.totime',   
                'slot.fromtime' )
                ->whereNull('slotbookings.deleted_at')
                ->where('slotbookings.activestatus', '=', 'approve')
                ->where('propertytype.name', '=', 'Samaj Mandir')
                ->where('dataapprove.officerstatus', '=', 'approve')
                ->latest();
        } elseif ($userRole == 'Department HOD') {
            $query = DB::table('slotbookings')
                ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
                ->join('slot', 'slot.id', '=', 'slotbookings.slot')
                ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
                ->select('slotbookings.*', 'propertytype.name as Pname', 'slot.name as SlotName',
                'slot.totime',   
                'slot.fromtime' )
                ->whereNull('slotbookings.deleted_at')
                ->where('slotbookings.activestatus', '=', 'approve')
                ->where('propertytype.name', '!=', 'Samaj Mandir')
                ->where('dataapprove.hodstatus', '=', 'approve')
                ->latest();
        } elseif ($userRole == 'Assistant Commissioner') {
            $query = DB::table('slotbookings')
                ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
                ->join('slot', 'slot.id', '=', 'slotbookings.slot')
                ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
                ->select('slotbookings.*', 'propertytype.name as Pname', 'slot.name as SlotName',
                'slot.totime',   
                'slot.fromtime' )
                ->whereNull('slotbookings.deleted_at')
                ->where('slotbookings.activestatus', '=', 'approve')
                ->where('propertytype.name', '!=', 'Samaj Mandir')
                ->where('dataapprove.assstatus', '=', 'approve')
                ->latest();
        } elseif ($userRole == 'Additional  Commissioner') {
            $query = DB::table('slotbookings')
                ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
                ->join('slot', 'slot.id', '=', 'slotbookings.slot')
                ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
                ->select('slotbookings.*', 'propertytype.name as Pname', 'slot.name as SlotName',
                'slot.totime',   
                'slot.fromtime' )
                ->whereNull('slotbookings.deleted_at')
                ->where('slotbookings.activestatus', '=', 'approve')
                ->where('propertytype.name', '!=', 'Samaj Mandir')
                ->where('dataapprove.addstatus', '=', 'approve')
                ->latest();
        } else {
        }
    
        if ($query) {
            $data = $query->get();
            return view('admin.listapprove', compact('data'));
        } else {
            return response()->view('admin.listapprove', ['data' => []]);
        }

    }

    public function approved_slot(Request $request)
    {
        $user = Auth::user();
        $userRole = $user->getRoleNames()->first();

        $validated = $request->validate([
            'booking_id' => 'required|exists:slotbookings,id',
            'remark' => 'nullable|string|max:255',  
        ]);
        

        $booking = SlotBooking::find($request->booking_id);

        if (!$booking) {
            return response()->json(['error' => true, 'message' => 'Booking not found.']);
        }

       
        
        $statusField = '';
        $userIdField = '';
        $approvalDateField = '';
        $statusMessage = '';
        
        switch ($userRole) {
            case 'Ward Clerk':
                $statusField = 'wardstatus';
                $userIdField = 'warduserid';
                $approvalDateField = 'wardapprovaldate';
                $statusMessage = 'wardremark';
                break;
            case 'Ward Officer':
                $statusField = 'officerstatus';
                $userIdField = 'officeruserid';
                $approvalDateField = 'officerapprovaldate';
                $statusMessage = 'officerremark';
                break;
            case 'Department Clerk':
                $statusField = 'clerkstatus';
                $userIdField = 'clerkuserid';
                $approvalDateField = 'clerkapprovaldate';
                $statusMessage = 'clerkremark';
                break;
            case 'Department HOD':
                $statusField = 'hodstatus';
                $userIdField = 'hoduserid';
                $approvalDateField = 'hodapprovaldate';
                $statusMessage = 'hodremark';
                break;
            case 'Assistant Commissioner':
                $statusField = 'assstatus';
                $userIdField = 'assuserid';
                $approvalDateField = 'assapprovaldate';
                $statusMessage = 'assremark';
                break;
            case 'Additional  Commissioner':
                $statusField = 'addstatus';
                $userIdField = 'adduserid';
                $approvalDateField = 'addapprovaldate';
                $statusMessage = 'addremark';
                break;
            default:
                return response()->json(['error' => true, 'message' => 'Invalid user role.']);
        }

        
        $updateStatus = DB::table('dataapprove')
            ->where('applicationid', $request->booking_id)
            ->update([
                $statusField => 'approve',
                $userIdField => $user->id,
                $approvalDateField => now(),
                $statusMessage=>$request->remark,
                'deleted_by' => null,
                'deleted_at' => null,
            ]);

        if ($updateStatus === false) {
            return response()->json(['error' => true, 'message' => 'Failed to update approval status.']);
        }

      
        $booking->activestatus = 'approve';
        $booking->save();

        return response()->json(['success' => true, 'userRole' => $userRole, 'message' => $statusMessage]);
    }



    public function return_slot(Request $request)
    {
        $user = Auth::user();
        $userRole = $user->getRoleNames()->first();
        
        $validated = $request->validate([
            'booking_id' => 'required|exists:slotbookings,id',  
            'remark' => 'nullable|string|max:255',               
        ]);
        
        $booking = SlotBooking::find($request->booking_id);
        
        if (!$booking) {
            return response()->json(['error' => true, 'message' => 'Booking not found.']);
        }

        $userIdField = '';
        $statusMessage = '';
        
        switch ($userRole) {
            case 'Ward Clerk':
                $userIdField = 'warduserid';
                $statusMessage = 'wardremark';
                break;
            case 'Ward Officer':
                $userIdField = 'officeruserid';
                $statusMessage = 'officerremark';
                break;
            case 'Department Clerk':
                $userIdField = 'clerkuserid';
                $statusMessage = 'clerkremark';
                break;
            case 'Department HOD':
                $userIdField = 'hoduserid';
                $statusMessage = 'hodremark';
                break;
            case 'Assistant Commissioner':
                $userIdField = 'assuserid';
                $statusMessage = 'assremark';
                break;
            case 'Additional Commissioner':
                $userIdField = 'adduserid';
                $statusMessage = 'addremark';
                break;
            default:
                return response()->json(['error' => true, 'message' => 'Invalid user role.']);
        }

        $updateStatus = DB::table('dataapprove')
            ->where('applicationid', $request->booking_id)
            ->update([
                $userIdField => $user->id,
                $statusMessage => $request->remark,  
                'deleted_by' => null,
                'deleted_at' => null,
            ]);
        
        if (!$updateStatus) {
            return response()->json(['error' => true, 'message' => 'Failed to update approval data.']);
        }

        $booking->activestatus = 'return';
        $booking->save();

        return response()->json(['success' => true, 'message' => 'Slot returned successfully!']);
    }


    

    public function return_list(){
        $user = Auth::user();
        $userRole = $user->getRoleNames()->first();
       
        $query = DB::table('slotbookings')
            ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype') 
            ->join('slot', 'slot.id', '=', 'slotbookings.slot') 
            ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id') 
            ->select(
                'slotbookings.*', 
                'propertytype.name as Pname', 
                'slot.name as SlotName',
                'dataapprove.wardremark',
                'dataapprove.officerremark',
                'dataapprove.clerkremark',
                'dataapprove.hodremark',
                'dataapprove.assremark',
                'dataapprove.addremark'
            )
            ->whereNull('slotbookings.deleted_at') 
            ->where('slotbookings.activestatus', '=', 'return')  
            ->orderBy('slotbookings.created_at', 'desc'); 
    
        $rolesForSamajMandir = ['Ward Clerk', 'Ward Officer'];
        $rolesForNonSamajMandir = ['Department Clerk', 'Department HOD', 'Assistant Commissioner', 'Additional  Commissioner'];
    
        if (in_array($userRole, $rolesForSamajMandir)) {
            $query->where('propertytype.name', '=', 'Samaj Mandir');
        } elseif (in_array($userRole, $rolesForNonSamajMandir)) {
            $query->where('propertytype.name', '!=', 'Samaj Mandir');
        }
    
        $data = $query->get();
        // print_r($data);
        // exit;
    
        return view('admin.returnslot', compact('data'));
    }
    

    public function getSlotDetails($id)
    {
        $booking = SlotBooking::join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
            ->join('slot', 'slot.id', '=', 'slotbookings.slot')
            ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
            ->join('property', 'property.id', '=', 'slotbookings.propertytypename')
            ->select(
                'slotbookings.*', 
                'propertytype.name as Pname', 
                'property.name as Prname', 
                'slot.name as SlotName',
                'slot.totime',   
                'slot.fromtime'
            )
            ->where('slotbookings.id', $id)
            ->first(); 
        

        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        return response()->json([
            'details' => view('admin.booking-details', compact('booking'))->render()
        ]);
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
        //
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
        //
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
        //
    }

    public function report()
    {
        return view('admin.masters.reports');
    }

    public function report_search(Request $request)
    {
        $validated = $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date',
            'status' => 'nullable|string|in:pending,approve,return', 
        ]);

        $fromDate = $validated['from_date'] ?? null;
        $toDate = $validated['to_date'] ?? null;
        $status = $validated['status'] ?? null;

        if ($fromDate) {
            $fromDate = Carbon::parse($fromDate)->startOfDay();
        }

        if ($toDate) {
            $toDate = Carbon::parse($toDate)->endOfDay();
        }

        $query = DB::table('slotbookings')
            ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
            ->join('slot', 'slot.id', '=', 'slotbookings.slot')
            ->select(
                'slotbookings.id',
                'slotbookings.slotapplicationid',
                'slotbookings.propertytype',
                'propertytype.name as Pname',
                'slotbookings.address',
                'slotbookings.fullname',
                'slotbookings.mobileno',
                'slotbookings.bookingpurpose',
                'slotbookings.booking_date',
                'slotbookings.citizentype',
                'slotbookings.slot',
                'slotbookings.sdamount',
                'slotbookings.scamount',
                'slotbookings.registrationno',
                'slotbookings.files',
                'slotbookings.activestatus',
                'slotbookings.status',
                'slotbookings.created_at',
                'slotbookings.updated_at',
                'slotbookings.deleted_at',
                'slot.name as SlotName',
            );

        if ($status) {
            $query->where('slotbookings.activestatus', $status);
        }

        if ($fromDate && $toDate) {
            $query->whereBetween('slotbookings.created_at', [$fromDate, $toDate]);
        } elseif ($fromDate) {
            $query->where('slotbookings.created_at', '>=', $fromDate);
        } elseif ($toDate) {
            $query->where('slotbookings.created_at', '<=', $toDate);
        }

        $slotBookings = $query->get();

        \Log::info("Query Results: ", $slotBookings->toArray());

        if ($request->ajax()) {
            return response()->json([
                'slotBookings' => $slotBookings,
            ]);
        }

        return view('admin.masters.reports');
    }

   

    
}
