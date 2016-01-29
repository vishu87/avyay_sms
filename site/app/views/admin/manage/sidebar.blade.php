<div class="page-sidebar navbar-collapse collapse">
  <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
    <li class="sidebar-toggler-wrapper">
        <div class="sidebar-toggler">
      </div>
    </li>
    <li style="height:10px">

    </li>
    <li <?php if($page_id == 1): ?> class="active" <?php endif; ?> >
      <a href="{{url('admin/manage/cities')}}">
         <i class="fa fa-plus"></i>
         <span class="title">Cities</span>
      </a>
    </li>
    <li <?php if($page_id == 2): ?> class="active" <?php endif; ?> >
      <a href="{{url('admin/manage/centers')}}">
         <i class="fa fa-plus"></i>
         <span class="title">Centers</span>
      </a>
    </li>
    <li <?php if($page_id == 3): ?> class="active" <?php endif; ?> >
      <a href="{{url('admin/manage/groups')}}">
         <i class="fa fa-plus"></i>
         <span class="title">Groups</span>
      </a>
    </li>
    <li <?php if($page_id == 4): ?> class="active" <?php endif; ?> >
      <a href="{{url('admin/manage/members')}}">
         <i class="fa fa-plus"></i>
         <span class="title">Members</span>
      </a>
    </li>
    


  </ul>
</div>