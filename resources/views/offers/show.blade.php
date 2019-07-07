@extends('layouts.app')

@section('content')
    <div class="container">
        <skill :offer="{{ $offer }}"></skill>
    </div>
@endsection
