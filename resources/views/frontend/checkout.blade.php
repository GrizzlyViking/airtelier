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
						<th scope="col" class="text-right">Currency</th>
						<th scope="col" class="text-right">Unit Price</th>
						<th scope="col" class="text-right">Price</th>
					</tr>
					</thead>
					<tbody>
					@foreach($cart->items as $item)
						<tr>
							<td scope="row">{{ $item->item->title }}</td>
							<td class="text-center">{{ $item->item->created_at->format('jS F') }}</td>
							<td>{{ $item->quantity }}</td>
							<td class="text-right">{{ $cart->currency->code }}</td>
							<td class="text-right">{{ $item->unitPrice() }}</td>
							<td class="text-right">{{ $item->total }}</td>
						</tr>
					@endforeach
					</tbody>
					<tfoot>
					<th colspan="5">&nbsp;</th>
					<th class="text-right">{{ $cart->total }}</th>
					</tfoot>
				</table>
			</div>
			<div class="card-footer text-right">
				<a href="/payment"><button class="btn btn-success">Proceed</button></a>
			</div>
		</div>
	</div>
@endsection
