@extends('Team_Leader.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <label></label>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"> Update Project</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('team-leader.update.project', $project->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $project->name }}">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="team_leader">Team Leader:</label>
                                <select name="tl_id" class="form-control @error('tl_id') is-invalid @enderror" required>
                                    <option>Select Team Leader</option>
                                    @foreach($team_leaders as $team_leader)
                                        <option value="{{ $team_leader->id }}" {{ $project->tl_id == $team_leader->id ? 'selected' : '' }}>{{ $team_leader->name }}</option>
                                    @endforeach
                                </select>
                                @error('tl_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="employee">Employee:</label>
                                <select name="emp_id" class="form-control @error('emp_id') is-invalid @enderror" required>
                                    <option>Select Employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $project->emp_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                                @error('emp_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update Project</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

