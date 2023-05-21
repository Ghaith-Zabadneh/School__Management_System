@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">

      <!-- Main content -->

		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Change Passwrod</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="POST" action="{{route('profile.password.stor',$user->id)}}" enctype="multipart/form-data">
                        @csrf
					  <div class="row">
						<div class="col-md-12">						
							<div class="form-group">
								<h5>Current Password <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="password" name="old_password" id="current_password" class="form-control" required=""  data-validation-required-message="This field is required"> <div class="help-block">
                                        @if ($errors->has('old_password'))
                                            <span class="text-danger">{{ $errors->first('old_password') }}</span>
                                        @endif   
                                    </div></div>
								
							</div>
                            <div class="form-group">
								<h5>New Password <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="password" name="password" id="password" class="form-control"  required="" data-validation-required-message="This field is required"> <div class="help-block">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif   
                                </div></div>
								
							</div>
                            <div class="form-group">
								<h5>Confirm Password <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="password" name="password_confirmation" id="password_confirmation" class="form-control"  required="" data-validation-required-message="This field is required"> <div class="help-block">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif      
                                    </div></div>
								
							</div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Change">
                            </div>
                        </div>{{--  End col --}}
							
						
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




@endsection


