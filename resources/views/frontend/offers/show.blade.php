@extends('frontend.layout.standard')

@section('content')
    <frontend-offer :offer="{{ $offer }}" :compact="false"></frontend-offer>
@endsection
