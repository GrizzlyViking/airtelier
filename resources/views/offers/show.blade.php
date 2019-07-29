@extends('layouts.app')

@section('content')
    <div class="container">
        <skill :offer="{{ $offer }}" action="show"></skill>
    </div>
@endsection
