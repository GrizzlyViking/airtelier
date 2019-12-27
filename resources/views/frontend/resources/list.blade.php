@extends('frontend.layout.standard')

@section('content')
		<frontend-list :items="{{ $items }}"></frontend-list>
@endsection
