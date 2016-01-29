<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	{{HTML::style("http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all")}}
	{{HTML::style("assets/global/plugins/font-awesome/css/font-awesome.min.css")}}
	{{HTML::style("assets/global/plugins/simple-line-icons/simple-line-icons.min.css")}}
	{{HTML::style("assets/global/plugins/bootstrap/css/bootstrap.min.css")}}
	{{HTML::style("assets/global/plugins/uniform/css/uniform.default.css")}}
	{{HTML::style("assets/global/plugins/bootstrap-datepicker/css/datepicker3.css")}}
	{{HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")}}
	{{HTML::style("frontend/assets/css/bootstrap.min.css")}}
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN THEME STYLES -->
	{{HTML::style("assets/global/css/components.css")}}
	{{HTML::style("assets/admin/css/layout.css")}}
	{{HTML::style("assets/admin/css/themes/darkblue.css")}}
	{{HTML::style("assets/admin/css/theme.bootstrap.css")}}
	{{HTML::style("assets/admin/css/custom.css")}}
</head>
<body class="login-page">
	<div class="container-fluid loginpage">
		<div class="container">
			
			<div class="row ">
		      	<div class="loginlogo col-md-5">
		      		<div class="row">
		      			<div class="col-md-12">
		      				<img src="{{url('/logo.jpg')}}">
		      			</div>
		      		</div>
		      		@if(Session::has('fail'))
					    <div class="alert alert-success alert-dismissable">
					      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
					      <span class="error">{{Session::get('fail')}}</span>
					    </div>
					@endif
		            {{Form::open(array("url"=>'/loginUser',"method"=>'post',"class"=>'form-group'))}}
		      		<div class="form-group ">
			          
			          <div class="input-group lefticon">
			          	<span class="input-group-addon"><i class=" fa fa-user"></i></span>

			          {{Form::text('username',"",["class"=>"form-control" ,"placeholder"=>"Username"])}}
			          </div>
			          <span class="error"><?php echo $errors->first('username'); ?></span>
			        </div>
			        <div class="form-group ">
			         
			          <div class="input-group lefticon">
			          	<span class="input-group-addon"><i class=" fa fa-lock"></i></span>

			          {{Form::password('password',["class"=>"form-control","placeholder"=>"Password"])}}
			          </div>
			          <span class="error"><?php echo $errors->first('password'); ?></span>
			        </div>
			        <div class="row form-action">
			        	<div class="col-md-8">
			        		{{Form::checkbox('remember','',["class"=>"form-control remember"])}}
			        		<label style="margin-left:10px;">  Remember me</label>
			        	</div>
			        	<div class="col-md-4">
			        		<button type="submit" class="btn loginbutton">Login <i class="m-icon-swapright m-icon-white"></i></button>
			        	</div>
			        </div>
			        
			        {{Form::close()}}
			        <hr>
					<div class="col-md-12 lostpassword">
			      		<h4><a href="{{url('#')}}">Lost PassWord?</a></h4>
			      	</div>

		      	</div>
		      	
		      	
		    </div>
		    <div class="row">
		    	<div class="copyright col-md-6">
				    Designed &amp; Maintained by <a href="http://www.avyay.co.in" target="_blank">Avyay Technologies</a>
				</div>

		    </div>
		</div>
	</div>
	 
  
</body>