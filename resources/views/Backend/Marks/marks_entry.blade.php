@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="box">
              <div class="box-header with-border">
                <h4 class="box-title box-title-bold">Marks Entry</h4>
              </div>
              <div class="box-body">
                <form method="POST" action="{{route('marks.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <h5> Year <span class="text-danger"></span></h5>
                                <div class="controls">
                                    <select name="year_id" id="year_id" required=""  class="form-control">
                                        <option value="" selected="" >Select Year</option>
                                        @foreach($years as $year)
                                        <option value="{{$year->id}}">{{ $year->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> <!-- // end form group -->
                        </div> <!-- End col-md-3 -->

                        <div class="col-md-3">

                        <div class="form-group">
                            <h5> Class <span class="text-danger"></span></h5>
                                <div class="controls">
                                    <select name="class_id" id="class_id" value="" class="form-control">
                                        <option value="" selected="" disabled="">Select Class</option>
                                        @foreach($classes as $class)
                                        <option value="{{$class->id}}" >{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> <!-- // end form group -->
                        </div> <!-- End col-md-3 -->

                        <div class="col-md-3">
                            <div class="form-group">
                                <h5> Subject <span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <select name="assign_subject_id" id="assign_subject_id" value="" class="form-control">
                                            <option selected="" >Select Subject</option>

                                        </select>
                                    </div>
                                </div> <!-- // end form group -->
                            </div> <!-- End col-md-3 -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5> Exam Type <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <select name="exam_type_id" id="exam_type_id" value="" class="form-control">
                                                <option value="" selected="" disabled="">Select Class</option>
                                                @foreach($exams as $exam)
                                                <option value="{{$exam->id}}" >{{ $exam->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> <!-- // end form group -->
                                </div> <!-- End col-md-3 -->
                            </div> <!--end row -->

                        <div class="text-xs-right" >
                            <a id="search" class="btn btn-primary" name="search">Search</a><br><br>
                        </div>

                    <div class = "row d-none" id="mark_entry">
                        <div class='col-md-12'>
                            <table class="table table-bordered table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>ID Number </th>
                                        <th>Student Name</th>
                                        <th>Gender </th>
                                        <th>Mark </th>
                                    </tr>
                                </thead>
                                <tbody id="mark_entry-tr">


                                </tbody>
                            </table>
                            <input type="submit" class="btn btn-info" value="Add">
                        </div>
                    </div>

                </form>
              </div>
            </div>
          </div>

        </section>
        <!-- /.content -->

      </div>
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    $(document).on('click','#search',function(){
      var year_id = $('#year_id').val();
      var class_id = $('#class_id').val();

       $.ajax({
        url: "{{ route('marks.get_student')}}",
        type: "GET",
        data: {'year_id':year_id,'class_id':class_id},
        success: function (data) {
          $('#mark_entry').removeClass('d-none');
          var html = '';
          $.each( data, function(key, v){
            console.log(v);
            html +=
            '<tr>'+
            '<td>'+v.id_number+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"> <input type="hidden" name="id_number[]" value="'+v.id_number+'"> </td>'+
            '<td>'+v.name+'</td>'+
            '<td>'+v.gender+'</td>'+
            '<td><input type="text" class="form-control form-control-sm" name="mark[]"></td>'+
            '</tr>';
          });
          html = $('#mark_entry-tr').html(html);
        }
      });
    });

  </script>
  <script type="text/javascript">
    $(function(){
      $(document).on('change','#class_id',function(){
        var class_id = $('#class_id').val();
        $.ajax({
          url:"{{ route('marks.get_subject') }}",
          type:"GET",
          data:{'class_id':class_id},
          success:function(data){
            var html = '<option value="">Select Subject</option>';
            $.each( data, function(key, v) {
              html += '<option value="'+v.id+'">'+v.name+'</option>';
            });
            $('#assign_subject_id').html(html);
          }
        });
      });
    });
  </script>

  @endsection


