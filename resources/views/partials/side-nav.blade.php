<div class="kt-grid kt-grid--hor kt-grid--root">
	<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

		@include('partials.aside')

		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
			@include('partials.header')

			<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

				<!-- begin:: Subheader -->
				<div class="kt-subheader   kt-grid__item" id="kt_subheader">
					<div class="kt-container  kt-container--fluid ">
						<div class="kt-subheader__main">
							<h3 class="kt-subheader__title">
                                Empty Page
                            </h3>
						</div>
					</div>
				</div>

				<!-- end:: Subheader -->

				<!-- begin:: Content -->
				<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                    Content goes here...
                </div>

				<!-- end:: Content -->
			</div>

			<!-- begin:: Footer -->
			<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
				<div class="kt-container  kt-container--fluid ">
					<div class="kt-footer__copyright">
                        {{ date('Y') }}&nbsp;&copy;&nbsp;
                        {{-- <a href="http://keenthemes.com/metronic" target="_blank" class="kt-link">Keenthemes</a> --}}
					</div>
					{{-- <div class="kt-footer__menu">
						<a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">About</a>
						<a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
						<a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
					</div> --}}
				</div>
			</div>
			<!-- end:: Footer -->
		</div>
	</div>
</div>