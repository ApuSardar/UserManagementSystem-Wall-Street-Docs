@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        {{-- <div class="row">
            <div class="col-xl-12">
                <div class="card overflow-hidden">
                    <div class="bg-soft-primary">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-3">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p>It will seem like simplified</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="{{ asset('backend/assets/images/profile-img.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <img src="{{ asset('backend/assets/images/users/avatar-1.jpg') }}" alt="" class="img-thumbnail rounded-circle">
                                </div>
                                <h5 class="font-size-15 text-truncate">{{ $adminData->name }}</h5>
                                <p class="text-muted mb-0 text-truncate">UI/UX Designer</p>
                            </div>

                            <div class="col-sm-8">
                                <div class="pt-4">
                                   
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="font-size-15">125</h5>
                                            <p class="text-muted mb-0">Projects</p>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="font-size-15">$1245</h5>
                                            <p class="text-muted mb-0">Revenue</p>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('edit.profile') }}" class="btn btn-primary waves-effect waves-light btn-sm">Edit Profile <i class="mdi mdi-arrow-right ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Personal Information</h4>

                        <p class="text-muted mb-4">Hi I'm {{ $adminData->name }},has been the industry's standard dummy text To an English person, it will seem like simplified English, as a skeptical Cambridge.</p>
                        <div class="table-responsive">
                            <table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Full Name : {{ $adminData->name }}</th>
                                       
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row">E-mail :{{ $adminData->email }} </th>
                                      
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end card -->

             
            </div>         
            

        </div> --}}
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
            
                        <h4 class="card-title">Edit Profile Page </h4>
            
                        <form method="post" action="{{ route('store.profile') }}" enctype="multipart/form-data">
                            @csrf
            
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input name="name" class="form-control" type="text" value="{{ $editData->name }}"  id="example-text-input">
                            </div>
                        </div>
                        <!-- end row -->
            
                          <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">User Email</label>
                            <div class="col-sm-10">
                                <input name="email" class="form-control" type="text" value="{{ $editData->email }}"  id="example-text-input">
                            </div>
                        </div>
                        <!-- end row -->
            
            
                          <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">UserName</label>
                            <div class="col-sm-10">
                                <input name="username" class="form-control" type="text" value="{{ $editData->username }}"  id="example-text-input">
                            </div>
                        </div>
                        <!-- end row -->
            
            
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Profile Image </label>
                            <div class="col-sm-10">
                   <input name="profile_image" class="form-control" type="file"  id="image">
                            </div>
                        </div>
                        <!-- end row -->
            
                          <div class="row mb-3">
                             <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
                            <div class="col-sm-10">
                                <img id="showImage" class="rounded avatar-lg" src="{{ asset('backend/assets/images/small/img-5.jpg') }}" alt="Card image cap">
                                <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($editData->profile_image))? url('upload/admin_images/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap">
                            </div>
                        </div>
                        <!-- end row -->
            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Profile">
                        </form>
                         
                       
                       
                    </div>
                </div>
            </div> <!-- end col -->
            </div>
             
            </div>
            </div>
            <script type="text/javascript">
                
                $(document).ready(function(){
                    $('#image').change(function(e){
                        var reader = new FileReader();
                        reader.onload = function(e){
                            $('#showImage').attr('src',e.target.result);
                        }
                        reader.readAsDataURL(e.target.files['0']);
                    });
                });
            </script>
            @endsection 
            
                            </div>
                        </div>
                        <!-- end row -->
            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Profile">
                        </form>
                         
                       
                       
                    </div>
                </div>
            </div> <!-- end col -->
            </div>
             
            </div>
            </div>
            <script type="text/javascript">
                
                $(document).ready(function(){
                    $('#image').change(function(e){
            
                            </div>
                        </div>
                        <!-- end row -->
            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Profile">
                        </form>
            
            
            
                    </div>
                </div>
            </div> <!-- end col -->
            </div>
            
            



      
    </div>
</div>
<script type="text/javascript">
    
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection


            