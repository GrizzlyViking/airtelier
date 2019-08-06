@extends('layouts.app')

@section('content')
    <table-component v-on:click-row="redirectFromClick" :sortable="{{json_encode(['owner', 'type', 'name'])}}" :content="{{$articles->toJson()}}" />
@endsection
