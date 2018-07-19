	@if(session('warning'))
	<!-- 	<div class="alert alert-info">
			{{ session('message') }}
		</div> -->
		@section('script')
			toastr.warning( "{{ session('warning') }}" )
		@endsection
	@elseif(session('success'))
		@section('script')
			toastr.success( "{{ session('success') }}" )
		@endsection
	@elseif(session('error'))
		@section('script')
			toastr.error( "{{ session('error') }}" )
		@endsection

	@elseif(session('trash-message'))
		@section('script')
			toastr.warning('Your post has been deleted', 'Alert!')
		@endsection
				<?php list($message, $postId) = session('trash-message') ?>
		{!! Form::open(['method' => 'PUT', 'route' => ['backend.blog.restore', $postId]]) !!}
					<button type="submit" class="btn btn-sm btn-warning">Undo Delete?</button>
		<!-- 	<div class="alert alert-info">
				{{ $message }}
			</div> -->
		{!! Form::close() !!}
	@endif