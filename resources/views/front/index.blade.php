@extends('front-layouts.app')

@section('title', 'Welcome')

@section('content')

	<!-- hero area -->
	<div class="hero-area hero-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 offset-lg-2 text-center">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Fresh & Organic</p>
							<h1>Delicious Vegetables & Fruits</h1>
							<div class="hero-btns">
								<a href="{{ route('front.shop') }}" class="boxed-btn">See Collection</a>
								<a href="#about" class="bordered-btn">About Us</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end hero area -->

	<!-- features list section -->
	<div class="list-section pt-80 pb-80">
		<div class="container">

			<div class="row">
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-shipping-fast"></i>
						</div>
						<div class="content">
							<h3>Shipping</h3>
							<p>Fast and safe delivery</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-phone-volume"></i>
						</div>
						<div class="content">
							<h3>24/7 Support</h3>
							<p>Get support all day</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="list-box d-flex justify-content-start align-items-center">
						<div class="list-icon">
							<i class="fas fa-money-bill-alt"></i>
						</div>
						<div class="content">
							<h3>Best Price</h3>
							<p>Best quality with low price</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- end features list section -->

	<!-- product section -->
	<div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text">Our</span> Products</h3>
						<p>Setiap produk kami dipastikan bebas dari bahan kimia berbahaya dan diproses dengan cara yang menjaga kesegarannya.</p>
					</div>
				</div>
			</div>

			<div class="row">
			@forelse ($products as $product)
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="{{ route('front.product.details', $product->slug) }}"><img src="{{ Storage::url($product->photo) }}" alt=""></a>
						</div>
						<h3>{{ $product->name }}</h3>
						<p class="product-price"> Rp {{ $product->price }} </p>
						<form action="{{ route('carts.store', $product->id) }}" method="POST">
							@csrf
							<button type="submit" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
						</form>
					</div>
				</div>
			@empty
			<p>Belum ada product yang ditambahkan.</p>
			@endforelse
			</div>
		</div>
	</div>
	<!-- end product section -->

	<!-- latest news -->
	<div class="latest-news pt-150 pb-150">
		<div class="container">

			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text">Our</span> Category</h3>
						<p>Kami menawarkan berbagai kategori produk yang dipilih dengan cermat untuk memastikan Anda mendapatkan yang terbaik dari alam.</p>
					</div>
				</div>
			</div>

			<div class="row">
			@forelse ($categories as $category)
				<div class="col-lg-4 col-md-6">
				
					<div class="single-latest-news">
					
						<a href="{{ route('front.product.category', $category) }}"><div class="latest-news-bg news-bg-1" style="background-image: url('{{ Storage::url($category->icon) }}');"></div></a>
						<div class="news-text-box">
							<h3><a href="{{ route('front.product.category', $category) }}">{{ $category->name }}</a></h3>
							<!-- <p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i> Admin</span>
								<span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
							</p> -->
							<p class="excerpt">{{ $category->about }}.</p>
							<a href="{{ route('front.product.category', $category) }}" class="read-more-btn">See Products <i class="fas fa-angle-right"></i></a>
						</div>
					
					</div>
				</div>
			@empty
			<p>Belum ada Category yang ditambahkan.</p>
            @endforelse
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<a href="{{ route(name: 'front.shop') }}" class="boxed-btn">See All</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end latest news -->

    <!-- advertisement section -->
	<div class="abt-section mb-150" id="about">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="abt-bg">
						<!-- <a href="https://www.youtube.com/watch?v=DBLlFWYcIGQ" class="video-play-btn popup-youtube"><i class="fas fa-play"></i></a> -->
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="abt-text">
						<p class="top-sub">Sehat, Segar, Alami.</p>
						<h2>We are <span class="orange-text">FreshHarvest</span></h2>
						<p>FreshHarvest adalah platform e-commerce terdepan yang berfokus pada penyediaan buah dan sayuran segar berkualitas tinggi langsung dari petani lokal ke pintu rumah Anda. Kami berdedikasi untuk menyediakan produk yang sehat dan alami, memastikan setiap pelanggan mendapatkan manfaat dari produk segar yang kami tawarkan.</p>
						<p>FreshHarvest menawarkan berbagai macam buah dan sayuran segar yang dipilih dengan cermat untuk memastikan kualitas dan kesegaran. Dari buah tropis yang manis hingga sayuran hijau yang renyah, kami memiliki semua yang Anda butuhkan untuk memenuhi kebutuhan nutrisi harian Anda.</p>
						<a href="{{ route('front.about') }}" class="boxed-btn mt-4">know more</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end advertisement section -->
@endsection