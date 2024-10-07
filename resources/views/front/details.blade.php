@extends('front-layouts.app')

@section('title', 'Product Details')

@section('content')

    <!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>See more Details</p>
						<h1>Single Product</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- single product -->
	<div class="single-product mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="single-product-img">
						<img src="{{ Storage::url($product->photo) }}" alt="">
					</div>
				</div>
				<div class="col-md-7">
					<div class="single-product-content">
						<h3>{{ $product->name }}</h3>
						<p class="single-product-pricing"><span>Per Kg</span> Rp {{ $product->price }}</p>
						<p>{{ $product->about }}</p>
						<div class="single-product-form">
						<form action="{{ route('carts.store', $product->id) }}" method="POST">
						@csrf
							<a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
						</form>
							<p><strong>Categories: </strong>{{ $product->category->name }}</p>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end single product -->
@endsection