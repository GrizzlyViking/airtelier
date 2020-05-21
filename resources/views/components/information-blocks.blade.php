<div class="information-blocks">
	<div class="tabs-container">
		<div class="swiper-tabs tabs-switch">
			<div class="title">Products</div>
			<div class="list">
				<a class="block-title tab-switcher active">Featured Products</a>
				<a class="block-title tab-switcher">Popular Products</a>
				<a class="block-title tab-switcher">New Arrivals</a>
				<div class="clear"></div>
			</div>
		</div>
		<div>
			@for($prd=1; $prd<4; $prd++)
			<div class="tabs-entry">
				<x-products-swiper :product_number="$prd" />
			</div>
			@endfor
			<div class="tabs-entry">
				<div class="products-swiper">
					<div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500"
						 data-center="0" data-slides-per-view="responsive" data-xs-slides="2"
						 data-int-slides="2" data-sm-slides="3" data-md-slides="4" data-lg-slides="5"
						 data-add-slides="5">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<div class="paddings-container">
									<div class="product-slide-entry shift-image">
										<div class="product-image">
											<img src="{{ asset('/mango/img/product-minimal-6.jpg') }}" alt=""/>
											<img src="{{ asset('/mango/img/product-minimal-12.jpg') }}" alt=""/>
											<a class="top-line-a left"><i class="fa fa-retweet"></i></a>
											<a class="top-line-a right"><i class="fa fa-heart"></i></a>
											<div class="bottom-line">
												<a class="bottom-line-a"><i
														class="fa fa-shopping-cart"></i> Add to cart</a>
											</div>
										</div>
										<a class="tag" href="#">Men clothing</a>
										<a class="title" href="#">Blue Pullover Batwing Sleeve
											Zigzag</a>
										<div class="rating-box">
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
										</div>
										<div class="price">
											<div class="prev">$199,99</div>
											<div class="current">$119,99</div>
										</div>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="paddings-container">
									<div class="product-slide-entry shift-image">
										<div class="product-image">
											<img src="{{ asset('/mango/img/product-minimal-7.jpg') }}" alt=""/>
											<img src="{{ asset('/mango/img/product-minimal-11.jpg') }}" alt=""/>
											<a class="top-line-a right open-product"><i
													class="fa fa-expand"></i>
												<span>Quick View</span></a>
											<div class="bottom-line">
												<div class="right-align">
													<a class="bottom-line-a square"><i
															class="fa fa-retweet"></i></a>
													<a class="bottom-line-a square"><i
															class="fa fa-heart"></i></a>
												</div>
												<div class="left-align">
													<a class="bottom-line-a"><i
															class="fa fa-shopping-cart"></i> Add to cart</a>
												</div>
											</div>
										</div>
										<a class="tag" href="#">Men clothing</a>
										<a class="title" href="#">Blue Pullover Batwing Sleeve
											Zigzag</a>
										<div class="rating-box">
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
										</div>
										<div class="price">
											<div class="prev">$199,99</div>
											<div class="current">$119,99</div>
										</div>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="paddings-container">
									<div class="product-slide-entry shift-image">
										<div class="product-image">
											<img src="{{ asset('/mango/img/product-minimal-8.jpg') }}" alt=""/>
											<img src="{{ asset('/mango/img/product-minimal-12.jpg') }}" alt=""/>
											<div class="bottom-line left-attached">
												<a class="bottom-line-a square"><i
														class="fa fa-shopping-cart"></i></a>
												<a class="bottom-line-a square"><i
														class="fa fa-heart"></i></a>
												<a class="bottom-line-a square"><i
														class="fa fa-retweet"></i></a>
												<a class="bottom-line-a square"><i
														class="fa fa-expand"></i></a>
											</div>
										</div>
										<a class="tag" href="#">Men clothing</a>
										<a class="title" href="#">Blue Pullover Batwing Sleeve
											Zigzag</a>
										<div class="rating-box">
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
										</div>
										<div class="price">
											<div class="prev">$199,99</div>
											<div class="current">$119,99</div>
										</div>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="paddings-container">
									<div class="product-slide-entry shift-image">
										<div class="product-image">
											<img src="{{ asset('/mango/img/product-minimal-9.jpg') }}" alt=""/>
											<img src="{{ asset('/mango/img/product-minimal-11.jpg') }}" alt=""/>
											<a class="top-line-a right open-product"><i
													class="fa fa-expand"></i>
												<span>Quick View</span></a>
											<div class="bottom-line">
												<div class="right-align">
													<a class="bottom-line-a square"><i
															class="fa fa-retweet"></i></a>
													<a class="bottom-line-a square"><i
															class="fa fa-heart"></i></a>
												</div>
												<div class="left-align">
													<a class="bottom-line-a"><i
															class="fa fa-shopping-cart"></i> Add to cart</a>
												</div>
											</div>
										</div>
										<a class="tag" href="#">Men clothing</a>
										<a class="title" href="#">Blue Pullover Batwing Sleeve
											Zigzag</a>
										<div class="rating-box">
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
										</div>
										<div class="price">
											<div class="prev">$199,99</div>
											<div class="current">$119,99</div>
										</div>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="paddings-container">
									<div class="product-slide-entry shift-image">
										<div class="product-image">
											<img src="{{ asset('/mango/img/product-minimal-10.jpg') }}" alt=""/>
											<img src="{{ asset('/mango/img/product-minimal-12.jpg') }}" alt=""/>
											<a class="top-line-a right open-product"><i
													class="fa fa-expand"></i>
												<span>Quick View</span></a>
											<div class="bottom-line">
												<div class="right-align">
													<a class="bottom-line-a square"><i
															class="fa fa-retweet"></i></a>
													<a class="bottom-line-a square"><i
															class="fa fa-heart"></i></a>
												</div>
												<div class="left-align">
													<a class="bottom-line-a"><i
															class="fa fa-shopping-cart"></i> Add to cart</a>
												</div>
											</div>
										</div>
										<a class="tag" href="#">Men clothing</a>
										<a class="title" href="#">Blue Pullover Batwing Sleeve
											Zigzag</a>
										<div class="rating-box">
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
										</div>
										<div class="price">
											<div class="prev">$199,99</div>
											<div class="current">$119,99</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="pagination"></div>
					</div>
				</div>
			</div>
			<div class="tabs-entry">
				<div class="products-swiper">
					<div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500"
						 data-center="0" data-slides-per-view="responsive" data-xs-slides="2"
						 data-int-slides="2" data-sm-slides="3" data-md-slides="4" data-lg-slides="5"
						 data-add-slides="5">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<div class="paddings-container">
									<div class="product-slide-entry shift-image">
										<div class="product-image">
											<img src="{{ asset('/mango/img/product-minimal-1.jpg') }}" alt=""/>
											<img src="{{ asset('/mango/img/product-minimal-11.jpg') }}" alt=""/>
											<a class="top-line-a left"><i class="fa fa-retweet"></i></a>
											<a class="top-line-a right"><i class="fa fa-heart"></i></a>
											<div class="bottom-line">
												<a class="bottom-line-a"><i
														class="fa fa-shopping-cart"></i> Add to cart</a>
											</div>
										</div>
										<a class="tag" href="#">Men clothing</a>
										<a class="title" href="#">Blue Pullover Batwing Sleeve
											Zigzag</a>
										<div class="rating-box">
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
										</div>
										<div class="price">
											<div class="prev">$199,99</div>
											<div class="current">$119,99</div>
										</div>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="paddings-container">
									<div class="product-slide-entry shift-image">
										<div class="product-image">
											<img src="{{ asset('/mango/img/product-minimal-3.jpg') }}" alt=""/>
											<img src="{{ asset('/mango/img/product-minimal-11.jpg') }}" alt=""/>
											<a class="top-line-a right open-product"><i
													class="fa fa-expand"></i>
												<span>Quick View</span></a>
											<div class="bottom-line">
												<div class="right-align">
													<a class="bottom-line-a square"><i
															class="fa fa-retweet"></i></a>
													<a class="bottom-line-a square"><i
															class="fa fa-heart"></i></a>
												</div>
												<div class="left-align">
													<a class="bottom-line-a"><i
															class="fa fa-shopping-cart"></i> Add to cart</a>
												</div>
											</div>
										</div>
										<a class="tag" href="#">Men clothing</a>
										<a class="title" href="#">Blue Pullover Batwing Sleeve
											Zigzag</a>
										<div class="rating-box">
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
										</div>
										<div class="price">
											<div class="prev">$199,99</div>
											<div class="current">$119,99</div>
										</div>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="paddings-container">
									<div class="product-slide-entry shift-image">
										<div class="product-image">
											<img src="{{ asset('/mango/img/product-minimal-5.jpg') }}" alt=""/>
											<img src="{{ asset('/mango/img/product-minimal-11.jpg') }}" alt=""/>
											<div class="bottom-line left-attached">
												<a class="bottom-line-a square"><i
														class="fa fa-shopping-cart"></i></a>
												<a class="bottom-line-a square"><i
														class="fa fa-heart"></i></a>
												<a class="bottom-line-a square"><i
														class="fa fa-retweet"></i></a>
												<a class="bottom-line-a square"><i
														class="fa fa-expand"></i></a>
											</div>
										</div>
										<a class="tag" href="#">Men clothing</a>
										<a class="title" href="#">Blue Pullover Batwing Sleeve
											Zigzag</a>
										<div class="rating-box">
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
										</div>
										<div class="price">
											<div class="prev">$199,99</div>
											<div class="current">$119,99</div>
										</div>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="paddings-container">
									<div class="product-slide-entry shift-image">
										<div class="product-image">
											<img src="{{ asset('/mango/img/product-minimal-7.jpg') }}" alt=""/>
											<img src="{{ asset('/mango/img/product-minimal-11.jpg') }}" alt=""/>
											<a class="top-line-a right open-product"><i
													class="fa fa-expand"></i>
												<span>Quick View</span></a>
											<div class="bottom-line">
												<div class="right-align">
													<a class="bottom-line-a square"><i
															class="fa fa-retweet"></i></a>
													<a class="bottom-line-a square"><i
															class="fa fa-heart"></i></a>
												</div>
												<div class="left-align">
													<a class="bottom-line-a"><i
															class="fa fa-shopping-cart"></i> Add to cart</a>
												</div>
											</div>
										</div>
										<a class="tag" href="#">Men clothing</a>
										<a class="title" href="#">Blue Pullover Batwing Sleeve
											Zigzag</a>
										<div class="rating-box">
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
										</div>
										<div class="price">
											<div class="prev">$199,99</div>
											<div class="current">$119,99</div>
										</div>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="paddings-container">
									<div class="product-slide-entry shift-image">
										<div class="product-image">
											<img src="{{ asset('/mango/img/product-minimal-9.jpg') }}" alt=""/>
											<img src="{{ asset('/mango/img/product-minimal-11.jpg') }}" alt=""/>
											<a class="top-line-a right open-product"><i
													class="fa fa-expand"></i>
												<span>Quick View</span></a>
											<div class="bottom-line">
												<div class="right-align">
													<a class="bottom-line-a square"><i
															class="fa fa-retweet"></i></a>
													<a class="bottom-line-a square"><i
															class="fa fa-heart"></i></a>
												</div>
												<div class="left-align">
													<a class="bottom-line-a"><i
															class="fa fa-shopping-cart"></i> Add to cart</a>
												</div>
											</div>
										</div>
										<a class="tag" href="#">Men clothing</a>
										<a class="title" href="#">Blue Pullover Batwing Sleeve
											Zigzag</a>
										<div class="rating-box">
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
											<div class="star"><i class="fa fa-star"></i></div>
										</div>
										<div class="price">
											<div class="prev">$199,99</div>
											<div class="current">$119,99</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="pagination"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
