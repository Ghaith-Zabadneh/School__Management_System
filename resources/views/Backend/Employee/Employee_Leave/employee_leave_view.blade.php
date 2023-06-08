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
                <h3 class="box-title">Employee Leave List</h3>
                <a href="{{route('leave.create')}}" style="float: right" class="btn btn-rounded btn-primary mb-5">Add Employee Leave</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>ID Number</th>  
                              <th>Name</th>  
                              <th>Purpose</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th width = 20%>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($employees as $employee )
                            
                       
                          <tr>
                              <td>{{ $employee['user']['id_number']}}</td>
                              <td>{{ $employee['user']['name']}}</td>
                              <td>{{ $employee['purpose']['name']}}</td>
                              <td>{{ $employee->start_date}}</td>
                              <td>{{ $employee->end_date}}</td>
                              <td>
                                <a href="{{route('leave.edit',$employee->id)}}" class="btn btn-info">Edite</a>
                                <a href="{{route('leave.rehiring',$employee->id)}}" class="btn btn-warning">Rehiring</a>
            
                              </td>                            
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