@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <label></label>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Update Employee Details</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('owner.update.employee', $user->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="employee_role">Employee role:</label>
                                <select name="employee_role" class="form-control @error('employee_role') is-invalid @enderror" required>
                                    <option value="">Select Option</option>
                                        <option value="designer" {{ $user->employee_role == 'designer' ? 'selected' : '' }}>Designer</option>
                                        <option value="developer" {{ $user->employee_role == 'developer' ? 'selected' : '' }}>Developer</option>
                                </select>
                                @error('employee_role')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update Employee</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

