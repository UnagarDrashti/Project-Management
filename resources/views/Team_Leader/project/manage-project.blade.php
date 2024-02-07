@extends('Team_Leader.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{ route('team-leader.create.project') }}" class="btn btn-primary mb-3">Create Project</a>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Project List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-center data-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Team Leader</th>
                                    <th>Employee</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(function () {
      
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('team-leader.manage.project') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'tl_id', name: 'tl_id'},
              {data: 'emp_id', name: 'emp_id'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
</script>
@endsection