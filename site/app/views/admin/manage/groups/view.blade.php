<tr id="group_{{$data->id}}">
	<td>{{$count}}</td>
	<td>{{$data->group_name}}</td>
	<td>{{$data->center_name}}</td>
	<td>{{$data->city_name}}</td>
	<td>
		<button type="button" class="btn yellow edit-div" div-id="group_{{$data->id}}"  modal-title="{{$data->center_name}}" action="{{'admin/manage/groups/editGroup/'.$data->id}}" count = "{{$count}}"> <i class="fa fa-edit"></i> Edit</button>

		<button type="button" class="btn red delete-div" div-id="group_{{$data->id}}"  action="{{'admin/manage/groups/deleteGroup/'.$data->id}}"> <i class="fa fa-remove"></i> Delete</button>
	</td>
</tr>