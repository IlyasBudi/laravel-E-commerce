@extends('front-layouts.app')

@section('title', 'Carts')

@section('content')
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Fresh and Organic</p>
						<h1>Cart</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- cart -->
	<div class="cart-section mt-150 mb-50">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12">
					<div class="cart-table-wrap">
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th class="product-image">Product Image</th>
									<th class="product-name">Name</th>
									<th class="product-price">Price</th>
									<!-- <th class="product-quantity">Quantity</th>
									<th class="product-total">Total</th> -->
									<th class="product-remove"></th>
								</tr>
							</thead>
							<tbody>
								@forelse ($my_carts as $cart)
									<tr class="table-body-row">
										<td class="product-image"><img src="{{ Storage::url($cart->product->photo) }}" alt=""></td>
										<td class="product-name">{{ $cart->product->name }}</td>
										<td class="product-price" data-price="{{ $cart->product->price }}">Rp {{ $cart->product->price }}</td>
										<!-- <td class="product-quantity"><input type="number" placeholder="0"></td>
										<td class="product-total">1</td> -->
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
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th class="product-remove">Name</th>
									<th class="product-image">Input</th>
								</tr>
							</thead>
							<tbody>
								<tr class="table-body-row">
									<td>Address</td>
									<td><p><input name="address" id="address__" value="Jl. Rasuna Said" type="text" placeholder="address"></p></td>
								</tr>
								<tr class="table-body-row">
									<td class="product-remove"><a href="#"><i class="far fa-window-close"></i></a></td>
									<td class="product-image"><img src="assets/img/products/product-img-2.jpg" alt=""></td>
									<td class="product-name">Berry</td>
									<td class="product-price">$70</td>
									<td class="product-quantity"><input type="number" placeholder="0"></td>
									<td class="product-total">1</td>
								</tr>
								<tr class="table-body-row">
									<td class="product-remove"><a href="#"><i class="far fa-window-close"></i></a></td>
									<td class="product-image"><img src="assets/img/products/product-img-3.jpg" alt=""></td>
									<td class="product-name">Lemon</td>
									<td class="product-price">$35</td>
									<td class="product-quantity"><input type="number" placeholder="0"></td>
									<td class="product-total">1</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- end cart -->

	<!-- check out section -->
	<!-- <div class="checkout-section">
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
						        		<p><input name="address" id="address__" value="Jl. Rasuna Said" type="text" placeholder="address"></p>
						        		<p><input name="phone_number" id="phonenumber__" type="tel" placeholder="Phone Number" value="081212345678"></p>
						        		<p><textarea name="notes" id="notes__" cols="30" rows="10" placeholder="Say Something"></textarea></p>
						        	</form>
						        </div>
						      </div>
						    </div>

						  </div>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!-- end check out section -->

	<!-- cart -->
	<!-- <div class="cart-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12">
					<div class="cart-table-wrap">
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th class="product-price">Price</th>
									<th class="product-total">Total</th>
								</tr>
							</thead>
							<tbody>
								<tr class="table-body-row">
									<td><strong>Subtotal: </strong></td>
									<td>Rp {{ number_format($subTotal, 2) }}</td>
								</tr>
								<tr class="table-body-row">
									<td><strong>Ppn: </strong></td>
									<td>Rp {{ number_format($ppn, 2) }}</td>
								</tr>
								<tr class="table-body-row">
									<td><strong>Total: </strong></td>
									<td>Rp {{ number_format($grandTotal, 2) }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!-- end cart -->
	<!-- <div class="col-lg-8">
		<div class="cart-buttons">
			<a href="{{ route('product_transactions.create') }}" class="boxed-btn black">Check Out</a>
		</div>
	</div> -->
@endsection

