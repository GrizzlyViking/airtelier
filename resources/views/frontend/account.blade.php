@extends('frontend.layout.standard')

@section('content')
<div class="container mt-3">
		<pre>
			@json($user, JSON_PRETTY_PRINT)
		</pre>

</div>
@endsection
