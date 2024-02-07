@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Assigned project List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-center data-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Project Name</th>
                                    <th>Team Leader</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            @foreach ($projects as $project)
                                <tbody>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->users[0]->name }}</td>
                                    <td>{{ $project->employee[0]->employee_role }}</td>       
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
