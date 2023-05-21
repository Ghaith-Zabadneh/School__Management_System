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
                <h3 class="box-title">Student Class</h3>
                <a href="{{route('class.create')}}" style="float: right" class="btn btn-rounded btn-primary mb-5">Add Student Class</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">ID</th>  
                              <th>Name</th>  
                              <th width = 25%>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $class )
                            
                       
                          <tr>
                              <td>{{ $class->id}}</td>
                              <td>{{ $class->name}}</td>
                              <td>
                                <a href="{{route('class.edit',$class->id)}}" class="btn btn-info">Edite</a>
                                <a href="{{route('class.del',$class->id)}}" id="delete" class="btn btn-danger">Delete</a>
                               
                                    
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