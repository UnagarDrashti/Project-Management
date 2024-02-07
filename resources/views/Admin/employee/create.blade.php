@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <label></label>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"> Create Employee</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('owner.store.employee') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="employee_role">Employee role:</label>
                                <select name="employee_role" class="form-control @error('employee_role') is-invalid @enderror" required>
                                        <option>Select Option</option>
                                        <option value="designer">Designer</option>
                                        <option value="developer">Developer</option>
                                </select>
                                @error('employee_role')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Confirm Password:</label>
                                <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror">
                                @error('confirm_password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Create Employee</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

