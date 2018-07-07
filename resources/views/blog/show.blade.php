@extends('layout.main')
@section('title', 'INDEKKUSU')

@section('content')
        <div id="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">

						@if (isset($categoryName))
							<p>Category: <strong>{{ $categoryName }}</strong></p>
						@endif
	                        <div class="article"><!-- article start -->
	                            <div class="article-teaser">         	
									@if ($post->image_url)
		                                <a href="article.html">
		                                    <img src="{{ $post->image_url }}" alt="dummy">
		                                </a>
									@endif
	                            </div>
	                            @php
	                            $author = $post->author;
	                            @endphp
	                            <div class="article-body text-center">
	                                <div class="article-body-inside">
	                                    <a href="{{ route('category', $post->category->slug) }}">{{ $post->category->title }}</a>
	                                    <h2 class="article-title"><a href="article.html">{{ $post->title }}</a></h2>
	                                    <p><em>Posted on <a href="#">{{ $post->date }}</a> - By <a href="route('author', $author->slug) }}">{{ $author->name }}</a> - Tags: {!! $post->tags_html !!} - (brp komen)</em></p>
	                                    <p>{!! $post->body_html !!}</p>
	                                </div>
	                            </div>
	                        </div><!-- article end -->

	                  	<div class="author-name">
	                  		@php
	                  		$postCount = $author->posts
	                  		// ()->published() -diaktifin aja ntar lol
	                  		->count();
	                  		@endphp
	                  		<a href="{{ route('author', $author->slug) }}">
	                  			<img alt="{{ $author->name }}" src="{{ $author->gravatar() }}" width="100">
	                  		</a>
	                  		<h2>Author : {{ $author->name }} / {{ $postCount }} {{ str_plural('article', $postCount) }}</h2>
	                  		<p><strong>Bio : </strong>{!! $author->bio_html !!}
	                  	</div>

                    </div>
                    @include('layout.sidebar')
                </div>
            </div>
        </div>
@endsection