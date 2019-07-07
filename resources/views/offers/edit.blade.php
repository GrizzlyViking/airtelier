@extends('layouts.app')

@section('content')
    <skill :offer="{{ $offer }}" :edit="1"></skill>
@endsection
