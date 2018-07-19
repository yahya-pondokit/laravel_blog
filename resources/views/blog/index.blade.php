@extends('layout.main')
@section('title', 'INDEKKUSU')

@section('content')
    <div id="main">
        <div class="main-header container-fluid">
            <div class="row big-title">
                <h2>WEB LOG</h2>
                <p class="text-center">- owo -</p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">

				@if (! $posts->count())
					<p>Nothing Found</p>
				@else
					@include('blog.alert')
					
					@foreach($posts as $post)
                        <div class="article"><!-- article start -->
                            <div class="article-teaser">         	
								@if ($post->image_url)
	                                <a href="{{ route('blog.show', $post->slug) }}">
	                                    <img src="{{ $post->image_url }}" alt="dummy">
	                                </a>
								@endif
                            </div>
                            <div class="article-body text-center">
                                <div class="article-body-inside">
                                    <a href="{{ route('category', $post->category->slug) }}"> {{ $post->category->title }} </a>
                                    <h2 class="article-title"><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h2>
                                    <p><i>Posted on {{ $post->date }} - By <a href="{{ route('author', $post->author->slug) }}">{{ $post->author->name }}</a> - <a href="{{ route('blog.show', $post->slug) }}#post-comments"> {{ $post->commentsNumber() }} </a></i></p>
                                    <p>
								        <i><i class="fa fa-tag"></i>
								        	{!! $post->tags_html !!}
								        </i>
								    </p>
                                    <p>{!! $post->excerpt_html !!}...</p>
                                </div>
                                <div class="continue">
                                    <a href="{{ route('blog.show', $post->slug) }}">CONTINUE READING &raquo;</a>
                                </div>
                            </div>
                        </div><!-- article end -->
					@endforeach

				<div class="text-center">
                    {{ $posts->appends(request()->only(['term', 'month', 'year']))->links() }}
                </div>
				@endif

                </div>
                @include('layout.sidebar')
            </div>
        </div>
    </div>
@endsection
