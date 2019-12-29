@extends('frontend.layout.standard')

@section('content')
    <frontend-resource :resource="{{ $resource }}" :compact="false"></frontend-resource>
@endsection
