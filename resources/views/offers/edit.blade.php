@extends('layouts.app')

@section('content')
    <resource :initial="{{ $resource }}" action="update"></resource>
@endsection
