@extends('layouts.app')

@section('content')
    <div class="container">
        <event-component :value="{{ $event }}" action="show"></event-component>
    </div>
@endsection
