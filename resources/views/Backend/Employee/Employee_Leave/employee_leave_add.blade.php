@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="content-wrapper">
    <div class="container-full">

      <!-- Main content -->

		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Add Employee Leave</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="POST" action="{{route('leave.store')}}">
                        @csrf
					  <div class="row">
							<div class="col-md-12">	
                                <div class="row">
                                    <div class="col-md-6">	
                                        <div class="form-group">
                                            <h5>Employee Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="employee_id" id="employee_id" required="" value="" class="form-control">
                                                    <option value="" selected="" disabled="">Select Class</option>
                                                    @foreach($employees as $employee)
                                                    <option value="{{$employee['id']}}">{{ $employee['name'] }}</option>
                                                    @endforeach	 
                                                </select>
                                                @if ($errors->has('employee_id'))
                                                    <span class="text-danger">{{ $errors->first('employee_id') }}</span>
                                                @endif   
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-md-6">	
                                    <div class="form-group">
                                        <h5>Start Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="start_date" id="start_date" value="" class="form-control"  data-validation-required-message="This field is required">
                                            @if ($errors->has('start_date'))
                                                <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                            @endif   
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">	
                                <div class="col-md-6">	
                                    <div class="form-group">
                                        <h5>Purpose <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="purpose" id="leave_purpose_id" required="" value="" class="form-control">
                                                <option value="" selected="" disabled="">Select Employee</option>
                                                @foreach($purposes as $purpose)
                                                <option value="{{$purpose->id}}">{{ $purpose->name }}</option>
                                                @endforeach
                                                <option value ="0">New Purposes</option>
                                                <input  type="text" name="name" id="add_another" class="form-control" placeholder="Write purpose" style="display: none;">	 
                                            </select>
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif   
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">	
                                    <div class="form-group">
                                        <h5>End Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="end_date" value="" class="form-control"  data-validation-required-message="This field is required">
                                            @if ($errors->has('end_date'))
                                                <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                            @endif   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>{{--  End col --}}
                  </div> {{-- End Row --}}
                      
		
							
						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info" value="Add">
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

<script>
      $(document).ready(function() {
        var employees = @json($employees);     
        $('#employee_id').change(function() {
            var selectedEmployeeId = $(this).val();
            var employee = employees.find(function(emp) {
                return emp.id == selectedEmployeeId;
            });  
            if (employee) {
                var startDate = employee.start_date;
                var formattedStartDate = new Date(startDate).toISOString().split('T')[0];
                $('#start_date').val(formattedStartDate);
            } else {
                $('#start_date').val('');
            }
        });
        $(document).on('change', '#leave_purpose_id',function(){
            var leave_purpose_id = $(this).val();
            if (leave_purpose_id == '0'){
                $('#add_another').show();
            }else{
                $('#add_another').hide();
            }
            
        })
    });
</script>

@endsection