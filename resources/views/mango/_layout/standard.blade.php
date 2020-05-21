<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="format-detection" content="telephone=no"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="viewport"
		  content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui"/>
	<link href="{{ asset('/mango/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('/mango/css/idangerous.swiper.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('/mango/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
	<link
		href='http://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700%7CDancing+Script%7CMontserrat:400,700%7CMerriweather:400,300italic%7CLato:400,700,900'
		rel='stylesheet' type='text/css'/>
	<link href='http://fonts.googleapis.com/css?family=Cantata+One' rel='stylesheet' type='text/css'/>
	<link href="{{ asset('/mango/css/style.css') }}" rel="stylesheet" type="text/css"/>
	<!--[if IE 9]>
	<link href="{{ asset('/mango/css/ie9.css') }}" rel="stylesheet" type="text/css"/>
	<![endif]-->
	<link rel="shortcut icon" href="{{ asset('/mango/img/favicon-9.ico') }}"/>
	<title>@yield('title')</title>
</head>
<body class="style-15">

<!-- LOADER -->
<div id="loader-wrapper">
	<div class="bubbles">
		<div class="title">loading</div>
		<span></span>
		<span id="bubble2"></span>
		<span id="bubble3"></span>
	</div>
</div>

<div id="content-block">

	<div class="content-center fixed-header-margin">
		<!-- HEADER -->
		@include('mango._partials.header')

		<div class="content-push">

			@section('content')
				<x-navigation-banner-swiper />

				<x-mozaic-banners-wrapper />

				<div class="hidden-sm hidden-xs" style="height: 30px;"></div>

				<x-information-blocks />

				<div class="column-article-wrapper">
					<div class="row nopadding">
						<div class="col-sm-4 information-entry left-border nopadding">
							<div class="column-article-entry">
								<a class="title" href="#">About Store</a>
								<div class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
									eiusmod tempor incididunt ut labore et dolore magna aliqua.
								</div>
								<a class="read-more">Read more <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
						<div class="col-sm-4 information-entry left-border nopadding">
							<div class="column-article-entry">
								<a class="title" href="#">Company Blog</a>
								<div class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
									eiusmod tempor incididunt ut labore et dolore magna aliqua.
								</div>
								<a class="read-more">Read more <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
						<div class="col-sm-4 information-entry left-border nopadding">
							<div class="column-article-entry">
								<a class="title" href="#">Coming Events</a>
								<div class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
									eiusmod tempor incididunt ut labore et dolore magna aliqua.
								</div>
								<a class="read-more">Read more <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			@show

		<!-- FOOTER -->
			@include('mango._partials.footer')

		</div>

	</div>
	<div class="clear"></div>

</div>

