@if(Session::has('success'))
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		{{Session::get('success')}}
	</div>
@endif
@if(Session::has('failure'))
    	<div class="alert alert-danger">
        	<button type="button" class="close" data-dismiss="alert">×</button>
        	<i class="fa fa-ban-circle"></i><strong>Failure!</strong> {{Session::get('failure')}}
       	</div>
@endif
<div class="row">
	<div class="col-md-12">
		<!--- student form start -->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>
					Your Profile
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					{{Form::open(array("url"=>$url,"method"=>'post',"class"=>'form-group'))}}
					<!--- my form start -->
					<div class="row">
						<div class="col-md-6">
							{{Form::label('name')}}
						{{Form::text('name',(isset($user_data->father_name))?$user_data->father_name:$user_data->name,["class"=>"form-control"])}}
						</div>
						<div class="col-md-6">
							{{Form::label('email')}}
						{{Form::text('email',$user_data->email,["class"=>"form-control"])}}
						</div>
						
					</div>
					<div class="clearx"></div>
					<div class="row">
						<div class="col-md-6">
							{{Form::label('Username')}}
						{{Form::text('username',Auth::User()->username,["class"=>"form-control"])}}
						</div>
						<div class="col-md-6">
							{{Form::label('DOB')}}
						{{Form::text('dob',$user_data->dob,["class"=>"form-control datepicker"])}}
						</div>
						
					</div>
					<div class="clearx"></div>
					<div class="row">
						<div class="col-md-6">
							{{Form::label('Contact Number')}}
						{{Form::text('contact',$user_data->contact,["class"=>"form-control"])}}
						</div>
						<div class="col-md-6">
							{{Form::label('Address')}}
						{{Form::text('address',$user_data->address,["class"=>"form-control"])}}
						</div>
						
					</div>
					<div class="clearx"></div>
					<div class="row">
						<div class="col-md-6">
							{{Form::label('State')}}
							{{Form::select('state',$states,(isset($user_data))?$user_data->state_id:'',["class"=>"form-control","placeholder"=>"State","id"=>"stateid","required"=>"true"])}}
							<span class="error">{{$errors->first('state')}}</span>
						</div>
						<div class="col-md-6">
							{{Form::label('City')}}
							{{Form::select('city',(isset($cities))?$cities:[],(isset($user_data))?$user_data->city_id:'',["class"=>"form-control","placeholder"=>"City","id"=>"cityid","required"=>"true"])}}
							<span class="error">{{$errors->first('city')}}</span>
						</div>
						
					</div>
						
					<!---my form end-->
				</div>
				
				<div class="form-actions">
					<button type="submit" class="btn blue">Update</button>
					
				</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
</div>
@if(Session::has('failure1'))
    	<div class="alert alert-danger">
        	<button type="button" class="close" data-dismiss="alert">×</button>
        	<i class="fa fa-ban-circle"></i><strong>Failure!</strong> {{Session::get('failure1')}}
       	</div>
@endif
<div class="row">
	<div class="col-md-12">
		<!--- student form start -->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>
						Change Login Password
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					{{Form::open(array("url"=>$pwd,"method"=>'post',"class"=>'form-group'))}}
					<!--- my form start -->
					<div class="row">
						<div class="col-md-6">
							{{Form::label('Old Password')}}<span class="error">*</span>
							{{Form::text('oldpwd','',["class"=>"form-control"])}}
							<span class="error"><?php echo $errors->first('oldpwd'); ?></span>
						</div>						
					</div>
					<div class="clearx"></div>
					<div class="row">
						<div class="col-md-6">
							{{Form::label('New Password')}}<span class="error">*</span>
							{{Form::password('newpwd',["class"=>"form-control"])}}
							<span class="error"><?php echo $errors->first('newpwd'); ?></span>
						</div>						
						<div class="col-md-6">
							{{Form::label('Confirm New Password')}}<span class="error">*</span>
							{{Form::password('conpwd',["class"=>"form-control"])}}
							<span class="error"><?php echo $errors->first('conpwd'); ?></span>

						</div>
			
					</div>						
					<!---my form end-->
				</div>
				
				<div class="form-actions">
					<button type="submit" class="btn blue">Update</button>
					
				</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
</div>