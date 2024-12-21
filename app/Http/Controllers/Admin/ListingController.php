<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Property;
use App\Models\SlotBooking;
use App\Models\PropertyType;
use App\Models\User;
use App\Models\Role;

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
                    'slot.name as SlotName'
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
                ->select('slotbookings.*', 'propertytype.name as Pname', 'slot.name as SlotName')
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
                'slot.name as SlotName'
            )
            ->whereNull('slotbookings.deleted_at')
            ->where('slotbookings.activestatus', '=', 'pending') 

            ->where('propertytype.name', '!=', 'Samaj Mandir') 
            ->orwhere('dataapprove.officerstatus', '=', 'approve')
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
                ->select('slotbookings.*', 'propertytype.name as Pname', 'slot.name as SlotName')
                ->whereNull('slotbookings.deleted_at')
                ->where('slotbookings.activestatus', '=', 'approve')
                ->where('dataapprove.hodstatus', '=', 'pending')
                ->latest();
        } elseif ($userRole == 'Assistant Commissioner') {
            $query = DB::table('slotbookings')
                ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
                ->join('slot', 'slot.id', '=', 'slotbookings.slot')
                ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
                ->select('slotbookings.*', 'propertytype.name as Pname', 'slot.name as SlotName')
                ->whereNull('slotbookings.deleted_at')
                ->where('slotbookings.activestatus', '=', 'approve')
                ->where('dataapprove.assstatus', '=', 'pending')
                ->latest();
        } elseif ($userRole == 'Additional  Commissioner') {
            $query = DB::table('slotbookings')
                ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
                ->join('slot', 'slot.id', '=', 'slotbookings.slot')
                ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
                ->select('slotbookings.*', 'propertytype.name as Pname', 'slot.name as SlotName')
                ->whereNull('slotbookings.deleted_at')
                ->where('slotbookings.activestatus', '=', 'approve')
                ->where('dataapprove.addstatus', '=', 'pending')
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
                    'slot.name as SlotName'
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
                'slot.name as SlotName'
            )
            ->whereNull('slotbookings.deleted_at')
            ->where('dataapprove.clerkstatus', '=', 'approve')
            ->latest();
        } elseif ($userRole == 'Ward Officer') {
            $query = DB::table('slotbookings')
                ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
                ->join('slot', 'slot.id', '=', 'slotbookings.slot')
                ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
                ->select('slotbookings.*', 'propertytype.name as Pname', 'slot.name as SlotName')
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
                ->select('slotbookings.*', 'propertytype.name as Pname', 'slot.name as SlotName')
                ->whereNull('slotbookings.deleted_at')
                ->where('slotbookings.activestatus', '=', 'approve')
                ->where('dataapprove.hodstatus', '=', 'approve')
                ->latest();
        } elseif ($userRole == 'Assistant Commissioner') {
            $query = DB::table('slotbookings')
                ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
                ->join('slot', 'slot.id', '=', 'slotbookings.slot')
                ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
                ->select('slotbookings.*', 'propertytype.name as Pname', 'slot.name as SlotName')
                ->whereNull('slotbookings.deleted_at')
                ->where('slotbookings.activestatus', '=', 'approve')
                ->where('dataapprove.assstatus', '=', 'approve')
                ->latest();
        } elseif ($userRole == 'Additional  Commissioner') {
            $query = DB::table('slotbookings')
                ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
                ->join('slot', 'slot.id', '=', 'slotbookings.slot')
                ->join('dataapprove', 'dataapprove.applicationid', '=', 'slotbookings.id')
                ->select('slotbookings.*', 'propertytype.name as Pname', 'slot.name as SlotName')
                ->whereNull('slotbookings.deleted_at')
                ->where('slotbookings.activestatus', '=', 'approve')
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
        ]);
    
        $booking = SlotBooking::find($request->booking_id);
    
        if (!$booking) {
            return response()->json(['error' => true, 'message' => 'Booking not found.']);
        }
    
        $existingBooking = null;
        if ($userRole == 'Ward Clerk') {
            $existingBooking = SlotBooking::where('slot', $booking->slot)
                ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
                ->where('activestatus', 'approve')
                ->where('booking_date', $booking->booking_date)
                ->where('propertytype.name', '=', 'Samaj Mandir')
                ->first();
        } elseif ($userRole == 'Department Clerk') {
            $existingBooking = SlotBooking::where('slot', $booking->slot)
                ->join('propertytype', 'propertytype.id', '=', 'slotbookings.propertytype')
                ->where('activestatus', 'approve')
                ->where('booking_date', $booking->booking_date)
                ->where('propertytype.name', '!=', 'Samaj Mandir')
                ->first();
        }
    
        if ($existingBooking) {
            return response()->json(['error' => true, 'message' => 'Slot already booked for this date!']);
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
                $statusMessage = 'Booking approved By Ward Clerk successfully!';
                
                break;
            case 'Ward Officer':
                $statusField = 'officerstatus';
                $userIdField = 'officeruserid';
                $approvalDateField = 'officerapprovaldate';
                $statusMessage = 'Booking approved By Ward Officer successfully!';
                break;
            case 'Department Clerk':
                $statusField = 'clerkstatus';
                $userIdField = 'clerkuserid';
                $approvalDateField = 'clerkapprovaldate';
                $statusMessage = 'Booking approved By Department Clerk successfully!';
                break;
            case 'Department HOD':
                $statusField = 'hodstatus';
                $userIdField = 'hoduserid';
                $approvalDateField = 'hodapprovaldate';
                $statusMessage = 'Booking approved By Department HOD successfully!';
                break;
            case 'Assistant Commissioner':
                $statusField = 'assstatus';
                $userIdField = 'assuserid';
                $approvalDateField = 'assapprovaldate';
                $statusMessage = 'Booking approved By Assistant Commissioner successfully!';
                break;
            case 'Additional  Commissioner':
                $statusField = 'addstatus';
                $userIdField = 'adduserid';
                $approvalDateField = 'addapprovaldate';
                $statusMessage = 'Booking approved By Additional Commissioner successfully!';
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
                'deleted_by' => null,
                'deleted_at' => null,
            ]);
    
        if ($updateStatus === false) {
            return response()->json(['error' => true, 'message' => 'Failed to update approval status.']);
        }
    
        $booking->activestatus = 'approve';
        $booking->save();
    
        return response()->json(['success' => true, 'message' => $statusMessage]);
    }
    
    



    


    public function return_slot(Request $request)
    {
        $user = Auth::user();
        $userRole = $user->getRoleNames()->first();
        
        $validated = $request->validate([
            'booking_id' => 'required|exists:slotbookings,id',
        ]);
        
        $booking = SlotBooking::find($request->booking_id);
        
        if (!$booking) {
            return response()->json(['error' => true, 'message' => 'Booking not found.']);
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
            ->select(
                'slotbookings.*', 
                'propertytype.name as Pname', 
                'slot.name as SlotName'
            )
            ->whereNull('slotbookings.deleted_at') 
            ->where('slotbookings.activestatus', '=', 'return')  
            ->latest();
    
        if ($userRole == 'Ward Clerk') {
            $query->where('propertytype.name', '=', 'Samaj Mandir');
        } elseif ($userRole == 'Department Clerk') {
            $query->where('propertytype.name', '!=', 'Samaj Mandir');
        }
    
        $data = $query->get();

        return view('admin.returnslot',compact('data'));
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
}
