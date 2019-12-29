@extends('frontend.layout.standard')

@section('content')
		<div class="card-columns p-4">
			@foreach($resources as $resource)
				<frontend-event :event="{{ $resource }}" :compact="true"></frontend-event>
			@endforeach
		</div>
@endsection
