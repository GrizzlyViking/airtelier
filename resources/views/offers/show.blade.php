@extends('layouts.app')

@section('content')
    <div class="container">
        <offer :initial="{{ $offer }}" action="show"></offer>
    </div>
@endsection
