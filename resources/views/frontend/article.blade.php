@extends('frontend.layout.standard')

@section('content')
	<div class="container">
		<div class="card shadow-lg mt-3 p-4">
			<div class="card-header">
				<h1 class="font-weight-bold color-blue text-uppercase">{{ $article->title }}</h1>
				<div class="card-subtitle text-muted">
					{{ $article->sub_title }}
				</div>
			</div>
			<div class="card-body p-4">
				<p>{{ $article->resume }}</p>
				<div>
					{!! $article->content !!}
				</div>
			</div>
		</div>

		@if($article->offers->count() > 0)
			<div class="h4 mt-3">Resources:</div>
		@endif
		@foreach($article->offers as $offer)
			<frontend-offer :offer="{{ $offer }}"></frontend-offer>
		@endforeach

		@if($article->events->count() > 0)
			<div class="h4 mt-3">Events:</div>
		@endif

		@foreach($article->events as $event)
			<frontend-event :event="{{ $event }}"></frontend-event>
		@endforeach

		</div>
	</div>
@endsection
