@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <div class="container-full">

      <!-- Main content -->

		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Update Profile</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="POST" action="{{route('profile.update',$user->id)}}" enctype="multipart/form-data">
                        @csrf
					  <div class="row">
						<div class="col-md-6">						
							<div class="form-group">
								<h5>User Name <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="name" class="form-control" value="{{$user->name}}" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
								
							</div>
                        </div>{{--  End col --}}
                        <div class="col-md-6">
							<div class="form-group">
								<h5>Email <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="email" name="email" class="form-control" value="{{$user->email}}" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
							</div>
                        </div>{{--  End col --}}
                      </div> {{-- End Row --}}

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Mobile Phone <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="mobile" class="form-control" value="{{$user->personalInformation->mobile}}" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                </div>
                            </div>{{--  End col --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Adderss <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="address" class="form-control" value="{{$user->personalInformation->address}}" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                </div>
                            </div>{{--  End col --}}
                        
                            
                        </div> {{-- End Row --}}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>User Gender <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="gender" id="select" required="" class="form-control" >
                                            <option value="">Select your gender</option>
                                            <option value="Male" {{ ($user->personalInformation->gender == "Male" ? "selected" : "")}}>Male</option>
                                            <option value="Female" {{ ($user->personalInformation->gender == "Female" ? "selected" : "")}}>Female</option>
                                        </select>
                                    <div class="help-block"></div></div>
                                </div>
                            </div> {{--  End col --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Profile Image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="image" class="form-control" id="image" value="{{$user->image}}"  data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                </div>
                                <div class="form-group">
                                    <div class="controls">
                                        <img id="showimage" src="{{ (!empty($user->image)? url('upload/users/'.$user->image) : url('upload/no_image.jpg') )}}"  style= "width: 100px; hight :100px; border:1px; soild #0000 ">
                                    </div>
                                </div>
                            </div>{{--  End col --}}



                        </div> {{-- End Row --}}
		
							
						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info" value="Update">
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
		<!-- /.content -->
	  
    
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showimage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection


