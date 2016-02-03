<div class="row">
	<div class="col-md-8">
		<h3 class="page-title">Groups</h3>
	</div>
	<div class="col-md-4">
		<button type="button" class="btn green add-div pull-right" div-id="areas"  modal-title="Add Group" action="{{'admin/manage/groups/add'}}"> <i class="fa fa-plus"></i> Add New Group</button>
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
				<th>Group Name</th>
				<th>#</th>
			</tr>
		</thead>
		<tbody id="areas">
			<?php $count = 1; ?>
			@foreach($groups as $data)
				@include('admin.manage.groups.view')
				<?php $count++ ?>
			@endforeach
		</tbody>
	</table>
</div>