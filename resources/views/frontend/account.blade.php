@extends('frontend.layout.standard')

@section('content')
	<pre>
		@json($user, JSON_PRETTY_PRINT)
	</pre>
@endsection
