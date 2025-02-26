<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreDepartmentRequest;
use App\Http\Requests\Admin\Masters\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->whereNull('deleted_at')->get();

        return view('admin.masters.department')->with(['departments'=> $departments]);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $input = $request->validated();
           
            $existingDepartment = Department::withTrashed()
                ->where('name', $input['name']) 
                ->first();

            if ($existingDepartment) {
                Department::create($input);
            } else {
                Department::create($input);
            }

            DB::commit();

            return response()->json(['success' => 'Department created successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondWithAjax($e, 'creating', 'Department');
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
    public function edit(Department $department)
    {
        if ($department)
        {
            $response = [
                'result' => 1,
                'department' => $department,
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
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $department->update($input);
            DB::commit();

            return response()->json(['success'=> 'Department updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Department');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        try
        {
            DB::beginTransaction();
            $department->delete();
            DB::commit();

            return response()->json(['success'=> 'Department deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Department');
        }
    }
}
