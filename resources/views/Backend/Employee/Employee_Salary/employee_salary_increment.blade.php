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
			  <h4 class="box-title">Employee Salary Increment </h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="POST" action="{{route('salary.update',$employee_data->id)}}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
					  <div class="row">
							<div class="col-md-6">						
							    <div class="form-group">
                                    <h5>Salary Amount <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="increment_salary" value="{{old('increment_salary')}}" required class="form-control"  data-validation-required-message="This field is required"> <div class="help-block"></div></div>  
                                </div>
                            </div>{{--  End col --}}

                            <div class="col-md-6">						
							    <div class="form-group">
                                    <h5>Effective Salary <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="effective_salary" value="{{old('effective_salary')}}" class="form-control" required  data-validation-required-message="This field is required"> <div class="help-block"></div></div>  
                                </div>
                            </div>{{--  End col --}}

                      </div> {{-- End 1st Row --}}

						
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



@endsection