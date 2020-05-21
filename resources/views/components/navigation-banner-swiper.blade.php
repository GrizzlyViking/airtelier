<div class="navigation-banner-swiper">
	<div class="swiper-container" data-autoplay="5000" data-loop="1" data-speed="500" data-center="0"  data-slides-per-view="1">
		<div class="swiper-wrapper">
			@for($key = 0; $key < 2; $key++)
			<div class="swiper-slide{{ $key === 0 ? ' active' : '' }}" data-val="{{ $key }}">
				<div class="navigation-banner-wrapper light-text align-3" style="background-image: url({{ asset('/mango/img/mini-'.($key+1).'.jpg') }}); background-position: center center;">
					<div class="navigation-banner-content">
						<div class="cell-view">
							<h2 class="subtitle">new special collection</h2>
							<h1 class="title">Minimal Collection</h1>
							<div class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			@endfor
		</div>
		<div class="clear"></div>
		<div class="pagination"></div>
	</div>
</div>