<div class="cart-box popup">
	<div class="popup-container">
		<div class="cart-entry">
			<a class="image"><img src="{{ asset('mango/img/product-menu-1.jpg') }}" alt=""/></a>
			<div class="content">
				<a class="title" href="#">Pullover Batwing Sleeve Zigzag</a>
				<div class="quantity">Quantity: 4</div>
				<div class="price">$990,00</div>
			</div>
			<div class="button-x"><i class="fa fa-close"></i></div>
		</div>
		<div class="cart-entry">
			<a class="image"><img src="{{ asset('mango/img/product-menu-1_.jpg') }}" alt=""/></a>
			<div class="content">
				<a class="title" href="#">Pullover Batwing Sleeve Zigzag</a>
				<div class="quantity">Quantity: 4</div>
				<div class="price">$990,00</div>
			</div>
			<div class="button-x"><i class="fa fa-close"></i></div>
		</div>
		<div class="summary">
			<div class="subtotal">Subtotal: $990,00</div>
			<div class="grandtotal">Grand Total <span>$1029,79</span></div>
		</div>
		<div class="cart-buttons">
			<div class="column">
				<a class="button style-3">view cart</a>
				<div class="clear"></div>
			</div>
			<div class="column">
				<a class="button style-4">checkout</a>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<div id="product-popup" class="overlay-popup">
	<div class="overflow">
		<div class="table-view">
			<div class="cell-view">
				<div class="close-layer"></div>
				<div class="popup-container">

					<div class="row">
						<div class="col-sm-6 information-entry">
							<div class="product-preview-box">
								<div class="swiper-container product-preview-swiper" data-autoplay="0" data-loop="1"
									 data-speed="500" data-center="0" data-slides-per-view="1">
									<div class="swiper-wrapper">
										<div class="swiper-slide">
											<div class="product-zoom-image">
												<img src="{{ asset('/mango/img/product-main-1.jpg') }}" alt=""
													 data-zoom="{{ asset('/mango/img/product-main-1-zoom') }}.jpg"/>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="product-zoom-image">
												<img src="{{ asset('/mango/img/product-main-2.jpg') }}" alt=""
													 data-zoom="{{ asset('/mango/img/product-main-2-zoom') }}.jpg"/>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="product-zoom-image">
												<img src="{{ asset('/mango/img/product-main-3.jpg') }}" alt=""
													 data-zoom="{{ asset('/mango/img/product-main-3-zoom') }}.jpg"/>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="product-zoom-image">
												<img src="{{ asset('/mango/img/product-main-4.jpg') }}" alt=""
													 data-zoom="{{ asset('/mango/img/product-main-4-zoom') }}.jpg"/>
											</div>
										</div>
									</div>
									<div class="pagination"></div>
									<div class="product-zoom-container">
										<div class="move-box">
											<img class="default-image" src="{{ asset('/mango/img/product-main-1.jpg') }}" alt=""/>
											<img class="zoomed-image" src="{{ asset('/mango/img/product-main-1-zoom') }}.jpg" alt=""/>
										</div>
										<div class="zoom-area"></div>
									</div>
								</div>
								<div class="swiper-hidden-edges">
									<div class="swiper-container product-thumbnails-swiper" data-autoplay="0"
										 data-loop="0" data-speed="500" data-center="0"
										 data-slides-per-view="responsive" data-xs-slides="3" data-int-slides="3"
										 data-sm-slides="3" data-md-slides="4" data-lg-slides="4" data-add-slides="4">
										<div class="swiper-wrapper">
											<div class="swiper-slide selected">
												<div class="paddings-container">
													<img src="{{ asset('/mango/img/product-main-1.jpg') }}" alt=""/>
												</div>
											</div>
											<div class="swiper-slide">
												<div class="paddings-container">
													<img src="{{ asset('/mango/img/product-main-2.jpg') }}" alt=""/>
												</div>
											</div>
											<div class="swiper-slide">
												<div class="paddings-container">
													<img src="{{ asset('/mango/img/product-main-3.jpg') }}" alt=""/>
												</div>
											</div>
											<div class="swiper-slide">
												<div class="paddings-container">
													<img src="{{ asset('/mango/img/product-main-4.jpg') }}" alt=""/>
												</div>
											</div>
										</div>
										<div class="pagination"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 information-entry">
							<div class="product-detail-box">
								<h1 class="product-title">T-shirt Basic Stampata</h1>
								<h3 class="product-subtitle">Loremous Clothing</h3>
								<div class="rating-box">
									<div class="star"><i class="fa fa-star"></i></div>
									<div class="star"><i class="fa fa-star"></i></div>
									<div class="star"><i class="fa fa-star"></i></div>
									<div class="star"><i class="fa fa-star-o"></i></div>
									<div class="star"><i class="fa fa-star-o"></i></div>
									<div class="rating-number">25 Reviews</div>
								</div>
								<div class="product-description detail-info-entry">Lorem ipsum dolor sit amet,
									consectetur adipiscing elit, eiusmod tempor incididunt ut labore et dolore magna
									aliqua. Lorem ipsum dolor sit amet, consectetur.
								</div>
								<div class="price detail-info-entry">
									<div class="prev">$90,00</div>
									<div class="current">$70,00</div>
								</div>
								<div class="size-selector detail-info-entry">
									<div class="detail-info-entry-title">Size</div>
									<div class="entry active">xs</div>
									<div class="entry">s</div>
									<div class="entry">m</div>
									<div class="entry">l</div>
									<div class="entry">xl</div>
									<div class="spacer"></div>
								</div>
								<div class="color-selector detail-info-entry">
									<div class="detail-info-entry-title">Color</div>
									<div class="entry active" style="background-color: #d23118;">&nbsp;</div>
									<div class="entry" style="background-color: #2a84c9;">&nbsp;</div>
									<div class="entry" style="background-color: #000;">&nbsp;</div>
									<div class="entry" style="background-color: #d1d1d1;">&nbsp;</div>
									<div class="spacer"></div>
								</div>
								<div class="quantity-selector detail-info-entry">
									<div class="detail-info-entry-title">Quantity</div>
									<div class="entry number-minus">&nbsp;</div>
									<div class="entry number">10</div>
									<div class="entry number-plus">&nbsp;</div>
								</div>
								<div class="detail-info-entry">
									<a class="button style-10">Add to cart</a>
									<a class="button style-11"><i class="fa fa-heart"></i> Add to Wishlist</a>
									<div class="clear"></div>
								</div>
								<div class="tags-selector detail-info-entry">
									<div class="detail-info-entry-title">Tags:</div>
									<a href="#">bootstrap</a>/
									<a href="#">collections</a>/
									<a href="#">color/</a>
									<a href="#">responsive</a>
								</div>
							</div>
						</div>
					</div>

					<div class="close-popup"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('/mango/js/jquery-2.1.3.min.js') }}"></script>
<script src="{{ asset('/mango/js/idangerous.swiper.min.js') }}"></script>
<script src="{{ asset('/mango/js/global.js') }}"></script>

<!-- custom scrollbar -->
<script src="{{ asset('/mango/js/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('/mango/js/jquery.jscrollpane.min.js') }}"></script>
</body>
</html>
