@extends('frontend.layout.standard')

@section('content')
	<div class="container mt-3">
		<div class="card">
			<div class="card-header"><h3>{{__('Account')}}</h3></div>
			<div class="card-body">
				<form method="post" action="{{ route('frontend.account.update') }}">
					@method('put')
					@csrf
					<div class="form-group">
						<label for="name">Name</label>
						<input
							type="text"
							class="form-control"
							id="name"
							name="name"
							placeholder="Enter name"
							value="{{ old('name', $user->name) }}"
						>
					</div>

					<div class="form-group">
						<label for="email">Email</label>
						<input
							type="email"
							class="form-control"
							id="email"
							name="email"
							placeholder="Enter email"
							value="{{ old('email', $user->email) }}"
							required
						>
					</div>

					<div class="form-group">
						<label for="phone">Phone</label>
						<input
							type="text"
							class="form-control"
							id="phone"
							name="phone"
							placeholder="Enter phone"
							value="{{ old('phone', $user->phone) }}"
						>
					</div>

					<div class="form-group">
						<label for="role">Role</label>
						<input type="text" class="form-control" id="role" name="role" value="{{$user->role()}}"
							   disabled>
					</div>

					<address-component :edit="true" :value="{{ json_encode($user->addresses->first()) }}"></address-component>

					<button type="submit" class="btn btn-dark">Update</button>
				</form>
			</div>
			<div class="card-footer d-flex justify-content-around">
				<div class="text-muted">Created: {{ $user->created_at->diffForHumans() }}</div>
				<div class="text-muted">Last updated on: {{ $user->updated_at->diffForHumans() }}</div>
			</div>
		</div>
	</div>
@endsection
