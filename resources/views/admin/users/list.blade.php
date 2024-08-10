@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">

    @include('profile._message')


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
                    <h6 class="card-title">
                        Search Users
                    </h6>
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="" class="form-label">ID</label>
                                    <input type="text" name="id" value="{{ Request()->id }}" class="form-control" placeholder="Enter ID">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" name="name" value="{{ Request()->name }}" class="form-control" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Username</label>
                                    <input type="text" name="username" value="{{ Request()->username }}" class="form-control" placeholder="Enter Username">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="text" name="email" value="{{ Request()->email }}" class="form-control" placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Phone</label>
                                    <input type="text" name="phone" value="{{ Request()->phone }}" class="form-control" placeholder="Enter Phone">
                                </div>
                            </div>
                            {{-- <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Address</label>
                                    <input type="text" name="" class="form-control" placeholder="Enter Address">
                                </div>
                            </div> --}}
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Website</label>
                                    <input type="text" name="website" value="{{ Request()->website }}" class="form-control" placeholder="Enter Website">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="" class="form-label">Role</label>
                                    <select name="role" class="form-control">
                                        <option value="">Select Role</option>
                                        <option value="admin" {{ (Request()->role === "admin") ? 'selected' : '' }}>Admin</option>
                                        <option value="agent" {{ (Request()->role === "agent") ? 'selected' : '' }}>Agent</option>
                                        <option value="user" {{ (Request()->role === "user") ? 'selected' : '' }}>User</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="" class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="active" {{ (Request()->role=="active") ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ (Request()->role=="inactive") ? 'selected' : '' }}>Inactive</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                            <button type="submit" class="btn btn-primary"> Search</button>
                            <a href="{{ url('admin/users') }}" class="btn btn-danger">Reset</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
<div class="row">
    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="card-title">Users List</h4>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a>

                    </div>
                </div>
                <p class="text-muted mb-3">
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
                          @forelse($getRecord as $user)
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
                                @if($user->role=='admin' )
                                <span class="badge bg-info">Admin</span>
                                @elseif ($user->role=='user')
                                <span class="badge bg-primary">User</span>

                                @elseif($user->role=='agent')
                                <span class="badge bg-secondary">Agent</span>

                                @endif
                            </td>
                            <td>
                                @if( $user->status=='active' )
                                <span class="badge bg-success">Active</span>
                                @elseif ($user->role=='inactive')
                                <span class="badge bg-danger">Inactive</span>



                                @endif
                            </td>
                            <td>{{ date('d-m-Y',strtotime($user->created_at)) }}</td>
                            <td> <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/users/view/'.$user->id) }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/users/edit/'.$user->id) }}"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                                <a class="dropdown-item d-flex align-items-center"  href="{{ url('admin/users/delete/'.$user->id) }}" onclick="return confirm('Are you sure  want to delete this?')"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>


                            </td>
                        </tr>
                          @empty
                          <tr>
                              <td colspan="12" class="text-center text-danger">No Record Found</td>
                          </tr>

                          @endforelse

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
