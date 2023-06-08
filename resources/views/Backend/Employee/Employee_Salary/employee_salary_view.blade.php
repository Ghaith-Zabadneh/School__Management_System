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
                <h3 class="box-title">Employee Salary List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>ID Number</th>  
                              <th>Name</th>  
                              <th>Mobile</th> 
                              <th>Gender</th> 
                              <th>Join Date</th> 
                              <th>Salary</th>
                              <th width = 20%>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($employees as $employee )
                            
                       
                          <tr>
                              <td>{{ $employee->id_number }}</td>
                              <td>{{ $employee->name}}</td>
                              <td>{{ $employee->personalInformation->mobile}}</td>
                              <td>{{ $employee->personalInformation->gender}}</td>
                              <td>{{ $employee->personalInformation->join_date}}</td>
                              <td>{{ $employee->personalInformation->salary}}</td>
                              <td>
                                <a href="{{route('salary.edit',$employee->id)}}" title="increment" class="btn btn-info">Increment</a>
                                <a href="{{route('salary.show',$employee->id)}}" target="_black" class="btn btn-success">Details</a>
                               
                                    
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