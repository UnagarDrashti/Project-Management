<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManageEmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::where('role', 'employee')->get();
            return DataTables::of($users)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            $btn = '<a href="'.route('owner.edit.employee', $row->id).'" title="Edit User" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>';
                            $btn .= '<a href="'.route('owner.destroy.employee',$row->id).'" class="btn btn-danger btn-sm" title="User Delete" ><i class="fa fa-trash "></i></a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.employee.manage-employee');
    }

    public function create()
    {
        return view('admin.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'employee_role' => 'required|in:designer,developer',
            'password' => 'required|min:8',
            'confirm_password' => 'required_with:password|same:password|min:8'
        ]);

        $data = [
            'name' => $request->input('name'),
            'employee_role' => $request->input('employee_role'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'employee',
        ];

        User::Create($data);

        return redirect()->route('owner.manage.employee')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('admin.employee.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'employee_role' => 'required|in:designer,developer',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        $user->update($validatedData);
        
        return redirect()->route('owner.manage.employee')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('owner.manage.employee')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->route('owner.manage.employee')->with('error', $e->getMessage());
        }
    }
}
