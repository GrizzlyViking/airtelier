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
                <select-component :options="{{$options}}" input_name="owner_id" label="name" initial-value="{{old('owner_id', 5)}}"></select-component>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" value="{{old('name')}}" id="name" name="name" placeholder="Enter name">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <editor-component name="description" body_class="form-control" rows="5"></editor-component>
            </div>


            <div class="form-group">
                <label for="address">Address:</label>
                <textarea name="address" class="form-control" id="address" rows=3></textarea>
            </div>

            <div class="form-group">
                <label for="postcode">Post code</label>
                <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Enter postcode">
            </div>

            <div class="form-group">
                <label for="town">Town or City</label>
                <input type="text" class="form-control" id="town" name="town" placeholder="Enter town">
            </div>

            <meta-component name="meta" id="meta"></meta-component>

            <button type="submit" class="btn btn-outline-primary">Save</button>
        </form>
    </div>
@endsection
