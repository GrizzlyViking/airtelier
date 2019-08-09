@extends('layouts.app')

@section('content')
    <div class="container">
        <review-component :value="{{ $review }}" action="update"></review-component>
    </div>
@endsection
