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
				<th>Center Name</th>
				<th>#</th>
			</tr>
		</thead>
		<tbody id="areas">
			<?php $count = 1; ?>
			@foreach($centers as $data)
				@include('admin.manage.students.view')
				<?php $count++ ?>
			@endforeach
		</tbody>
	</table>
</div>