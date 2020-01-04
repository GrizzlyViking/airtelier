@extends('frontend.layout.standard')

@section('content')
	<div class="container mt-4">
	 <div class="row justify-content-center">
		 <div class="col-4">
			 <card-payment
				 :intent="{{ json_encode($intent) }}"
				 :user="{{ $user }}"
				 :cart="{{ $cart }}"
			 >Stripe</card-payment>
		 </div>
	 </div>
	</div>
@endsection

@section('scripts')
	<script src="https://js.stripe.com/v3/"></script>
@endsection
