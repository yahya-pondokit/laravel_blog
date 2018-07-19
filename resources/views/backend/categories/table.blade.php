<table id="table-category" class="table table-bordered">
	<thead>
		<tr>
			<th width="80">Action</th>
			<th>Category Name</th>
			<th width="120">Post Count</th>
		</tr>
	</thead>
</table>
@section('script')
	$('ul.pagination').addClass('no-margin pagination-sm');

	$(function() {
        $('#table-category').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('data.category') !!}',
            columns: [
                {data: 'action', name: 'action'},
                {data: 'title', name: 'title'},
                {data: 'post-count', name: 'post-count'},
            ],
        });
    });
@endsection