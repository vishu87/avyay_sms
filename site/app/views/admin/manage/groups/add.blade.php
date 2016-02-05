@if(isset($group))
{{Form::open(array("url"=>'admin/manage/groups/update/'.$group->id,"method"=>'PUT',"class"=>"ajax_edit_pop"))}}
@else
{{Form::open(array("url"=>'admin/manage/groups/insert',"method"=>'post',"class"=>"ajax_add_pop"))}}
@endif
	<div class="form-body">
		<!--- my form start -->
			<div class="row">
				<div class="col-md-6">
					{{Form::label('Group Name')}}
					{{Form::text('group',(isset($group))?$group->group_name:'',["class"=>"form-control","placeholder"=>"Group Name","required"=>"true"])}}
					<span class="error">{{$errors->first('group')}}</span>
				</div>
				<div class="col-md-6">
					{{Form::label('Center')}}
					{{Form::select('center_id',$centers,(isset($group))?$group->center_id:'',["class"=>"form-control","id"=>"CenterId"])}}
					<span class="error">{{$errors->first('center_id')}}</span>
				</div>
			</div>
			
		<!---my form end-->
	</div>
	<div class="form-actions" style="margin-top:40px;">
		<button type="submit" class="btn blue">{{(isset($group))?'Update':'Add'}}</button>
	</div>
{{Form::close()}}