@extends('admin.admin_master')
@section('admin')

@php $i=0; @endphp

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Assign Subject List</h3>
                <a href="{{route('assign_sub.create')}}" style="float: right" class="btn btn-rounded btn-primary mb-5">Add Assign Subject</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">SL</th>  
                              <th>Class Name</th>  
                              <th width = 25%>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        
                        @foreach ($data as $assign)
                            
                       
                          <tr>
                              <td>{{ ++$i }}</td>
                              <td>{{ $assign['student_class']['name']}}</td>
                              <td>
                                <a href="{{route('assign_sub.edit',$assign->class_id)}}" class="btn btn-info">Edite</a>
                                <a href="{{route('assign_sub.show',$assign->class_id)}}" class="btn btn-primary">Details</a>
                                <a href="{{route('assign_sub.del',$assign->class_id)}}" id="delete" class="btn btn-danger">Delete</a>
                               
                                    
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