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
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- end cart -->

	<!-- check out section -->
	<div class="checkout-section mt-80 mb-150">
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
						        		<!-- <p><input type="text" placeholder="Address"></p>
						        		<p><input type="tel" placeholder="Phone"></p> -->
						        		<p><textarea name="notes" id="notes__" cols="30" rows="10" placeholder="Say Something"></textarea></p>
						        	</form>
						        </div>
						      </div>
						    </div>

							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
						      <div class="card-body">
						        <div class="billing-address-form">
						        		<p id="checkout-sub-total"><label for="sub-total">Sub Total</label></p>
						        		<p id="checkout-ppn"><label for="sub-total">PPN 11%</label></p>
										<p id="checkout-grand-total-price"><label for="sub-total">Grand Total Price</label></p>
						        		
						        </div>
						      </div>
						    </div>

						  </div>
						  
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- end check out section -->
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('scripts/global.js') }}"></script>
    <script>
        function calculatePrice() {
            let subTotal = 0;
            let deliveryFee = 10000;

            document.querySelectorAll('.product-price').forEach(item => {
                subTotal += parseFloat(item.getAttribute('data-price'));
            });

            document.getElementById('checkout-delivery-fee').textContent = 'Rp ' + deliveryFee.toLocaleString('id', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            document.getElementById('checkout-sub-total').textContent = 'Rp ' + subTotal.toLocaleString('id', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            const tax = 11 * subTotal / 100;
            document.getElementById('checkout-ppn').textContent = 'Rp ' + tax.toLocaleString('id', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            const insurance = 23 * subTotal / 100;
            document.getElementById('checkout-insurance').textContent = 'Rp ' + insurance.toLocaleString('id', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            const grandTotalPrice = subTotal + tax + insurance + deliveryFee;
            document.getElementById('checkout-grand-total').textContent = 'Rp ' + grandTotalPrice.toLocaleString('id', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            document.getElementById('checkout-grand-total-price').textContent = 'Rp ' + grandTotalPrice.toLocaleString(
                'id', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 2
                });

        }

        document.addEventListener('DOMContentLoaded', function() {
            calculatePrice();
        });
</script>