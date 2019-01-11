<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ url('assets/dist/img/user1-128x128.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->username }}</p>
        <a href="#">
          {{-- <i class="fa fa-circle text-success"></i>  --}}
          Login as {{ Auth::user()->kategori }}
        </a>
      </div>
    </div>

    <!-- search form -->
        {{-- <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form> --}}
        <!-- /.search form -->


        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          {{-- <li class="header">MAIN NAVIGATION</li> --}}















          @if (Auth::user()->kategori=='Admin')
          {{-- UNTUK ADMIN --}}
          <li>
            <a href="{{ url('home') }}">
              <i class="menu-icon fa fa-vcard"></i>
              <span>Home</span>
            </a>
          </li>

          <li class="treeview ">
            <a href="#">
              <i class="fa fa-users"></i> 
              <span>Users</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="{{ url('users/dosen') }}">
                  <i class="fa fa-user"></i> <span>Dosen</span>
                </a>
              </li>

              <li>
                <a href="{{ url('users/reviewer') }}">
                  <i class="fa fa-user-secret"></i> <span>Reviewer</span>
                </a>
              </li>

              <li>
                <a href="{{ url('users/admin') }}">
                  <i class="fa  fa-user-secret"></i> <span>Admin</span>
                </a>
              </li>
            </ul>
          </li>

          <li>
            <a href="{{ url('jurnal') }}">
              <i class="fa  fa-file-text"></i> <span>Jurnal</span>
            </a>
          </li>

          <li>
            <a href="{{ url('trashed') }}">
              <i class="fa fa-trash"></i> <span>Trashed</span>
            </a>
          </li>















          
          @elseif (Auth::user()->kategori=='Dosen')
          {{-- UNTUK DOSEN --}}
          <li>
            <a href="{{ url('home') }}">
              <i class="menu-icon fa fa-vcard"></i>
              <span>Home</span>
            </a>
          </li>

          <li>
            <a href="{{ route('jurnalPerDosen.index')}}">
              <i class="fa  fa-file-text"></i> <span>My Jurnal</span>
            </a>
          </li>

          <li>
            <a href="{{ route('rrequest.index') }}">
              <i class="fa fa-send"></i> <span>Request Review</span>
            </a>
          </li>

          {{-- <li>
            <a href="#">
              <i class="fa  fa-file-text"></i> <span>Desain Quisioner</span>
            </a>
          </li> --}}

          <li>
            <a href="{{ url('trashed') }}">
              <i class="fa fa-trash"></i> <span>Trashed</span>
            </a>
          </li>
          @endif
          


          

          {{-- <li>
            <a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a>
          </li> --}}

        {{-- <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> --}}
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>