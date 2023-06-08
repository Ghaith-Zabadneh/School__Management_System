@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="box">
              <div class="box-header with-border">
                <h4 class="box-title box-title-bold">Employee Monthly Salary</h4>
              </div>
              <div class="box-body">
                    <div class="row">                 
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5> Attendance Date <span class="text-danger"></span></h5>
                                <div class="controls">
                                    <input type="date" name="date" id="date" class="form-control"  data-validation-required-message="This field is required">
                                </div>
                            </div> <!-- // end form group -->
                        </div> <!-- End col-md-6 -->

                        <div class="text-xs-right" style="padding-top: 25px;">
                            <a id="search"  class="btn btn-primary" name="search">Search</a>
                        </div>
                    </div> <!--end row -->
                    <div class = "row d-none" id="employee-salary">
                        <div class='col-md-12'>
                            <table class="table table-bordered table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Employee Name </th>
                                        <th>Salary </th>
                                        <th>Number Of Absent Day </th>
                                        <th>This Month Salary</th>
                                        <th style="width:15% ">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="employee-salary-tr">
                                    

                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
              </div>
            </div>
          </div>

        </section>
        <!-- /.content -->
      
      </div>
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    $(document).on('click','#search',function(){
      var date = $('#date').val();  
       $.ajax({
        url: "{{ route('month.salary.search')}}",
        type: "GET",
        data: {'date':date },
        success: function (data) {
          $('#employee-salary').removeClass('d-none');
          var html = '';
          $.each( data, function(key, v){
            html +=
            '<tr>'+
            '<td>'+v.SL+'<input type="hidden" name="student_id[]" value="'+v.employee_id+'"></td>'+
            '<td>'+v.name+'</td>'+
             '<td>'+v.salary+' SP</td>'+
             '<td>'+v.number_of_absent_day+'</td>'+
             '<td>'+v.total_salary+' SP</td>'+
             '<td><a href="{{ url("employee/month/salary/print") }}/' + v.employee_id + '/' + v.date + '" target="_black" class="btn btn-info">Salary Slip</a></td>'+
            '</tr>';
          });
          html = $('#employee-salary-tr').html(html);
        }
      });
    });
  
  </script>
  
  @endsection

  
