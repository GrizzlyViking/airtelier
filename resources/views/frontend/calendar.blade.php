@extends('frontend.layout.standard')

@section('content')
	<div class="container mt-5">
	<calendar-component :resource="{{ $resource }}"></calendar-component>
	</div>
@endsection
