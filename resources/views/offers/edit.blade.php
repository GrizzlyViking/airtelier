@extends('layouts.app')

@section('content')
    <skill :offer="{{ $offer }}" :edit="true"></skill>
@endsection
