@extends('front-layouts.app')

@section('title', 'Category {{ $category->name }}')

@section('content')
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Fresh and Organic</p>
						<h1>Shop</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- products -->
	<div class="product-section mt-150 mb-150">
		<div class="container">

			<div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <li class="active" data-filter="*">{{ $category->name }} Products</li>
                        </ul>
                    </div>
                </div>
            </div>

			<div class="row product-lists">
            @forelse ($products as $product)
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="{{ route('front.product.details', $product->slug) }}"><img src="{{ Storage::url($product->photo) }}" alt=""></a>
						</div>
						<h3>{{ $product->name }}</h3>
						<p class="product-price"> Rp {{ number_format($product->price, 0, ',', '.') }} </p>
                        <form action="{{ route('carts.store', $product->id) }}" method="POST">
                            @csrf
						    <button type="submit" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        </form>
					</div>
				</div>
            @empty
                <p>
                    Product tidak tersedia
                </p>
            @endforelse
			</div>

			
		</div>
	</div>
	<!-- end products -->
@endsection