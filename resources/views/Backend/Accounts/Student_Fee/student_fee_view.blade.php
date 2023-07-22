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
                <h3 class="box-title">Student Fee List</h3>
                <a href="{{route('student_account.create')}}" style="float: right" class="btn btn-rounded btn-primary mb-5">Add / Edite Student Fee</a>
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
                              <th>Year</th>
                              <th>Class</th>
                              <th>Fee Type</th>
                              <th>Amount</th>
                              <th>Date</th>

                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $key => $fee )
                          <tr>
                              <td>{{ ++$key }}</td>
                              <td>{{ $fee['student']->id_number}}</td>
                              <td>{{ $fee['student']->name}}</td>
                              <td>{{ $fee['student_year']->name}}</td>
                              <td>{{ $fee['student_class']->name}}</td>
                              <td>{{ $fee['fee_category']->name}}</td>
                              <td>{{ $fee->amount}}</td>
                              <td>{{ $fee->date}}</td>

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
