@php
    $prefix=Request()->route()->getPrefix();
    $name= Route::current()->getname();

@endphp

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
			<div class="ulogo">
				 <a href="{{route('dashboard')}}">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">
						  <img src="{{asset('images/logo-dark.png')}}" alt="">
						  <h3><b>School</b> System</h3>
					 </div>
				</a>
			</div>
        </div>

      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">

		<li class="{{ ($name == "dashboard") ? "active" : ""  }}">
          <a href="{{route('dashboard')}}">
            <i data-feather="pie-chart"></i>
			<span>Dashboard</span>
          </a>
        </li>
        @if (Auth::user()->role=='Admin')

            <li class="treeview {{str_contains($name,'users') ? "active" : ""}}">
              <a href="#">
                <i data-feather="user"></i>
                <span>Manage User</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-right pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{route('users.index')}}"><i class="ti-more"></i>View User</a></li>
                <li><a href="{{route('users.create')}}"><i class="ti-more"></i>Add User</a></li>
              </ul>
            </li>

        @endif
        <li class="treeview {{str_contains($name,'profile') ? "active" : ""}}">
          <a href="#">
            <i data-feather="settings"></i> <span>Manage Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('profile.view')}}"><i class="ti-more"></i>Your Profile</a></li>
            <li><a href="{{route('profile.password.view')}}"><i class="ti-more"></i>Change Password</a></li>

          </ul>
        </li>

        <li class="treeview {{str_contains($prefix,'setup') ? "active" : ""}}">
          <a href="#">
            <i data-feather="list"></i> <span>Setup Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('class.index')}}"><i class="ti-more"></i>Student Class</a></li>
            <li><a href="{{route('year.index')}}"><i class="ti-more"></i>Student Year</a></li>
            <li><a href="{{route('group.index')}}"><i class="ti-more"></i>Student Group</a></li>
            <li><a href="{{route('shift.index')}}"><i class="ti-more"></i>Student Shift</a></li>
            <li><a href="{{route('feecat.index')}}"><i class="ti-more"></i>Fee Category</a></li>
            <li><a href="{{route('feeam.index')}}"><i class="ti-more"></i>Fee Category Amount</a></li>
            <li><a href="{{route('exam.index')}}"><i class="ti-more"></i>Exam Type</a></li>
            <li><a href="{{route('subject.index')}}"><i class="ti-more"></i>Shool Subjects</a></li>
            <li><a href="{{route('assign_sub.index')}}"><i class="ti-more"></i>Assign Subjects </a></li>
            <li><a href="{{route('designation.index')}}"><i class="ti-more"></i>Designation </a></li>
          </ul>
        </li>

        <li class="treeview {{str_contains($prefix,'student') ? "active" : ""}}">
          <a href="#">
            <i data-feather="users"></i> <span>Student Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('reg.index')}}"><i class="ti-more"></i>Student Registration</a></li>
            <li><a href="{{route('roll.index')}}"><i class="ti-more"></i>Roll Generator</a></li>
            <li><a href="{{route('reg_fee.view')}}"><i class="ti-more"></i>Registration Fee</a></li>
            <li><a href="{{route('month_fee.view')}}"><i class="ti-more"></i>Monthly Fee</a></li>
            <li><a href="{{route('exam_fee.view')}}"><i class="ti-more"></i>Exam Fee</a></li>
          </ul>
        </li>

        <li class="treeview {{str_contains($prefix,'employee') ? "active" : ""}}">
          <a href="#">
            <i data-feather="users"></i> <span>Employee Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('em_reg.index')}}"><i class="ti-more"></i>Employee Registration</a></li>
            <li><a href="{{route('salary.index')}}"><i class="ti-more"></i>Employee Salary</a></li>
            <li><a href="{{route('leave.index')}}"><i class="ti-more"></i>Employee Leave</a></li>
            <li><a href="{{route('attendance.index')}}"><i class="ti-more"></i>Employee Attendance</a></li>
            <li><a href="{{route('month_salary.view')}}"><i class="ti-more"></i>Employee Monthly Salary</a></li>
          </ul>
        </li>

         <li class="treeview {{str_contains($prefix,'marks') ? "active" : ""}}">
          <a href="#">
            <i data-feather="users"></i> <span>Marks Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('marks.add')}}"><i class="ti-more"></i>Marks Entry</a></li>
            <li><a href="{{route('marks.edit')}}"><i class="ti-more"></i>Marks Edit</a></li>
            <li><a href="{{route('grade.index')}}"><i class="ti-more"></i>Grade Marks</a></li>
          </ul>
        </li>

        <li class="treeview {{str_contains($prefix,'accounts') ? "active" : ""}}">
            <a href="#">
              <i data-feather="users"></i> <span>Accounts Management</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('student_account.index')}}"><i class="ti-more"></i>Student Fee</a></li>

            </ul>
          </li>



        <li class="header nav-small-cap">User Interface</li>

        <li class="treeview">
          <a href="#">
            <i data-feather="grid"></i>
            <span>Components</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="components_alerts.html"><i class="ti-more"></i>Alerts</a></li>
            <li><a href="components_badges.html"><i class="ti-more"></i>Badge</a></li>
            <li><a href="components_buttons.html"><i class="ti-more"></i>Buttons</a></li>
            <li><a href="components_sliders.html"><i class="ti-more"></i>Sliders</a></li>

          </ul>
        </li>

      </ul>
    </section>

	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
  </aside>
