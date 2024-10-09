<!-- header -->
<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="/">
								<img src="{{ asset('/template') }}/assets/img/logo.svg" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li class="current-list-item"><a href="/">Home</a></li>
								<li><a href="{{ route('front.about') }}">About</a></li>
								<li><a href="{{ route(name: 'front.shop') }}">Shop</a>
								</li>
								<li>
									<div class="header-icons">
										<a class="shopping-cart" href="{{ route('carts.index') }}"><i class="fas fa-shopping-cart"></i></a>
										<a class="mobile-hide search-bar-icon" href="{{ route('dashboard') }}"><i class="fas fa-user"></i>
                                        @auth
                                            {{ Auth::user()->name }}
                                        @endauth
                                        @guest
                                            Anonim
                                        @endguest
                                        </a>
									</div>
								</li>
							</ul>
						</nav>
						@auth
						<a class="mobile-show search-bar-icon" href="{{ route('dashboard') }}"><i class="fas fa-user"></i>{{ Auth::user()->name }}</a>
						@endauth
                        @guest
                            Anonim
                        @endguest
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
</div>
<!-- end header -->