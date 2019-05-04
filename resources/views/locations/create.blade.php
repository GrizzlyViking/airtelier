@extends('layouts.app')

@section('content')
    @if($errors->count() > 0)
        <pre>
            {{ var_export($errors->first()) }}
        </pre>
    @endif
    <div class="container">
        <form action="{{ route('locations.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="owner_id">Owner</label>
                <select-component :options="{{$options}}" input_name="owner_id" label="name" initial-value="{{old('name', 5)}}"></select-component>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" value="{{old('name')}}" id="name" name="name" placeholder="Enter name">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" rows="3" name="description"></textarea>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <textarea name="address" class="form-control" id="address" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="meta">Other (please enter as json)</label>
                <textarea name="meta" class="form-control" id="meta" rows="3"></textarea>
            </div>



            <button type="submit" class="btn btn-outline-primary">Save</button>
        </form>
    </div>
@endsection
