    <div class="page-sidebar navbar-collapse collapse">
      <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <li class="sidebar-toggler-wrapper">
            <div class="sidebar-toggler">
          </div>
        </li>
        <li style="height:10px">

        </li>
        <li class=" open <?php if($page_id == 1): ?> <?php echo "active";?> <?php endif; ?> ">
          
          <a href="javascript:;">
          <i class="icon-basket"></i>
          <span class="title">Schools</span>
          <span class="arrow  open"></span>
          </a>
          <ul class="sub-menu" style="display: block;">
            <li <?php if($sub_id ==1 && $page_id==1): ?> class="active" <?php endif; ?> >
              <a href="{{url('/admin/schools')}}">
              <i class="icon-home"></i>
              All Schools</a>
            </li>
          </ul>
        </li>
        <li <?php if($page_id == 2): ?> class="active" <?php endif; ?> >
          <a href="{{url('admin/messages')}}">
             <i class="fa fa-envelope"></i>
             <span class="title">Messages</span>
          </a>
        </li>
        <li <?php if($page_id == 3): ?> class="active" <?php endif; ?> >
          <a href="{{url('admin/stats')}}">
             <i class="fa fa-bar-chart"></i>
             <span class="title">Stats</span>
          </a>
        </li>
        <li <?php if($page_id == 4): ?> class="active" <?php endif; ?> >
          <a href="{{url('admin/profile')}}">
             <i class="fa fa-user"></i>
             <span class="title">Profile</span>
          </a>
        </li>
        <li <?php if($page_id == 5): ?> class="active" <?php endif; ?> >
          <a href="{{url('logout')}}">
             <i class="fa fa-external-link"></i>
             <span class="title">Logout</span>
          </a>
        </li>
             
      </ul>
    </div>