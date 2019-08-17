@extends('layouts.app')

@section('content')
    <div class="container">
        <event-component v-model="{{ $event }}" action="update"></event-component>
    </div>
@endsection
