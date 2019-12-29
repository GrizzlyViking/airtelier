@extends('frontend.layout.standard')

@section('content')
    <div class="container p-6 mt-4">
        <div class="card">
            <div class="card-header p-6">
                <h3>Register</h3>
            </div>
            <div class="card-body p-6">
                <form action="/register" method="post">
					@csrf
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>

                    <button class="btn btn-outline-grey w-100 mt-5">
                        Register
                    </button>
                </form>
				<div>
					@if (session('errors'))
						<div class="alert alert-danger">
							@foreach(json_decode(session('errors'), true) as $key => $error)
							{{ $error }}
							@endforeach
							{{ session('errors') }}
						</div>
					@endif
				</div>
            </div>
        </div>
    </div>
@endsection
