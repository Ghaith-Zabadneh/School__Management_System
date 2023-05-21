@extends('admin.admin_master')
@section('admin')

@php
    $i=0;    
@endphp
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col-12">
            <div class="box">
              <div class="box-header with-border">
              <h4 class="box-title box-title-bold">Student Search</h4>
              </div>
              <div class="box-body">
                <form method="GET" action="{{route('reg.search')}}"> 
                  <div class="row">
                   
                    <div class="col-md-4">

                      <div class="form-group">
                      <h5> Year <span class="text-danger"></span></h5>
                          <div class="controls">
                              <select name="year_id" required=""  class="form-control">
                                  <option value="" selected="" >Select Year</option>
                                  @foreach($data['years'] as $year)
                                  <option value="{{ $year->id }}" {{$data['year_id'] == $year->id ? 'selected' : "" }}>{{ $year->name }}</option>
                                  @endforeach	 
                              </select>
                          </div>
                      </div> <!-- // end form group -->
                    </div> <!-- End col-md-4 -->

                    <div class="col-md-4">

                      <div class="form-group">
                      <h5> Class <span class="text-danger"></span></h5>
                          <div class="controls">
                              <select name="class_id"  value="" class="form-control">
                                  <option value="" selected="" disabled="">Select Class</option>
                                  @foreach($data['classes'] as $class)
                                  <option value="{{$class->id}}" {{$data['class_id'] == $class->id ? 'selected' : "" }} >{{ $class->name }}</option>
                                  @endforeach	 
                              </select>
                          </div>
                      </div> <!-- // end form group -->
                    </div> <!-- End col-md-4 -->

                    <div class="text-xs-right" style="padding-top: 25px;">
                      <input type="submit" class="btn btn-rounded btn-primary mb-5" name="search" value="Search">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
            
          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Student List</h3>
                <a href="{{route('reg.create')}}" style="float: right" class="btn btn-rounded btn-primary mb-5">Add Student</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">SL</th>    
                              <th>ID Number</th>
                              <th>Name</th>
                              <th>Roll</th>
                              <th>Year</th>
                              <th>Class</th>
                              <th>Image</th>
                              @if (Auth::user()->role=='Admin')
                              <th>Code</th>
                              @endif
                              <th width = 20%>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($data['all_data'] as $value )
                                                   
                          <tr>
                              <td>{{ ++$i}}</td>
                              <td>{{ $value['student']['id_number']}}</td>
                              <td>{{ $value['student']['name']}}</td>
                              <td>{{ $value->roll}}</td>
                              <td>{{ $value['student_year']['name']}}</td>
                              <td>{{ $value['student_class']['name']}}</td>
                              <td><img src="{{ (!empty($value['student']['image'])? url('upload/users/'.$value['student']['image']) : url('upload/no_image.jpg') )}}"  style= "width: 70px; hight :70px; "></td>
                              @if (Auth::user()->role=='Admin')
                              <td>{{ $value['student']['code']}}</td>
                              @endif
                              <td>
                                <a href="{{route('reg.edit',$value->student_id)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                <a href="{{route('reg.promotion.edit',$value->student_id)}}"  class="btn btn-success"><i class="fa fa-check"></i></a>
                                <a href="{{route('Student.pdf',$value->student_id)}}"  class="btn btn-warning"><i class="fa fa-print"></i></a>
                               
                                    
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