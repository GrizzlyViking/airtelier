@extends('frontend.layout.standard')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>{{ $offer->title }}</h1>
            </div>
            <div class="card-body">
                {!! $offer->description !!}
            </div>
        </div>

        <div class="card">
            <div class="card-header">Address:</div>
            <div class="card-body">
                <pre></pre>
            </div>
        </div>
    </div>
@endsection
