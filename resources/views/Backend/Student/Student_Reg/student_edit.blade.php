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
			  <h4 class="box-title">Update Student </h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
                    
					<form method="POST" action="{{route('reg.update',$data['edit_data']->student_id)}}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
					  <div class="row">
							<div class="col-md-4">						
							    <div class="form-group">
                                    <input type="hidden" name="id" value="{{$data['edit_data']->id}}">
                                    <h5>Student Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" value="{{$data['edit_data']['student']->name}}" class="form-control"   data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif   
                                </div>
                            </div>{{--  End col --}}

                            <div class="col-md-4">						
							    <div class="form-group">
                                    <h5>Father Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text"  name="father_name" value="{{$data['edit_data']['student']->personalInformation->father_name}}" class="form-control"  data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                        @if ($errors->has('father_name'))
                                            <span class="text-danger">{{ $errors->first('father_name') }}</span>
                                        @endif   
                                </div>
                            </div>{{--  End col --}}

                            <div class="col-md-4">						
							    <div class="form-group">
                                    <h5>Mother Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="mother_name" value="{{$data['edit_data']['student']->personalInformation->mother_name}}" class="form-control"  data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                        @if ($errors->has('mother_name'))
                                            <span class="text-danger">{{ $errors->first('mother_name') }}</span>
                                        @endif   
                                </div>
                            </div>{{--  End col --}}
                      </div> {{-- End 1st Row --}}

                      <div class="row">

                        <div class="col-md-4">						
                            <div class="form-group">
                                <h5>Email <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="email" name="email" class="form-control" value="{{$data['edit_data']['student']->email}}"  data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif   
                            </div>
                        </div>{{--  End col --}}

                        <div class="col-md-4">						
                            <div class="form-group">
                                <h5>Mobile Number <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="mobile" class="form-control" value="{{$data['edit_data']['student']->personalInformation->mobile}}"  data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                    @if ($errors->has('mobile'))
                                        <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                    @endif   
                            </div>
                        </div>{{--  End col --}}

                        <div class="col-md-4">						
                            <div class="form-group">
                                <h5> Address <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="address" class="form-control" value="{{$data['edit_data']['student']->personalInformation->address}}"  data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                    @if ($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif   
                            </div>
                        </div>{{--  End col --}}

                        
                    </div> {{-- End 2st Row --}}

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
								<h5>Gender <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="gender" value="" id="select" required="" class="form-control">
										<option value="">Select Your Gender</option>
										<option value="Male" {{$data['edit_data']['student']->personalInformation->gender=="Male" ? "selected" : ""}}>Male</option>
										<option value="Female" {{$data['edit_data']['student']->personalInformation->gender=="Female" ? "selected" : ""}}>Female</option>
									</select>
								<div class="help-block"></div></div>
							</div>
                        </div> {{--  End col --}}
                        
                        <div class="col-md-4">						
                            <div class="form-group">
                                <h5> Date Of Birth <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="date" name="date_of_birth" value="{{$data['edit_data']['student']->personalInformation->date_of_birth}}" class="form-control"  data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                    @if ($errors->has('date_of_birth'))
                                        <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                                    @endif   
                            </div>
                        </div>{{--  End col --}}

                        <div class="col-md-4">						
                            <div class="form-group">
                                <h5> Discount <span class="text-danger"></span></h5>
                                <div class="controls">
                                    <input type="text" name="discount" value="{{$data['edit_data']['discount']->discount}}" class="form-control"  data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                    @if ($errors->has('discount'))
                                        <span class="text-danger">{{ $errors->first('discount') }}</span>
                                    @endif   
                            </div>
                        </div>{{--  End col --}}


                      </div> {{-- End 3st Row --}}


                      <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">
                            <h5> Class <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="class_id" required="" value="" class="form-control">
                                        <option value="" selected="" disabled="">Select Class</option>
                                        @foreach($data['classes'] as $class)
                                        <option value="{{$class->id}}" {{$data['edit_data']->class_id == $class->id ? 'selected' : "" }} >{{ $class->name }}</option>
                                        @endforeach	 
                                    </select>
                                </div>
                            </div> <!-- // end form group -->
                        </div> <!-- End col-md-4 -->

                        <div class="col-md-4">

                            <div class="form-group">
                            <h5> Year <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="year_id" required=""  class="form-control">
                                        <option value="" selected="" disabled="">Select Year</option>
                                        @foreach($data['years'] as $year)
                                        <option value="{{ $year->id }}" {{$data['edit_data']->year_id == $year->id ? 'selected' : "" }}>{{ $year->name }}</option>
                                        @endforeach	 
                                    </select>
                                </div>
                            </div> <!-- // end form group -->
                        </div> <!-- End col-md-4 -->

                        <div class="col-md-4">

                            <div class="form-group">
                            <h5> Group <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="group_id" required=""  class="form-control">
                                        <option value="" selected="" disabled="">Select Group</option>
                                        @foreach($data['groups'] as $group)
                                        <option value="{{ $group->id }}" {{$data['edit_data']->group_id == $group->id ? 'selected' : "" }}>{{ $group->name }}</option>
                                        @endforeach	 
                                    </select>
                                </div>
                            </div> <!-- // end form group -->
                        </div> <!-- End col-md-4 -->

                       


                      </div> {{-- End 4st Row --}}

                      <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">
                            <h5> Shift <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="shift_id" required="" value="{{old('shift_id')}}" class="form-control">
                                        <option value="" selected="" disabled="">Select Shift</option>
                                        @foreach($data['shifts'] as $shift)
                                        <option value="{{ $shift->id }}" {{$data['edit_data']->shift_id == $shift->id ? 'selected' : "" }}>{{ $shift->name }}</option>
                                        @endforeach	 
                                    </select>
                                </div>
                            </div> <!-- // end form group -->
                        </div> <!-- End col-md-4 -->  

                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Image <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" name="image" class="form-control" id="image"  data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                    @if ($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif 
                            </div>
                        </div>{{--  End col --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="controls">
                                    <img id="showimage" src="{{ (!empty($data['edit_data']['student']->image)? url('upload/users/'.$data['edit_data']['student']->image) : url('upload/no_image.jpg') )}}"  style= "width: 100px; hight :100px; border:1px; soild #0000 ">
                                </div>
                            </div>
                        </div>{{--  End col --}}

                      </div> {{-- End 5st Row --}}
                      
		
							
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