  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <!-- <img src="https://placehold.it/160x160/00abac/ffffff/&text={{ mb_substr(Auth::user()->name, 0, 1) }}" class="img-circle" alt="{{ Auth::user()->name }}"> -->
          <!-- <img src="//www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?d=mm" class="img-circle" alt="{{ Auth::user()->name }}"> -->
          <img class="img-circle" 
              @isset(Auth::user()->profilepic)
              src="{{ asset('uploads/profile/' . Auth::user()->profilepic) }}"
              @endisset
              @empty(Auth::user()->profilepic)
              src="//www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?d=mm"
              @endempty
              alt="{{ Auth::user()->name }} profile ">

        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }} {{ Auth::user()->surname }} </p>
          
          <!-- Status -->
          <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            <small class="text-muted text-center">
                <!-- // Display current user roles -->
                @foreach (Auth::user()->roles as $role)
                {{ $role->display_name }}
                @endforeach
                <!-- @if (Auth::user()->usertype == 6)
                  Refer a Friend
                @elseif (Auth::user()->usertype == 5)
                  Estate Agent
                @elseif (Auth::user()->usertype == 4)
                  User
                @elseif (Auth::user()->usertype == 3)
                  Member
                @elseif (Auth::user()->usertype == 2)
                  Administrator
                @elseif (Auth::user()->usertype == 1)
                  Superadministrator   
                @else
                  No user type :-(
                @endif -->
            </small>
        </div>
      </div>

      <!-- search form (Optional) -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">NAVIGATION</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        
        @role('superadministrator|administrator|member|user|friend|agent')
        
        <!-- <li><a href="#"><i class="fa fa-link"></i> <span>Calendar</span></a></li> -->

        <li class="treeview">
          <a href="#"><i class="fa fa-paper-plane"></i> <span>My Referrals</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('myreferrals.index')}}"><i class="fa fa-users"></i> <span>View Referrals</span></a></li>
            <li><a href="{{route('myreferrals.create')}}"><i class="fa fa-user-plus"></i> <span>New Referral</span></a></li>
          </ul>
        </li>

        @endrole

        @role('superadministrator|administrator|member|user|supplier')
        
        <!-- <li><a href="#"><i class="fa fa-link"></i> <span>Calendar</span></a></li> -->

        <li class="treeview">
          <a href="#"><i class="fa fa-building"></i> <span>My Business</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('mycompany.index')}}"><i class="fa fa-eye"></i> <span>View Business</span></a></li>
            <li><a href="{{route('mycompany.create')}}"><i class="fa fa-plus-square"></i> <span>New Business</span></a></li>
          </ul>
        </li>

        @endrole


        @role('superadministrator|administrator')
        <li class="header">ADMINISTRATOR MENU</li>
        
        <li class="treeview">
          <a href="#"><i class="fa fa-paper-plane"></i> <span>Manage Referrals</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('referrals.index')}}">View Referrals</a></li>
            <li><a href="{{route('referrals.create')}}">Create New Referral</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-building"></i> <span>Manage Business</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('companies.index')}}">View Business</a></li>
            <li><a href="{{route('companies.create')}}">Create New Business</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Manage Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('users.index')}}">View Users</a></li>
            <li><a href="{{route('users.create')}}">Create New User</a></li>
          </ul>
        </li>
        
        <li class="treeview" >
          <a href="#"><i class="fa fa-shield"></i> <span>Roles & Permissions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('permissions.index')}}" class="active">View Permissions</a></li>
            <li><a href="{{route('permissions.create')}}">Create New Permissions</a></li>
            <li><a href="{{route('roles.index')}}">View Roles</a></li>
            <li><a href="{{route('roles.create')}}">Create New Roles (incomplete)</a></li>
            
          </ul>
        </li>
        @endrole
      
      <li class="header">MY ACCOUNT</li>
        <li><a href="{{route('myprofile.index')}}"><i class="fa fa-user"></i> <span>My Profile</span></a></li>


        <!-- Optionally, you can add icons to the links -->
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>