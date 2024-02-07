<?php

namespace App\Http\Controllers\Admin;

use auth;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManageTeamLeaderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::where('role', 'team-leader')->with('projects')->get();
            return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('project_name', function ($row) {
                $projects = Project::where('tl_id', $row->id)->get();
                return $projects->first()->name;
            })
            ->addColumn('emp_id', function ($row) {
                $projects = Project::with('employee')->get();
                foreach ($projects as $project) { 
                    foreach ($project->employee as $employee) {
                        return $employee->name;
                    }
                }
            })
            ->addColumn('action', function($row){
                $btn = '<a href="'.route('owner.edit.team-leader', $row->id).'" title="Edit User" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>';
                $btn .= '<a href="'.route('owner.destroy.team-leader',$row->id).'" class="btn btn-danger btn-sm" title="User Delete" ><i class="fa fa-trash "></i></a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.team_lead.manage-teamleader');
    }

    public function create()
    {
        return view('admin.team_lead.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required_with:password|same:password|min:8'
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'team-leader',
        ];

        User::Create($data);
        return redirect()->route('owner.manage.team-leader')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('admin.team_lead.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);
        $user->update($validatedData);
        
        return redirect()->route('owner.manage.team-leader')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('owner.manage.team-leader')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->route('owner.manage.team-leader')->with('error', $e->getMessage());
        }
    }

    
}
