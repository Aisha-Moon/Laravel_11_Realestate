@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/users') }}">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add User</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Horizontal Form</h6>

                    <form class="forms-sample" method="post" action="{{ url('admin/users/create') }}">
                        @csrf
                        <div class="row mb-3">
                            <label  class="col-sm-3 col-form-label">Name <span style="color:red">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"  placeholder="Name" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-sm-3 col-form-label">Username <span style="color:red">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-sm-3 col-form-label">Email <span style="color:red">*</span></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}"  autocomplete="off" placeholder="Email" required>
                                <span style="color:red;">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Mobile</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="phone" value="{{ old('phone') }}"  placeholder="Mobile number">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Role <span style="color:red">*</span></label>
                            <div class="col-sm-9">
                                <select name="role" class="form-control" required>
                                    <option value="">Select Role</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="agent" {{ old('role') == 'agent' ? 'selected' : '' }}>Agent</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Status <span style="color:red">*</span></label>
                            <div class="col-sm-9">
                                <select name="status" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href={{ url('admin/users') }} class="btn btn-secondary">Back</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
