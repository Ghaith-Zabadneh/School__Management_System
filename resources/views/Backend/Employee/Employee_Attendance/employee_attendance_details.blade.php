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
                <h3 class="box-title">Attendance Details</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>ID Number</th> 
                              <th>Name</th> 
                              <th>Date</th>    
                              <th>Attend Status</th>  
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($details as $attendance )
                            
                       
                          <tr>
                            <td>{{ $attendance['user']->id_number}}</td>
                              <td>{{ $attendance['user']->name}}</td>
                              <td>{{ $attendance->date}}</td>
                              <td>{{ $attendance->attend_status}}</td>                          
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