@extends('layouts.app')

@section('content')
    <offer :initial="{{ $offer }}" action="update"></offer>
@endsection
