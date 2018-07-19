<table class="table table-bordered" id="table-user">
	<thead>
		<tr>
			<th width="80">Action</th>
			<th>Name</th>
			<th>Email</th>
			<th>Role</th>
		</tr>
	</thead>
	<!-- <tbody>
		<?php $currentUser = auth()->user(); ?>
		@foreach($users as $user)
			<tr>
				<td>
    					<a href="{{ route('backend.users.edit', $user->id) }}" class="btn btn-xs btn-default">
    						<i class="fa fa-edit"></i>
    					</a>
    					@if($user->id == config('cms.default_user_id') || $user->id == $currentUser->id )
    					<button onclick="return false" type="submit" class="btn btn-xs btn-danger disabled">
    						<i class="fa fa-times"></i>
    					</button>
    					@else
    					<a href="{{ route('backend.users.confirm', $user->id) }}" class="btn btn-xs btn-danger">
    						<i class="fa fa-times"></i>
    					</a>
    					@endif
				</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->roles->first()->display_name }}</td>
			</tr>
		@endforeach
	</tbody> -->
	</table>

@section('script')
	$('ul.pagination').addClass('no-margin pagination-sm');

	$(function() {
        $('#table-user').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('data.user') !!}',
            columns: [
                {data: 'action', name: 'action'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'role', name: 'role'},
            ],
        });
    });
@endsection