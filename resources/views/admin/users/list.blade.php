@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users List</li>
        </ol>
    </nav>
<div class="row">
    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Users List</h4>
                <p class="text-muted mb-3">
                    Add class <code>.table-{color}</code> and <code>.text-dark</code>
                </p>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Photo</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Website</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Created date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($getRecord as $user)
                          <tr class="table-info text-dark">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td><img src="{{ asset('uploads/admin_images/'.$user->photo) }}" style="width: 50px; height: 50px;" alt=""></td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->website }}</td>
                            <td>
                                @if( ($user->role)=='admin' )
                                <span class="badge bg-info">Admin</span>
                                @elseif ($user->role=='user')
                                <span class="badge bg-primary">User</span>

                                @elseif($user->role=='agent')
                                <span class="badge bg-secondary">Agent</span>

                                @endif
                            </td>
                            <td>
                                @if( ($user->status)=='active' )
                                <span class="badge bg-success">Active</span>
                                @elseif ($user->role=='inactive')
                                <span class="badge bg-danger">Inactive</span>



                                @endif
                            </td>
                            <td>{{ date('d-m-Y',strtotime($user->created_at)) }}</td>
                            <td> <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/users/view/'.$user->id) }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                            </td>
                        </tr>
                          @endforeach

                        </tbody>
                    </table>
                    <div style="padding: 20px;float:right">
                        <!-- Pagination links -->
                      {!! $getRecord->appends(\Illuminate\Support\Facades\Request::except('page'))->links() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
