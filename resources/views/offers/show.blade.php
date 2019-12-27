@extends('layouts.app')

@section('content')
    <div class="container">
        <resource :initial="{{ $resource }}" action="show"></resource>
    </div>
@endsection
