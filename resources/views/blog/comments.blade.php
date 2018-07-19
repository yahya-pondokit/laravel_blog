<article class="post-comment" id="post-comments">
	<h3><i class="fa fa-comments"></i> {{ $post->commentsNumber('Comment') }}</h3>

	<div class="comment-body padding-10">
		<ul class="comment-list">
			@foreach($postComments as $comment)
				<li class="comment-item">
					<div class="comment-heading clearfix">
						<div class="comment-author-meta">
							<h4><em>{{ $comment->author_name }}</em> - <small>{{ $comment->date }}</small></h4>
						</div>
					</div>
					<div class="comment-content">
						{!! $comment->body_html !!}
					</div>
				</li>
			@endforeach
		</ul>
		<nav>
			{!! $postComments->links() !!}
		</nav>
		<div class="comment-section">
			<h3>Comment below</h3>

			@if (session('message'))
				<div class="alert alert-info">
					{{ session('message') }}
				</div>
			@endif

			{!! Form::open(['route' => 'blog.comments']) !!}
				<div class="form-group required {{ $errors->has('author_name') ? 'has-error' : '' }}">
					<label for="author_name">Name</label>
					{!! Form::text('author_name', null, ['class' => 'form-control']) !!}
        			@if($errors->has('author_name'))
        				<span class="help-block">{{ $errors->first('author_name') }}</span>
        			@endif
				</div>
				<div class="form-group required {{ $errors->has('author_email') ? 'has-error' : '' }}">
					<label for="author_email">Email</label>
					{!! Form::text('author_email', null, ['class' => 'form-control']) !!}
        			@if($errors->has('author_email'))
        				<span class="help-block">{{ $errors->first('author_email') }}</span>
        			@endif
				</div>
				<div class="form-group">
					<label for="author_url">Website</label>
					{!! Form::text('author_url', null, ['class' => 'form-control']) !!}
        			@if($errors->has('author_url'))
        				<span class="help-block">{{ $errors->first('author_url') }}</span>
        			@endif
				</div>
				<div class="form-group required {{ $errors->has('body') ? 'has-error' : '' }}">
					<label for="body">Comment</label>
					{!! Form::textarea('body', null, ['row' => 6, 'class' => 'form-control']) !!}
        			@if($errors->has('body'))
        				<span class="help-block">{{ $errors->first('body') }}</span>
        			@endif
				</div>
				<button type="submit" class="btn btn-primary">Submit?</button>
				{{ Form::hidden('post_id', $post->id) }}
			{!! Form::close() !!}
		</div>
	</div>
</article>