@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">

      <!-- Main content -->

		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Update Student Year</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="POST" action="{{route('year.update',$data->id)}}">
                        @csrf

                        @method('PUT')
					  <div class="row">					
							<div class="col-md-12">						
							<div class="form-group">
								<h5>Year Name <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="name" class="form-control" value="{{$data->name}}" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif  
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

@endsection