@extends('layouts.app')

@section('content')
    <pre>
        {{ json_encode($location, JSON_PRETTY_PRINT) }}
    </pre>
@endsection
