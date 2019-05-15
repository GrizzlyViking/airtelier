@extends('layouts.app')

@section('content')
    <table-component :sortable="{{json_encode(['owner', 'name'])}}" :content="{{$locations}}" />
@endsection
