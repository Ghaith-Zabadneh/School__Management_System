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
                <h3 class="box-title">Employee Attendance List</h3>
                <a href="{{route('attendance.create')}}" style="float: right" class="btn btn-rounded btn-primary mb-5">Add Attendance</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>Date</th>  
                              <th width = 25%>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($all_data as $attendance )
                            
                       
                          <tr>
                              <td>{{ $attendance->date}}</td>
                              <td>
                                <a href="{{route('attendance.edit',$attendance->date)}}" class="btn btn-info">Edite</a>
                                <a href="{{route('attendance.show',$attendance->date)}}" class="btn btn-success">Details</a>
            
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