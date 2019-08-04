@extends('layouts.app')

@section('content')
    <div class="container">
        <skill :initial="{{ $offer }}" action="show"></skill>
    </div>
@endsection
