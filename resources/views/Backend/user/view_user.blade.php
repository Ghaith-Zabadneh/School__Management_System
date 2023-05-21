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
                <h3 class="box-title">User List</h3>
                <a href="{{route('users.create')}}" style="float: right" class="btn btn-rounded btn-primary mb-5">Add User</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">ID</th>
                              <th>Role</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Code</th>
                              <th width = 25%>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($data['All_Data'] as $key => $user )
                            
                       
                          <tr>
                              <td>{{ $user->id}}</td>
                              <td>{{$user->role}}</td>
                              <td>{{ $user->name}}</td>
                              <td>{{ $user->email}}</td>
                              <td>{{ $user->code}}</td>
                              <td>
                                <a href="{{route('users.edit',$user->id)}}" class="btn btn-info">Edite</a>
                                <a href="{{route('user.del',$user->id)}}" id="delete" class="btn btn-danger">Delete</a>
                               
                                    
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