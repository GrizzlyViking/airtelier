@extends('layouts.app')

@section('content')
    <div class="container">
        <article-component :value="{{ $article }}" action="show"></article-component>
    </div>
@endsection
