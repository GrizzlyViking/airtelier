@extends('layouts.app')

@section('content')
    <table-component :sortable="{{json_encode($headers)}}" :content="{{$users->columns($headers)}}" />
@endsection
