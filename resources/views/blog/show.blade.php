@extends('layout.main')
@section('title', 'INDEKKUSU')

@section('content')
        <div id="main">
            <div class="container">
                <div class="row more-top-padding">
                    <div class="col-md-8">

						@if (isset($categoryName))
							<p>Category: <strong>{{ $categoryName }}</strong></p>
						@endif
	                        <div class="article"><!-- article start -->
	                            <div class="article-teaser">        
		                            <img src="{{ $post->image_url }}" alt="dummy">
	                            </div>
	                            @php
	                            $author = $post->author;
	                            @endphp
	                            <div class="article-body text-center">
	                                <div class="article-body-inside">
	                                    <a href="{{ route('category', $post->category->slug) }}">{{ $post->category->title }}</a>
	                                    <h2 class="article-title">{{ $post->title }}</h2>
	                                    <p><em>Posted on <a href="#">{{ $post->date }}</a> - By <a href="route('author', $author->slug) }}">{{ $author->name }}</a> - Tags: {!! $post->tags_html !!} - <a href="#post-comments">{{ $post->commentsNumber() }}</a></em></p>
	                                    <p>{!! $post->body_html !!}</p>
	                                </div>
	                            </div>
	                        </div><!-- article end -->

	                  	<div class="author-name clearfix">
	                  		@php
	                  		$postCount = $author->posts
	                  		// ()->published() -diaktifin aja ntar lol
	                  		->count();
	                  		@endphp
	                  		<a class="col-md-3" href="{{ route('author', $author->slug) }}">
	                  			<img alt="{{ $author->name }}" src="{{ $author->gravatar() }}" width="100">
	                  		</a>
	                  		<div class="col-md-9">
		                  		<h2>Author : {{ $author->name }} / {{ $postCount }} {{ str_plural('article', $postCount) }}</h2>
		                  		<p><strong>Bio : </strong>{!! $author->bio_html !!}
	                  		</div>
	                  	</div>

                    @include('blog.comments')
                    </div>
                    @include('layout.sidebar')
                </div>
            </div>
        </div>
@endsection