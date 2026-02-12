<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class RosterApiController extends Controller
{
    public function index()
    {
        return response()->json(Employee::orderBy('created_at', 'desc')->get());
    }

    public function store(Request $request)
    {
        try {
            $input_data = $request->all();
            if(!isset($input_data['TRANGTHAI'])) $input_data['TRANGTHAI'] = 1; 
            
            Employee::create($input_data);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        return response()->json(Employee::find($id));
    }

    public function update(Request $request, $id)
    {
        try {
            $employee = Employee::find($id);
            if($employee) {
                $employee->update($request->all());
                return response()->json(['success' => true]);
            }
            return response()->json(['success' => false, 'message' => 'Not found']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $employee->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}