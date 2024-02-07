<?php

namespace App\Http\Controllers\TeamLeader;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class ManageProjectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $projects = Project::with(['users', 'employee'])->get();
            return DataTables::of($projects)
                    ->addIndexColumn()
                    ->addColumn('tl_id', function($row){
                        return $row->users[0]['name'];
                    })
                    ->addColumn('emp_id', function($row){
                        return $row->employee[0]['name'];
                    })
                    ->addColumn('action', function($row){
                            $btn = '<a href="'.route('team-leader.edit.project', $row->id).'" title="Edit Project" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>';
                            $btn .= '<a href="'.route('team-leader.destroy.project',$row->id).'" class="btn btn-danger btn-sm" title="Project Delete" ><i class="fa fa-trash "></i></a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('Team_Leader.project.manage-project');
    }

    public function create()
    {
        $employees = User::where('role', 'employee')->get();
        $team_leaders = User::where('role', 'team-leader')->get();
        return view('Team_Leader.project.create', compact('employees', 'team_leaders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'tl_id' => 'required|exists:users,id',
            'emp_id' => 'required|exists:users,id',
        ]);

        $data = [
            'name' => $request->input('name'),
            'tl_id' => $request->input('tl_id'),
            'emp_id' => $request->input('emp_id'),
        ];
        Project::Create($data);

        return redirect()->route('team-leader.manage.project')->with('success', 'Project created successfully');
    }

    public function edit(Project $project)
    {
        $employees = User::where('role', 'employee')->get();
        $team_leaders = User::where('role', 'team-leader')->get();
        return view('Team_Leader.project.edit', compact('project','employees', 'team_leaders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'tl_id' => 'required|exists:users,id',
            'emp_id' => 'required|exists:users,id',
        ]);
        $project->update($validatedData);
        
        return redirect()->route('team-leader.manage.project')->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            $project->delete();
            return redirect()->route('team-leader.manage.project')->with('success', 'Project deleted successfully');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->route('team-leader.manage.project')->with('error', $e->getMessage());
        }
    }
}
