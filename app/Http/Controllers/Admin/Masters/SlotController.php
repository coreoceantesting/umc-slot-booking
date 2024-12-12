<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreSlotRequest;
use App\Http\Requests\Admin\Masters\UpdateSlotRequest;
use App\Models\Slot;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class SlotController extends Controller
{
    public function index()
    {
        $slots = Slot::latest()->get();

        return view('admin.masters.slot')->with(['slots'=> $slots]);
    }

    public function create()
    {
        //
    }

    public function store(StoreSlotRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            Slot::create($input);
            DB::commit();

            return response()->json(['success'=> 'Slot created successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Slot');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Slot $slot)
    {
        if ($slot)
        {
            $response = [
                'result' => 1,
                'slot' => $slot,
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }

    public function update(UpdateSlotRequest $request, Slot $slot)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $slot->update($input);
            DB::commit();

            return response()->json(['success'=> 'Slot updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Slot');
        }
    }

    public function destroy(Slot $slot)
    {
        try
        {
            DB::beginTransaction();
            $slot->delete();
            DB::commit();

            return response()->json(['success'=> 'Slot deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Slot');
        }
    }


}
