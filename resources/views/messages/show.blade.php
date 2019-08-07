@extends('layouts.app')

@section('content')
    <div class="container">
        <message-component :value="{{ $message }}" action="show"></message-component>
    </div>
@endsection
