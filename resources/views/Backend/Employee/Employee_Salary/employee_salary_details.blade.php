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
                <h3 class="box-title">Employee Salary Details</h3>
                <br><br>
                <h4>Empolyee ID: {{$employee->id_number}}</h4>
                <h4>Empolyee Name: {{$employee->name}}</h4>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>Previous Salary</th>    
                              <th>Increment Salary</th> 
                              <th>Present Salary</th>
                              <th>Effective Salary</th> 
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($salary_data as $salary )
                            
                       
                          <tr>
                              <td>{{ $salary->previous_salary }}</td>
                              <td>{{ $salary->increment_salary}}</td>
                              <td>{{ $salary->present_salary}}</td>
                              <td>{{ $salary->effective_salary}}</td>                                       
                          </tr>


                        @endforeach
                      </tbody>
                      <tfoot>
           
                      </tfoot>
                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
       
            <!-- /.box -->          
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
      </section>
      <!-- /.content -->
    
    </div>
</div>
<!-- /.content-wrapper -->

   


@endsection