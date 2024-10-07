@extends('front-layouts.app')

@section('title', 'Welcome')

@section('content')
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Fresh and Organic</p>
						<h1>Check Out Product</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- check out section -->
	<div class="checkout-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="checkout-accordion-wrap">
						<div class="accordion" id="accordionExample">
						  <div class="card single-accordion">
						    <div class="card-header" id="headingOne">
						      <h5 class="mb-0">
						        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						          Billing Address
						        </button>
						      </h5>
						    </div>

						    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
						      <div class="card-body">
						        <div class="billing-address-form">
									<form action="{{ route('product_transactions.store') }}" method="POST"
									id="deliveryForm" enctype="multipart/form-data">
									@csrf
						        		<p><input name="address" id="address__" value="Jl. Rasuna Said" type="text" placeholder="address"></p>
						        		<p><input name="phone_number" id="phonenumber__" type="tel" placeholder="Phone Number" value="081212345678"></p>
						        		<p><textarea name="notes" id="notes__" cols="30" rows="10" placeholder="Say Something"></textarea></p>
										<button type="submit" class="boxed-btn">Place Order</button>
						        	
						        </div>
						      </div>
						    </div>
						  </div>
						  
						</div>

					</div>
				</div>

				<div class="col-lg-4">
					<div class="order-details-wrap">
						<table class="order-details">
							<thead>
								<tr>
									<th>Your order Details</th>
									<th>Price</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody class="order-details-body">
							@forelse ($my_carts as $cart)
								<tr>
									<td class="product-name">{{ $cart->product->name }}</td>
									<td class="product-price" data-price="{{ $cart->product->price }}">Rp {{ $cart->product->price }}</td>
									<form action="{{ route('carts.destroy', $cart) }}" method="POST">
									@csrf
									@method('DELETE')
										<td class="product-remove"><button type="submit"><i class="far fa-window-close"></i></button></td>
									</form>
								</tr>
								@empty
									<td>Belum ada transaksi.</td>
								@endforelse
							</tbody>
							<tbody class="checkout-details">
								<tr>
									<td>Subtotal</td>
									<td>Rp {{ number_format($subTotal, 2) }}</td>
								</tr>
								<tr>
									<td>Shipping</td>
									<td>Rp {{ number_format($ppn, 2) }}</td>
								</tr>
								<tr>
									<td>Total</td>
									<td>Rp {{ number_format($grandTotal, 2) }}</td>
								</tr>
							</tbody>
						</table>
						<!-- <button type="submit" class="boxed-btn">Place Order</button> -->
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end check out section -->
@endsection