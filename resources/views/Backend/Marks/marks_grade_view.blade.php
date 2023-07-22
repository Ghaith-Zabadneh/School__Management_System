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
                <h3 class="box-title">Grade Marks List</h3>
                <a href="{{route('grade.create')}}" style="float: right" class="btn btn-rounded btn-primary mb-5">Add Grade</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">

                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">SL</th>
                              <th>Grade Name</th>
                              <th>Grade Point</th>
                              <th>Start Mark</th>
                              <th>End Mark</th>
                              <th>Point Range</th>
                              <th>Remark</th>
                              <th width = 15%>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $grade )


                          <tr>
                              <td>{{ ++$i }}</td>
                              <td>{{ $grade->grade_name}}</td>
                              <td>{{ $grade->grade_point}}</td>
                              <td>{{ $grade->start_mark}}</td>
                              <td>{{ $grade->end_mark}}</td>
                              <td>{{ $grade->start_point}} - {{$grade->end_point}}</td>
                              <td>{{ $grade->remark}}</td>
                              <td>
                                <a href="{{route('grade.edit',$grade->id)}}" class="btn btn-info">Edite</a>
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
