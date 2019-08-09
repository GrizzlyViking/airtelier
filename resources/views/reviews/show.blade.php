@extends('layouts.app')

@section('content')
    <div class="container">
        <review-component :value="{{ $review }}" action="show"></review-component>
    </div>
@endsection
