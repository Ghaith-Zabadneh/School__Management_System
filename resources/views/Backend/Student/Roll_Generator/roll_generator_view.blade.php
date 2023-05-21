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
                <h4 class="box-title box-title-bold">Student Roll Generator</h4>
              </div>
              <div class="box-body">
                <form method="GET" action="{{route('reg.search')}}">
                    @csrf
                    <div class="row">                 
                        <div class="col-md-4">
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
                        </div> <!-- End col-md-4 -->

                        <div class="col-md-4">

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
                        </div> <!-- End col-md-4 -->

                        <div class="text-xs-right" style="padding-top: 25px;">
                            <a id="search" class="btn btn-primary" name="search">Search</a>
                        </div>
                    </div> <!--end row -->
                    <div class = "row d-none" id="roll-generate">
                        <div class='col-md-12'>
                            <table class="table table-bordered table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>ID Number </th>
                                        <th>Student Name </th>
                                        <th>Student Father </th>
                                        <th>Gender </th>
                                        <th>Roll </th>
                                    </tr>
                                </thead>
                                <tbody id="roll-generate-tr">

                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-info" value="Roll Generator">

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
        url: "{{ route('roll.get_student')}}",
        type: "GET",
        data: {'year_id':year_id,'class_id':class_id},
        success: function (data) {
          $('#roll-generate').removeClass('d-none');
          var html = '';
          $.each( data, function(key, v){
            html +=
            '<tr>'+
            '<td>'+v.student.id_number+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
            '<td>'+v.student.name+'</td>'+
            '<td>'+v.student.personalInformation.fathe_name+'</td>'+
            '<td>'+v.student.personalInformation.gender+'</td>'+
            '<td><input type="text" class="form-control form-control-sm" name="roll[]" value="'+v.roll+'"></td>'+
            '</tr>';
          });
          html = $('#roll-generate-tr').html(html);
        }
      });
    });
  
  </script>
  
  @endsection

  
