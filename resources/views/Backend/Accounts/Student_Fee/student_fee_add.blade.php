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
                <h4 class="box-title box-title-bold">Add Student Fee</h4>
              </div>
              <div class="box-body">

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
                            <h5> Fee Category <span class="text-danger"></span></h5>
                                <div class="controls">
                                    <select name="fee_category_id" id="fee_category_id" value="" class="form-control">
                                        <option value="" selected="" disabled="">Select Fee Category</option>
                                        @foreach($fee_categories as $fee)
                                        <option value="{{$fee->id}}" >{{ $fee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                         </div> <!-- // end form group -->
                    </div> <!-- End col-md-3 -->

                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>  Date <span class="text-danger"></span></h5>
                                <div class="controls">
                                    <input type="date" name="date" id="date" class="form-control"  data-validation-required-message="This field is required">
                                </div>
                            </div> <!-- // end form group -->
                        </div> <!-- End col-md-3 -->
                    </div> <!--end row -->

                    <div class="text-xs-right" >
                        <a id="search" class="btn btn-primary" name="search">Search</a><br><br>
                    </div>

                    <div class = "row d-none" id="student_fee">
                        <div class='col-md-12'>
                            <form action="{{route('student_account.store')}}" method="POST">
                                @csrf
                            <table class="table table-bordered table-striped" style="width: 100%">

                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>ID Number </th>
                                        <th>Name </th>
                                        <th>Father Name</th>
                                        <th>Original Fee</th>
                                        <th>Discount Amount</th>
                                        <th>Fee (This Student)</th>
                                        <th >Select</th>
                                    </tr>
                                </thead>

                                    <tbody id="student_fee-tr">

                                    </tbody>


                            </table>
                            <button type="submit" class="btn btn-info" value="Update">Update</button>
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
      var fee_category_id = $('#fee_category_id').val();
      var date = $('#date').val();

       $.ajax({
        url: "{{ route('student_account.show','null')}}",
        type: "GET",
        data: {'date':date ,'year_id': year_id, 'class_id' : class_id, 'fee_category_id' : fee_category_id},
        success: function (data) {
          $('#student_fee').removeClass('d-none');
          var html = '';
          $.each( data, function(key, v){
            console.log(v.date);
            html +=
            '<tr>'+
            '<td>'+v.SL+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
            '<td>'+v.id_number+'<input type="hidden" name="year_id" value= " '+v.year_id +' " ></td>'+
            '<td>'+v.name+'<input type="hidden" name="class_id" value= " '+v.class_id +' " ></td>'+
            '<td>'+v.f_name+'<input type="hidden" name="date" value= " '+v.date +' " ></td>'+
             '<td>'+v.orginal_fee+' SP</td>'+'<input type="hidden" name="fee_category_id" value= " '+v.fee_category_id +' " ></td>'+
             '<td>'+v.discount+'</td>'+
             '<td><input type="text" name="amount[]" value="'+ v.final_fee +' " class="form-control" readonly"></td>'+
             '<td><input type="checkbox" name="checkmanage[' + key + ']" id="id'+v.key+'" value="'+key+'" '+v.checked+' style="transform: scale(1.5);margin-left: 10px;"> <label for="id'+v.key+'"> </label> </td>'

          });
          html = $('#student_fee-tr').html(html);
        }
      });
    });

  </script>



  @endsection


