<tr id="center_{{$data->id}}">
	<td>{{$count}}</td>
	<td>{{$data->center_name}}</td>
	<td>
		<button type="button" class="btn yellow edit-div" div-id="city_{{$data->id}}"  modal-title="{{$data->center_name}}" action="{{'admin/manage/centers/editCenter/'.$data->id}}" count = "{{$count}}"> <i class="fa fa-edit"></i> Edit</button>

		<button type="button" class="btn red delete-div" div-id="city_{{$data->id}}"  action="{{'admin/manage/centers/deleteCenter/'.$data->id}}"> <i class="fa fa-remove"></i> Delete</button>
	</td>
</tr>