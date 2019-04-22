@extends('layouts.app')

@section('content')
    <pre>
        {{ json_encode($locations, JSON_PRETTY_PRINT) }}
    </pre>
@endsection
