<!DOCTYPE html>
<html lang="en">
	
	<head>
	
		<meta charset="UTF-8">
		<title>@yield('title')</title>
	
	</head>

	<body>
		<div id="header">
			<h1>BLOGQUE</h1>
		</div>

		<div id="body">

			@foreach($posts as $post)
			<div class="box-body">
				<div class="mini-box">
					@if ($post->image_url)
						<a href="#">
							<img src="{{ $post->image_url }}" alt="none">
						</a>
					@endif
					<h1>{{ $post->title }}</h1>
					<p>{{ $post->excerpt }} </p>
				</div>
			</div>
			@endforeach


		</div>

		<div id="sidebar">
			bootstrappp
		</div>

		<div id="footer">
			<div class="box-footer">
				this is footer
			</div>
		</div>
	</body>

</html>