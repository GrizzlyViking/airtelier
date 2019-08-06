@extends('layouts.app')

@section('content')
    <div class="container">
        <article-component :value="{{ $article }}" action="update"></article-component>
    </div>
@endsection
