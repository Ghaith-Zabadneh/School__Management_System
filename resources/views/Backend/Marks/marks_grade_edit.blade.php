@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">

      <!-- Main content -->

		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Edit Grade Mark</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="POST" action="{{route('grade.update',$data->id)}}">
                        @method('PUT')
                        @csrf
					  <div class="row">
							<div class="col-md-4">
							<div class="form-group">
								<h5>Grade Name <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="grade_name" value="{{$data->grade_name}}" class="form-control"  data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                    @if ($errors->has('grade_name'))
                                        <span class="text-danger">{{ $errors->first('grade_name') }}</span>
                                    @endif
							</div>
                            </div>{{--  End col --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Grade Point <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="grade_point" class="form-control" value="{{$data->grade_point}} " data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                        @if ($errors->has('grade_point'))
                                            <span class="text-danger">{{ $errors->first('grade_point') }}</span>
                                        @endif
                                </div>
                            </div>{{--  End col --}}
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Start Mark <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="start_mark" class="form-control" value="{{$data->start_mark}}" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                            @if ($errors->has('start_mark'))
                                                <span class="text-danger">{{ $errors->first('start_mark') }}</span>
                                            @endif
                                    </div>
                            </div>{{--  End col --}}

                      </div> {{-- End Row --}}
					  <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>End Mark <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="end_mark" class="form-control" value="{{$data->end_mark}}" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                        @if ($errors->has('end_mark'))
                                            <span class="text-danger">{{ $errors->first('end_mark') }}</span>
                                        @endif
                                </div>
                            </div>{{--  End col --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Start Point <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="start_point" class="form-control" value="{{$data->start_point}} " data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                        @if ($errors->has('start_point'))
                                            <span class="text-danger">{{ $errors->first('start_point') }}</span>
                                        @endif
                                </div>
                            </div>{{--  End col --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>End Point <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="end_point" class="form-control" value="{{$data->end_point}} " data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                        @if ($errors->has('end_point'))
                                            <span class="text-danger">{{ $errors->first('end_point') }}</span>
                                        @endif
                                </div>
                            </div>{{--  End col --}}
                        </div> {{-- End Row --}}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Remark <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="remark" class="form-control" value="{{$data->remark}}" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                        @if ($errors->has('remark'))
                                            <span class="text-danger">{{ $errors->first('remark') }}</span>
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
