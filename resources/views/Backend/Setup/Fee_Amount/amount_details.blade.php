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
                <h3 class="box-title">Student Fee Amount Details</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                   <h4><strong>Fee Category: </strong> {{$data['0']['fee_category']['name'] }}</h4>               
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead class="thead-light">
                          <tr>
                              <th width="5%">SL</th>  
                              <th>Class Name</th>  
                              <th width = 25%>Amount</th>
                          </tr>
                      </thead>
                      <tbody>
                        
                        @foreach ($data as $detail)                                                 
                          <tr>
                              <td>{{ ++$i }}</td>
                              <td>{{ $detail['student_class']['name']}}</td>
                              <td>{{ $detail->amount}}</td>                              
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