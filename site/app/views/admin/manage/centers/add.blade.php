@if(isset($center))
{{Form::open(array("url"=>'admin/manage/centers/update/'.$center->id,"method"=>'PUT',"class"=>"ajax_edit_pop"))}}
@else
{{Form::open(array("url"=>'admin/manage/centers/insert',"method"=>'post',"class"=>"ajax_add_pop"))}}
@endif
	<div class="form-body">
		<!--- my form start -->
			<div class="row">
				<div class="col-md-6">
					{{Form::label('Center Name')}}
					{{Form::text('center',(isset($center))?$center->center_name:'',["class"=>"form-control","placeholder"=>"Center Name","required"=>"true"])}}
					<span class="error">{{$errors->first('center')}}</span>
				</div>
				<div class="col-md-6">
					{{Form::label('City')}}
					{{Form::select('city_id',$cities,(isset($center))?$center->city_id:'',["class"=>"form-control","id"=>"CityId"])}}
					<span class="error">{{$errors->first('city_id')}}</span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 cheque-paid">
					{{Form::label('Cheque to be paid to')}}
					{{Form::text('cheque',(isset($center))?$center->paid_to:'',["class"=>"form-control","required"=>"true"])}}
					<span class="error">{{$errors->first('cheque')}}</span>
				</div>
			</div>
		<!---my form end-->
	</div>
	<div class="form-actions" style="margin-top:40px;">
		<button type="submit" class="btn blue">{{(isset($center))?'Update':'Add'}}</button>
	</div>
{{Form::close()}}