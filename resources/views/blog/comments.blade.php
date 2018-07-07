<article class="post-comment" id="post-comments">
	<h3><i class="fa fa-comments"></i> {{ $post->commentsNumber('Comment') }}</h3>

	<div class="comment-body padding-10">
		<ul class="comment-list">
			@foreach($post->comments as $comment)
				<li class="comment-item">
					<div class="comment-heading clearfix">
						<div class="comment-author-meta">
							<h4>{{ $comment->author_name }} - <small>{{ $comment->date }}</small></h4>
						</div>
					</div>
					<div class="comment-content">
						{!! $comment->body_html !!}
					</div>
				</li>
			@endforeach
		</ul>
	</div>
</article>