<tr id="city_{{$data->id}}">
	<td>{{$count}}</td>
	<td>{{$data->city_name}}</td>
	<td>
		<button type="button" class="btn yellow edit-div" div-id="city_{{$data->id}}"  modal-title="{{$data->city_name}}" action="{{'admin/manage/cities/editCity/'.$data->id}}" count = "{{$count}}"> <i class="fa fa-edit"></i> Edit</button>

		<button type="button" class="btn red delete-div" div-id="city_{{$data->id}}"  action="{{'admin/manage/cities/deleteCity/'.$data->id}}"> <i class="fa fa-remove"></i> Delete</button>
	</td>
</tr>