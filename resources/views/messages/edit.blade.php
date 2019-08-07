@extends('layouts.app')

@section('content')
    <div class="container">
        <message-component :value="{{ $message }}" action="update"></message-component>
    </div>
@endsection
