@extends('layouts.app')

@section('template_title')
	Mes autorisations
@endsection

@section('template_linked_css')
	{{-- <link href="./assets/css/demo1/pages/wizard/wizard-4.css" rel="stylesheet" type="text/css" /> --}}
@endsection

@section('content')
		<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

			<!--Begin:: App Aside Mobile Toggle-->
			<button class="kt-app__aside-close" id="kt_user_profile_aside_close">
				<i class="la la-close"></i>
			</button>

			<!--End:: App Aside Mobile Toggle-->

			<!--Begin:: App Aside-->
			<div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">

				<!--begin:: Widgets/Applications/User/Profile4-->
				<div class="kt-portlet kt-portlet--height-fluid-">
					<div class="kt-portlet__body">

						<!--begin::Widget -->
						<div class="kt-widget kt-widget--user-profile-4">
							<div class="kt-widget__head">
								<div class="kt-widget__media">
									<img class="kt-widget__img kt-hidden-" src="{{ $user->avatar_url }}" alt="image">
									<div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light kt-hidden">
										JD
									</div>
								</div>
								<div class="kt-widget__content">
									<div class="kt-widget__section">
                                        <span class="kt-widget__username">
                                            {{ $user->first_name . ' ' . $user->last_name }}
                                        </span>
									</div>
								</div>
							</div>
							<div class="kt-widget__body">
								<a href="{{ url('/profile/'.Auth::user()->name.'/edit') }}" class="kt-widget__item">
									Mes informations
								</a>
								<a href="{{ url('/profile/role-permissions') }}" class="kt-widget__item kt-widget__item--active">
									Mes autorisations
								</a>
								<a href="{{ url('/profile/change-password') }}" class="kt-widget__item">
									Changer mon mot de passe
								</a>
							</div>
						</div>

						<!--end::Widget -->
					</div>
				</div>

				<!--end:: Widgets/Applications/User/Profile4-->

			</div>

			<!--End:: App Aside-->

			<!--Begin:: App Content-->
			<div class="kt-grid__item kt-grid__item--fluid kt-app__content">
				<div class="row">
					<div class="col-xl-12">
						<!--begin:: Widgets/Order Statistics-->
						<div class="kt-portlet kt-portlet--height-fluid">
							<div class="kt-portlet__head">
								<div class="kt-portlet__head-label">
									<h3 class="kt-portlet__head-title">
										Mes autorisations
									</h3>
								</div>
							</div>
							<div class="kt-portlet__body">
								<div class="kt-section kt-section--first">
									<div class="kt-section__body">
										<label>Roles : </label>
										<ul>
											@foreach($user->getRoles() as $role)
												<li><strong>{{$role->name}}</strong></li>
											@endforeach
										</ul>
										<hr>
										<label>Permissions : </label>
										<ul>
											@foreach($user->getPermissions() as $permission)
												<li><strong>{{$permission->name}}</strong></li>
											@endforeach
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!--end:: Widgets/Order Statistics-->
					</div>
				</div>
			</div>

			<!--End:: App Content-->
		</div>
@endsection

@section('footer_scripts')
@endsection
