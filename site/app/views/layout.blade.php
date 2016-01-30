<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>BFC Admin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
{{HTML::style("http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all")}}
{{HTML::style("assets/global/plugins/font-awesome/css/font-awesome.min.css")}}
{{HTML::style("assets/global/plugins/simple-line-icons/simple-line-icons.min.css")}}
{{HTML::style("assets/global/plugins/bootstrap/css/bootstrap.min.css")}}
{{HTML::style("assets/global/plugins/uniform/css/uniform.default.css")}}
{{HTML::style("assets/global/plugins/bootstrap-datepicker/css/datepicker3.css")}}
{{HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")}}
<!-- {{HTML::style("assets/global/plugins/timepicker/stylesheet/wickedpicker.css")}}
{{HTML::style("assets/global/plugins/timepicker/dist/wickedpicker.min.css")}} -->
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
{{HTML::style("assets/global/css/components.css")}}
{{HTML::style("assets/admin/css/layout.css")}}
{{HTML::style("assets/admin/css/themes/light.css")}}
{{HTML::style("assets/admin/css/theme.bootstrap.css")}}

{{HTML::style("assets/admin/css/custom.css")}}
{{HTML::style("assets/admin/css/clockface.css")}}
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>

</head>
<!-- END HEAD -->

<body class="page-header-fixed page-quick-sidebar-over-content ">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
  <!-- BEGIN HEADER INNER -->
  <div class="page-header-inner">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
      <!-- {{HTML::image("assets/admin/img/logo.png","Logo",["class"=>"logo-default","style"=>"width:100px"])}} -->
      <span class="hidden-xs"><strong>BFC Admin</strong></span>
      <div class="menu-toggler sidebar-toggler hide">
        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
      </div>
    </div>
    <div class="top-menu1">
      <div class="hor-menu hor-menu-light hidden-sm hidden-xs">
        <ul class="nav navbar-nav">
          <li class="classic-menu-dropdown <?php if($tab_id == 1): ?> active <?php endif; ?> "><a href="{{url('admin/student')}}">Students</a></li>
          <li class="classic-menu-dropdown <?php if($tab_id == 2): ?> active <?php endif; ?> "><a href="{{url('')}}">Payments</a></li>
          <li class="classic-menu-dropdown <?php if($tab_id == 3): ?> active <?php endif; ?> "><a href="{{url('admin/manage')}}">Manage</a></li>
          <li class="classic-menu-dropdown <?php if($tab_id == 4): ?> active <?php endif; ?> "><a href="{{url('')}}">Student's Attendance</a></li>
          <li class="classic-menu-dropdown <?php if($tab_id == 5): ?> active <?php endif; ?> "><a href="{{url('')}}">Coaches Attendance</a></li>
          <li class="classic-menu-dropdown <?php if($tab_id == 6): ?> active <?php endif; ?> "><a href="{{url('')}}">Adjustments</a></li>
        </ul>
      </div>
    </div>
      
      
    
    
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
    </a>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN TOP NAVIGATION MENU -->
    <div class="top-menu">
      <ul class="nav navbar-nav pull-right">
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li class="dropdown dropdown-user">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
          <span class="username username-hide-on-mobile">
           
          </a>
        </li>
        <!-- END USER LOGIN DROPDOWN -->
      </ul>
    </div>
    <!-- END TOP NAVIGATION MENU -->
  </div>
  <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
  <!-- BEGIN SIDEBAR -->

  <div class="page-sidebar-wrapper">
    {{$sidebar}}
  </div>
  <!-- END SIDEBAR -->
  <!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
    <div class="page-content">
    <!-- modal -->
      <div class="modal fade bs-modal-lg in" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    <!-- /.modal -->
    {{$main}}
    </div>
  </div>
  <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
  <div class="page-footer-inner">
     2014 &copy; Avyay Technologies.
  </div>
  <div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
  </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script type="text/javascript">
  var base_url = '{{URL::to('/')}}';
</script>
{{HTML::script("assets/global/plugins/jquery.min.js")}}
{{HTML::script("assets/global/plugins/jquery-migrate.min.js")}}
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
{{HTML::script("assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js")}}
{{HTML::script("assets/global/plugins/bootstrap/js/bootstrap.min.js")}}
{{HTML::script("assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js")}}
{{HTML::script("assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js")}}
{{HTML::script("assets/global/plugins/jquery.blockui.min.js")}}
{{HTML::script("assets/global/plugins/jquery.cokie.min.js")}}
{{HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js")}}
{{HTML::script("assets/global/plugins/bootbox/bootbox.min.js")}}
{{HTML::script("assets/global/plugins/bootbox/bootbox.min.js")}}
<!-- 
{{HTML::script("assets/global/plugins/timepicker/src/wickedpicker.js")}}
{{HTML::script("assets/global/plugins/timepicker/dist/wickedpicker.min.js")}} -->
<!-- END CORE PLUGINS -->
{{HTML::script("assets/global/scripts/metronic.js")}}
{{HTML::script("assets/admin/scripts/layout.js")}}
{{HTML::script("assets/admin/scripts/quick-sidebar.js")}}

{{HTML::script("assets/admin/scripts/jquery.tablesorter.js")}}
{{HTML::script("assets/admin/scripts/jquery.tablesorter.pager.js")}}
{{HTML::script("assets/admin/scripts/jquery.tablesorter.widgets.js")}}
{{HTML::script("assets/admin/scripts/jquery.validate.js")}}
{{HTML::script("assets/admin/scripts/custom.js")}}
{{HTML::script("assets/admin/scripts/clockface.js")}}
<script>
jQuery(document).ready(function() {   
   // initiate layout and plugins
  Metronic.init(); // init metronic core components
  Layout.init(); // init current layout
  QuickSidebar.init(); // init quick sidebar
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>