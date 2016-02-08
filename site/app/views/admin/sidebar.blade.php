    <div class="page-sidebar navbar-collapse collapse">
      <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <li class="sidebar-toggler-wrapper">
            <div class="sidebar-toggler">
          </div>
        </li>
        <li style="height:10px">

        </li>
        <li <?php if($page_id == 1): ?> class="active" <?php endif; ?> >
          <a href="{{url('admin/student')}}">
             <i class="fa fa-plus"></i>
             <span class="title">Add New Student</span>
          </a>
        </li>
        <li <?php if($page_id==2): ?>class="active open "<?php endif;?>>
          <a href="javascript:;">
          <i class="fa fa-adjust"></i>
          <span class="title">Browse Students</span>
          <span class="arrow @if($page_id == 2 ) open @endif"></span>
          </a>
          <ul class="sub-menu">
            <li class="@if($page_id == 2 && $sub_id == 1 ) active @endif">
              <a href="{{url('/admin/student/viewAllStudent')}}">
              <i class="fa fa-user"></i>
              View All</a>
            </li>
            @if(isset($customSidebar))
              <?php $old_center_id = 0; $old_city_id=0; $count = 0; $count_center =0; $count_group = 0;?>
                @foreach($customSidebar as $group)

                  @if($old_city_id != $group->city_id)
                    @if($count != 0) </ul></li> <?php $count_center = 0 ?> @endif
                    <li <?php if($page_id==2): ?>class=" open  "<?php endif;?>>
                        <a href="javascript:;">
                          <i class="fa fa-group"></i>
                          {{$group->city_name}}
                        </a>
                      <ul class="sub-menu">
                  @endif
                   @if($old_center_id != $group->center_id)
                    @if($count_group != 0) </ul></li> <?php $count_group = 0 ?> @endif
                      <li <?php if($page_id==2): ?>class=" open "<?php endif;?>>
                        <a href="javascript:;">
                          <i class="fa fa-group"></i>
                          {{$group->center_name}}
                        </a>
                        <ul class="sub-menu">
                    @endif
                           <li <?php if($page_id==2): ?>class=" "<?php endif;?>>
                            <a href="javascript:;" class="">
                              <i class="fa fa-group"></i>
                              {{$group->group_name}}
                            </a>
                          </li>
                 <?php $count++; $old_city_id = $group->city_id; $count_center++;$count_group++; $old_center_id = $group->center_id  ?>
                @endforeach
                        </ul>
                      </li>
                    </ul> <!--center li-->
                </li> <!--city li-->
            @endif
          </ul>
        </li>
        <li <?php if($page_id==3): ?>class="active open "<?php endif;?>>
          <a href="javascript:;">
          <i class="fa fa-adjust"></i>
          <span class="title">Inactive Students</span>
          <span class="arrow @if($page_id == 1 ) open @endif"></span>
          </a>
          <ul class="sub-menu">
            <li class="@if($page_id == 1 && $sub_id == 1 ) active @endif">
              <a href="{{url('/teacher/newMeeting')}}">
              <i class="fa fa-user"></i>
              View All</a>
            </li>
            <li class="@if($page_id == 1 && $sub_id == 2 ) active @endif">
              <a href="{{url('teacher/viewMeetingInvites')}}">
              <i class="fa fa-group"></i>
              Banglore</a>
            </li>
            <li <?php if($sub_id ==3 && $page_id==3): ?> class="active" <?php endif; ?> >
              <a href="{{url('/teacher/allMeetings')}}">
              <i class="icon-home"></i>
              BFC Academy</a>
            </li>
          </ul>
        </li>
        <li <?php if($page_id==3): ?>class="active open "<?php endif;?>>
          <a href="javascript:;">
          <i class="fa fa-adjust"></i>
          <span class="title">Payment Notifications</span>
          <span class="arrow @if($page_id == 1 ) open @endif"></span>
          </a>
          <ul class="sub-menu">
            <li class="@if($page_id == 1 && $sub_id == 1 ) active @endif">
              <a href="{{url('/teacher/newMeeting')}}">
              <i class="fa fa-user"></i>
              View All</a>
            </li>
            <li class="@if($page_id == 1 && $sub_id == 2 ) active @endif">
              <a href="{{url('teacher/viewMeetingInvites')}}">
              <i class="fa fa-group"></i>
              Banglore</a>
            </li>
            <li <?php if($sub_id ==3 && $page_id==3): ?> class="active" <?php endif; ?> >
              <a href="{{url('/teacher/allMeetings')}}">
              <i class="icon-home"></i>
              BFC Academy</a>
            </li>
          </ul>
        </li>


      </ul>
    </div>