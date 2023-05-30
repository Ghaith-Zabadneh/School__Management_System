@extends('admin.admin_master')
@section('admin')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col-12">
            <div class="box">
              <div class="box-header with-border">
              <h4 class="box-title box-title-bold">Student Monthly Fee</h4>
              </div>
              <div class="box-body">
                <form method="GET" action="{{route('month.fee.search')}}"> 
                  <div class="row">
                   
                    <div class="col-md-3">

                      <div class="form-group">
                      <h5> Year <span class="text-danger"></span></h5>
                          <div class="controls">
                              <select name="year_id" required=""  class="form-control">
                                  <option value="" selected="" >Select Year</option>
                                  @foreach($data['years'] as $year)
                                  <option value="{{ $year->id }}">{{ $year->name }}</option>
                                  @endforeach	 
                              </select>
                          </div>
                      </div> <!-- // end form group -->
                    </div> <!-- End col-md-3 -->

                    <div class="col-md-3">

                      <div class="form-group">
                      <h5> Class <span class="text-danger"></span></h5>
                          <div class="controls">
                              <select name="class_id"  value="" class="form-control">
                                  <option value="" selected="" disabled="">Select Class</option>
                                  @foreach($data['classes'] as $class)
                                  <option value="{{$class->id}}" >{{ $class->name }}</option>
                                  @endforeach	 
                              </select>
                          </div>
                      </div> <!-- // end form group -->
                    </div> <!-- End col-md-3 -->
                    <div class="col-md-3">

                        <div class="form-group">
                        <h5> Month <span class="text-danger"></span></h5>
                            <div class="controls">
                                <select name="month"  value="" class="form-control">
                                    <option value="" selected="" disabled="">Select Month</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                   
                                </select>
                            </div>
                        </div> <!-- // end form group -->
                      </div> <!-- End col-md-3 -->

                    <div class="text-xs-right" style="padding-top: 25px;">
                      <input type="submit" class="btn btn-rounded btn-primary mb-5" name="search" value="Search">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
           @if($data['all_data'] != "") 
           
          <div class="col-12">

           <div class="box">
              
              <!-- /.box-header -->
              <div class="box-body">
                
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">SL</th>    
                              <th>ID Number</th>
                              <th>Student Name</th>
                              <th>Roll</th>
                              <th>Monthly Fee</th>
                              <th>Discount</th>
                              <th>Student Fee</th>
                              <th width = 20%>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($students as $value )                                                
                          <tr>
                              <td>{{ $value['SL']}}</td>
                              <td>{{ $value['ID_No']}}</td>
                              <td>{{ $value['Student_Name']}}</td>
                              <td>{{ $value['Roll_No']}}</td>
                              <td>{{ $value['Monthly_Fee']}}</td>
                              <td>{{ $value['Discount']}}</td>
                              <td>{{ $value['Student_Fee']}}</td>
                              <td>
                                <a class="btn btn-sm btn-success" title="PaySlip" target="_blanks" href="{{route("month.fee.PaySlip")}}{{'?class_id='.$value['Student_class'].'&student_id='.$value['Student_id'].'&month='.$value['month']}}">Fee Slip</a>             
                              </td>                
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->        
          </div>
          <!-- /.col -->
          @endif
        </div>
        <!-- /.row -->     
      </section>
      <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->
@endsection