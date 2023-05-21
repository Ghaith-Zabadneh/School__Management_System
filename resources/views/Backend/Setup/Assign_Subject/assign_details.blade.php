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
                <h3 class="box-title">Assign Subject Details</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                   <h4><strong>Class Name: </strong> {{$data['0']['student_class']['name'] }}</h4>               
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead class="thead-light">
                          <tr>
                              <th width="5%">SL</th>  
                              <th>Subject</th>  
                              <th >Full Mark</th>
                              <th >Pass Mark</th>
                              <th >Subjective Mark</th>
                          </tr>
                      </thead>
                      <tbody>
                        
                        @foreach ($data as $detail)                                                 
                          <tr>
                              <td>{{ ++$i }}</td>
                              <td>{{ $detail['school_subject']['name']}}</td>
                              <td>{{ $detail->full_mark}}</td>
                              <td>{{ $detail->pass_mark}}</td>
                              <td>{{ $detail->subjective_mark}}</td>                              
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