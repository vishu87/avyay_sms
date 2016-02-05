<div class="row">
	<div class="col-md-8">
		<h3 class="page-title">Student List</h3>
	</div>
	<div class="col-md-4">
		<button type="button" class="btn green pull-right"> <i class="fa fa-plus"></i>Export</button>
	</div>
</div>
@if(Session::has('success'))
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		{{Session::get('success')}}
	</div>
@endif
<div style="overflow-y:auto">
	<table class="table table-bordered table-hover tablesorter">
		<thead>
			<tr>
				<th style="width:50px">SN</th>
				<th>Name</th>
				<th>Age</th>
				<th>City</th>
				<th>Center</th>
				<th>Group</th>
				<th>School Name</th>
				<th>Father Name</th>
				<th>End Date</th>
				<th>#</th>
			</tr>
		</thead>
		<tbody id="areas">
			<?php $count = 1; ?>
			@foreach($students as $data)
				<tr id="center_{{$data->id}}">
					<td>{{$count}}</td>
					<td>{{$data->name}}</td>
					<td>{{floor(abs(strtotime("now")-strtotime($data->dob))/(365*60*60*24))}}</td>
					<td>{{$data->city_name}}</td>
					<td>{{$data->center_name}}</td>
					<td>{{$data->group_name}}</td>
					<td>{{$data->school}}</td>
					<td>{{$data->father}}</td>
					<td>{{$data->doe}}</td>
					<td>
						<button type="button" class="btn yellow edit-div" div-id="city_{{$data->id}}"  modal-title="{{$data->center_name}}" action="{{'admin/manage/centers/editCenter/'.$data->id}}" count = "{{$count}}"> <i class="fa fa-edit"></i> Edit</button>

						<button type="button" class="btn red delete-div" div-id="city_{{$data->id}}"  action="{{'admin/manage/centers/deleteCenter/'.$data->id}}"> <i class="fa fa-remove"></i> Delete</button>
					</td>
				</tr>
				<?php $count++ ?>
			@endforeach
		</tbody>
	</table>
</div>