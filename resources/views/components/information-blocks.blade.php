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
				<div class="products-swiper">
					<div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500"
						 data-center="0" data-slides-per-view="responsive" data-xs-slides="2"
						 data-int-slides="2" data-sm-slides="3" data-md-slides="4" data-lg-slides="5"
						 data-add-slides="5">
						<div class="swiper-wrapper">
							@for($panels=1; $panels<rand(2,6); $panels++)
							<x-swiper-slide />
								@endfor
						</div>
						<div class="pagination"></div>
					</div>
				</div>
			</div>
			@endfor
		</div>
	</div>
</div>
