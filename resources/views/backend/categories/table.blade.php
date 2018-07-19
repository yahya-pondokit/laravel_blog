<table id="table-category" class="table table-bordered">
	<thead>
		<tr>
			<th width="80">Action</th>
			<th>Category Name</th>
			<th width="120">Post Count</th>
		</tr>
	</thead>


<!--    		<tbody>
		@foreach($categories as $category)
			<tr>
				<td>
      {!! Form::open(['method' => 'DELETE', 'route' => ['backend.categories.destroy', $category->id]]) !!}
    					<a href="{{ route('backend.categories.edit', $category->id) }}" class="btn btn-xs btn-default">
    						<i class="fa fa-edit"></i>
    					</a>
    					@if($category->id == config('cms.default_category_id'))
    					<button onclick="return false" type="submit" class="btn btn-xs btn-danger disabled">
    						<i class="fa fa-times"></i>
    					</button>
    					@else
    					<button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-xs btn-danger">
    						<i class="fa fa-times"></i>
    					</button>
    					@endif
      {!! Form::close() !!}
				</td>
				<td>{{ $category->title }}</td>
				<td>{{ $category->posts->count() }}</td>
			</tr>
		@endforeach
	</tbody> -->
</table>
@section('script')
	$('ul.pagination').addClass('no-margin pagination-sm');

	$(function() {
        $('#table-category').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('data.category') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'post-count', name: 'post-count'},
            ],
        });
    });
@endsection