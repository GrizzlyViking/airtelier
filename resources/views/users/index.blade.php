@extends('layouts.app')

@section('content')
    <table-component :sortable="{{json_encode(['owner', 'name'])}}" :content="{{$users->map(function(\App\Models\User $row): array {
        return [
            'owner' => $row->owner->name,
            'name' => $row->name,
            'description' => $row->description,
            'address' => $row->address,
        ];
    })}}" />
@endsection
