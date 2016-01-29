@if(isset($city))
{{Form::open(array("url"=>'admin/manage/cities/update/'.$city->id,"method"=>'PUT',"class"=>"ajax_edit_pop"))}}
@else
{{Form::open(array("url"=>'admin/manage/cities/insert',"method"=>'post',"class"=>"ajax_add_pop"))}}
@endif
	<div class="form-body">
		<!--- my form start -->
			<div class="row">
				<div class="col-md-6">
					{{Form::label('City Name')}}
					{{Form::text('city',(isset($city))?$city->city_name:'',["class"=>"form-control","placeholder"=>"city Name","required"=>"true"])}}
					<span class="error">{{$errors->first('city')}}</span>
				</div>
			</div>
			
		<!---my form end-->
	</div>
	<div class="form-actions" style="margin-top:40px;">
		<button type="submit" class="btn blue">{{(isset($city))?'Update':'Add'}}</button>
	</div>
{{Form::close()}}