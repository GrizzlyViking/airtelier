@extends('frontend.layout.standard')

@section('content')
	<div class="container">
		<div class="card mt-4">
			<div class="card-header"><h1>Checkout</h1></div>
			<div class="card-body">
				<table class="table">
					<thead>
					<tr>
						<th scope="col">Title</th>
						<th scope="col" class="text-center">Date</th>
						<th scope="col">#</th>
						<th scope="col" class="text-right">Unit Price</th>
						<th scope="col" class="text-right">Price</th>
					</tr>
					</thead>
					<tbody>
					<?php
					/** @var \App\Models\Cart $cart */
					/** @var \App\Models\Resource $item */
					?>
					@foreach($cart->basket as $item)
						<tr>
							<td scope="row">{{ $item->title }}</td>
							<td class="text-center">{{ $item->created_at }}</td>
							<td>{{ $item->quantity }}</td>
							<td class="text-right">{{ $item->price->amount }}</td>
							<td class="text-right">{{ $item->price->amount * $item->quantity }}</td>
						</tr>
					@endforeach
					</tbody>
					<tfoot>
					<th colspan="4">&nbsp;</th>
					<th class="text-right">{{ $cart->total }}</th>
					</tfoot>
				</table>
			</div>
			<a class="card-footer text-right">
				<a href="/payment"><button class="btn btn-success">Proceed</button></a>
			</div>
		</div>
	</div>
@endsection
