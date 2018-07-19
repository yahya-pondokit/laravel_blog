@if (isset($categoryName))
	<p>Category: <strong>{{ $categoryName }}</strong></p>
@endif

@if (isset($tagName))
	<p>Tagged: <strong>{{ $tagName }}</strong></p>
@endif

@if (isset($authorName))
	<p>Author: <strong>{{ $authorName }}</strong></p>
@endif

@if ($term = request('term'))
	<p>Search Result for: <strong>{{ $term }}</strong></p>
@endif