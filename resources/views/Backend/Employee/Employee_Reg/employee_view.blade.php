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
                <h3 class="box-title">Employee List</h3>
                <a href="{{route('em_reg.create')}}" style="float: right" class="btn btn-rounded btn-primary mb-5">Add Employee</a>
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
                              @if(Auth::user()->role == 'Admin')
                              <th>Code</th>  
                              @endif
                              <th width = 25%>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($all_data as $employee )
                            
                       
                          <tr>
                              <td>{{ $employee->id_number }}</td>
                              <td>{{ $employee->name}}</td>
                              <td>{{ $employee->personalInformation->mobile}}</td>
                              <td>{{ $employee->personalInformation->gender}}</td>
                              <td>{{ $employee->personalInformation->join_date}}</td>
                              <td>{{ $employee->personalInformation->salary}}</td>
                              @if(Auth::user()->role == 'Admin')
                              <td>{{ $employee->code}}</td> 
                              @endif
                              <td>
                                <a href="{{route('em_reg.edit',$employee->id)}}" class="btn btn-info">Edite</a>
                                <a href="{{route('employee.pdf',$employee->id)}}" class="btn btn-success">Details</a>
                               
                                    
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