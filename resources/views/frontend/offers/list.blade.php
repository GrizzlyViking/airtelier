@extends('frontend.layout.standard')

@section('content')
		<div class="card-columns p-4">
			@foreach($offers as $offer)
				<frontend-event :event="{{ $offer }}" :compact="true"></frontend-event>
			@endforeach
		</div>
@endsection
