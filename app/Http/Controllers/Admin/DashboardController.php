<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\SlotBooking;
use Illuminate\Support\Facades\Cookie;

class DashboardController extends Controller
{

    public function index()
    {
        $slotbooking =DB::table('slotbookings') ->whereNull('deleted_at')->count();
        $todaysSlotList =DB::table('slotbookings')
        ->select('booking_date','fullname','mobileno','slotapplicationid','citizentype','activestatus')
        ->where('slotbookings.activestatus', '=', 'pending')
        ->latest()
        ->take(5)
        ->get();

        $returnSlotList =DB::table('slotbookings')
        ->select('booking_date','fullname','mobileno','slotapplicationid','citizentype','activestatus')
        ->where('slotbookings.activestatus', '=', 'return')
        ->latest()
        ->take(5)
        ->get();
      
        $approveSlotCount = DB::table('slotbookings')
        ->where('slotbookings.activestatus', '=', 'approve')
        ->count();
       
        $pendingSlotCount = DB::table('slotbookings')
        ->where('slotbookings.activestatus', '=', 'pending')
        ->count();

        $returnSlotCount = DB::table('slotbookings')
        ->where('slotbookings.activestatus', '=', 'return')
        ->count();
        
        return view('admin.dashboard', compact('slotbooking','todaysSlotList','approveSlotCount','pendingSlotCount','returnSlotCount','returnSlotList'));
    }

    public function changeThemeMode()
    {
        $mode = request()->cookie('theme-mode');

        if($mode == 'dark')
            Cookie::queue('theme-mode', 'light', 43800);
        else
            Cookie::queue('theme-mode', 'dark', 43800);

        return true;
    }
}
