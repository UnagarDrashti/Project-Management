<?php

namespace App\Http\Controllers\TeamLeader;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ManageEmployesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::where('role', 'employee')->get();
            return DataTables::of($users)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            $btn = '<a href="'.route('team-leader.edit.employee', $row->id).'" title="Edit User" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>';
                            $btn .= '<a href="'.route('team-leader.destroy.employee',$row->id).'" class="btn btn-danger btn-sm" title="User Delete" ><i class="fa fa-trash "></i></a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('Team_Leader.employes.manage-employes');
    }

    public function create()
    {
        return view('Team_Leader.employes.create');
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

        User::create($data);
        // dd($data);

        return redirect()->route('team-leader.manage.employee')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('Team_Leader.employes.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'employee_role' => 'required|in:designer,developer',
            'password' => 'nullable|string|min:8',
        ]);
        $user->update($validatedData);
        
        return redirect()->route('team-leader.manage.employee')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('team-leader.manage.employee')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->route('team-leader.manage.employee')->with('error', $e->getMessage());
        }
    }
}
