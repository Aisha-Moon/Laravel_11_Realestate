@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

   
    <div class="row profile-body">
      <!-- left wrapper start -->
      <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
        <div class="card rounded">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <h6 class="card-title mb-0">About</h6>
           
            </div>
            <p>Hi! I'm Amiah the Senior UI Designer at NobleUI. We hope you enjoy the design and quality of Social.</p>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Name</label>
              <p class="text-muted">{{ Auth::user()->name }}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Joined:</label>
              <p class="text-muted">November 15, 2015</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Lives:</label>
              <p class="text-muted">New York, USA</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
              <p class="text-muted">me@nobleui.com</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Website:</label>
              <p class="text-muted">www.nobleui.com</p>
            </div>
        
          </div>
        </div>
      </div>
      <!-- left wrapper end -->
      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-9 middle-wrapper">
        <div class="row">
         
					<div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
            
                                            <h6 class="card-title">Profile Update</h6>
            
                                            <form class="forms-sample" method="post" action="">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Username</label>
                                                    <input type="text" class="form-control" placeholder="Username" name="username">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email address</label>
                                                    <input type="email" class="form-control" placeholder="Email" name="email">
                                                </div>
                                                <div class="mb-3">
                                                    <label  class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="password"  placeholder="Password">
                                                </div>
                                                <div class="mb-3">
                                                    <label  class="form-label">Profile Image</label>
                                                    <input type="file" class="form-control" name="photo" >
                                                </div>
                                                <div class="mb-3">
                                                    <label  class="form-label">Address</label>
                                                    <input type="text" class="form-control" name="address"  placeholder="Address">
                                                </div>
                                                <div class="mb-3">
                                                    <label  class="form-label">About</label>

                                                    <textarea name="about" type="text" placeholder="About" class="form-control"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label  class="form-label">Website</label>
                                                    <input type="text" class="form-control" name="website"  placeholder="Website">
                                                </div>
                                               
                                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                                <button class="btn btn-secondary">Cancel</button>
                                            </form>
            
                          </div>
                        </div>
                                </div>
        </div>
      </div>
      <!-- middle wrapper end -->
   
    </div>

        </div>

@endsection