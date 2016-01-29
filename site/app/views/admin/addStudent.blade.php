<div class="row">
	<div class="col-md-12">
		<h1>Add New Student</h1>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<!--- student form start -->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					General Information
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<div class="row">
						<div class="col-md-12">
							{{Form::label('City')}}
							{{Form::select('city',$city,'',["class"=>"form-control","id"=>"cityId"])}}
							<span class="error">{{$errors->first('city')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Center')}}
							{{Form::select('center',[],'',["class"=>"form-control","id"=>"centerId"])}}
							<span class="error">{{$errors->first('center')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Group')}}
							{{Form::select('group',[],'',["class"=>"form-control","id"=>"groupId"])}}
							<span class="error">{{$errors->first('group')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Name')}}
							{{Form::text('name','',["class"=>"form-control m-wrap"])}}
							<span class="error">{{$errors->first('name')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('DOB')}}
							{{Form::text('dob','',["class"=>"form-control datepicker"])}}
							<span class="error">{{$errors->first('dob')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Gender')}}
							{{Form::select('gender',[""=>'select',"1"=>'Male',"2"=>'Female'],'',["class"=>"form-control"])}}
							<span class="error">{{$errors->first('gender')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('School Name')}}
							{{Form::text('school_name','',["class"=>"form-control m-wrap"])}}
							<span class="error">{{$errors->first('school_name')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Email')}}
							{{Form::text('email','',["class"=>"form-control m-wrap"])}}
							<span class="error">{{$errors->first('email')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Mobile Number')}}
							{{Form::text('mobile_number','',["class"=>"form-control m-wrap"])}}
							<span class="error">{{$errors->first('mobile_number')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label("Father's Name")}}
							{{Form::text('father_name','',["class"=>"form-control m-wrap"])}}
							<span class="error">{{$errors->first('father_name')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label("Father's Mobile No.")}}
							{{Form::text('father_mobile','',["class"=>"form-control m-wrap"])}}
							<span class="error">{{$errors->first('father_mobile')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label("Father's Email")}}
							{{Form::text('father_email','',["class"=>"form-control m-wrap"])}}
							<span class="error">{{$errors->first('father_email')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label("Mother's Name")}}
							{{Form::text('mother_name','',["class"=>"form-control"])}}
							<span class="error">{{$errors->first('mother_name')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label("Mother's Mobile No.")}}
							{{Form::text('mother_mobile','',["class"=>"form-control m-wrap"])}}
							<span class="error">{{$errors->first('mother_mobile')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label("Mother's Email")}}
							{{Form::text('mother_email','',["class"=>"form-control m-wrap"])}}
							<span class="error">{{$errors->first('mother_email')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Address')}}
							{{Form::text('address','',["class"=>"form-control m-wrap"])}}
							<span class="error">{{$errors->first('address')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('City')}}
							{{Form::text('city2','',["class"=>"form-control m-wrap"])}}
							<span class="error">{{$errors->first('city2')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('State')}}
							{{Form::select('state',[],'',["class"=>"form-control m-wrap"])}}
							<span class="error">{{$errors->first('state')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Upload Picture')}}
							{{Form::file('picture',["class"=>"form-control"])}}
							<span class="error">{{$errors->first('picture')}}</span>
						</div>
					</div>
					
					<!--- my form end -->	
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<!--- student form start -->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Subscription
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<div class="row">
						<div class="col-md-12">
							{{Form::label('Month Plan')}}
							{{Form::select('month_plan',[],'',["class"=>"form-control","id"=>"month_plan"])}}
							<span class="error">{{$errors->first('city')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Registration Fee')}}
							{{Form::text('reg_fee',0,["class"=>"form-control m-wrap","id"=>'reg_fee'])}}
							<span class="error">{{$errors->first('reg_fee')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Subscription Fee')}}
							{{Form::text('sub_fee',0,["class"=>"form-control m-wrap","id"=>'sub-fee'])}}
							<span class="error">{{$errors->first('sub_fee')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Kit Fee')}}
							{{Form::text('kit_fee',0,["class"=>"form-control m-wrap","id"=>'kit-fee'])}}
							<span class="error">{{$errors->first('kit_fee')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Amount')}}
							{{Form::text('amount',0,["class"=>"form-control m-wrap","id"=>'amount'])}}
							<span class="error">{{$errors->first('amount')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Subscription Start')}}
							{{Form::text('subscription_start','',["class"=>"form-control datepicker","id"=>'dos'])}}
							<span class="error">{{$errors->first('subscription_start')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Date of Payment')}}
							{{Form::text('date_payment','',["class"=>"form-control datepicker"])}}
							<span class="error">{{$errors->first('date_payment')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Adjustment')}}
							{{Form::text('adjustment',0,["class"=>"form-control","id"=>'adjust'])}}
							<span class="error">{{$errors->first('adjustment')}}</span>
						</div>
						<div class="col-md-12">
							<button id="calculate" class="btn yellow btn-block broad-btn">Calculate End Date</button>
						</div>
						<div class="col-md-12">
							{{Form::label('Subscription End')}}
							{{Form::text('sub_end','',["class"=>"form-control"])}}
							<span class="error">{{$errors->first('sub_end')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Mode of Payment')}}
							<div class="row">
								<div class="col-md-4">
									{{Form::checkbox('mod_payment',1)}}
									{{Form::label('Cheque')}}
								</div>
								<div class="col-md-4">
									{{Form::checkbox('mod_payment',2)}}
									{{Form::label('Cash')}}
								</div>
								<div class="col-md-4">
									{{Form::checkbox('mod_payment',3)}}
									{{Form::label('NEFT')}}
								</div>
							</div>
							<span class="error">{{$errors->first('mod_payment')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Payment Remark')}}
							{{Form::text('payment_remark','',["class"=>"form-control"])}}
							<span class="error">{{$errors->first('payment_remark')}}</span>
						</div>
						<div class="clearx"></div>
						<div class="col-md-12">
							{{Form::label('Adjustment Remark')}}
							{{Form::text('adjustment_remark','',["class"=>"form-control"])}}
							<span class="error">{{$errors->first('adjustment_remark')}}</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-actions submitCenter">
			<button type="submit" class="btn blue">Submit</button>
			<button class="btn blue">Cancel</button>
		</div>
	</div>
</div>