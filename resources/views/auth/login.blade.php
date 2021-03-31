@extends('layouts.app')

@section('template_linked_css')
    <link href="{{ asset('assets/css/demo1/pages/login/login-1.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    {{-- begin:: Test Login page --}}
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">

                <!--begin::Aside-->
                <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside"
                     style="background-image: url({{ asset('assets/media/bg/1920-2-01.png') }});">
                    <div class="kt-grid__item">
                        <a href="#" class="kt-login__logo">
                            <img src="{{ asset('assets/media/logos/logo-medays.svg') }}" width="50%">
                        </a>
                    </div>
                    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
                        <div class="kt-grid__item kt-grid__item--middle">
                            <h3 class="kt-login__title">FORUM MEDAYS <br><small>12 ème Édition</small></h3>
                            <h4 class="kt-login__subtitle">Du 13 au 16 Novembre 2019, Tanger</h4>
                        </div>
                    </div>
                    <div class="kt-grid__item">
                        <div class="kt-login__info">
                            <div class="kt-login__copyright">
                                &nbsp;&copy;&nbsp; {{ date('Y') }} | Reeventy&reg;&nbsp; par&nbsp;<a
                                        href="https://www.innoveos.com" target="_blank" class="kt-link">INNOVEOS</a>&nbsp;|
                                Tous droits réservés
                            </div>
                        </div>
                    </div>
                </div>

                <!--begin::Aside-->

                <!--begin::Content-->
                <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">

                    <!--end::Head-->

                    <!--begin::Body-->
                    <div class="kt-login__body">

                        <!--begin::Signin-->
                        <div class="kt-login__form">
                            <div class="kt-login__title">
                                <h3>Connectez-vous à Reeventy</h3>
                            </div>
                            <hr>
                            <!--begin::Form-->
                            <form class="kt-form" method="POST" action="{{ route('login') }}" autocomplete="off">
                                @csrf

                                <div class="form-group">
                                    <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           type="text" placeholder="E-mail" name="email" autocomplete="off"
                                           value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <div id="email-error"
                                             class="error invalid-feedback">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Mot de passe"
                                           name="password"
                                           {{ $errors->has('password') ? ' is-invalid' : '' }} autocomplete="off"
                                           required>

                                    @if ($errors->has('password'))
                                        <div id="email-error"
                                             class="error invalid-feedback">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>

                                <!--begin::Action-->
                                <div class="kt-login__actions">
                                    <label class="kt-checkbox">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        Se souvenir de moi
                                        <span></span>
                                    </label>
                                    <button id="kt_login_signin_submit"
                                            class="btn btn-primary btn-elevate kt-login__btn-primary">Se connecter
                                    </button>
                                </div>
                                <hr>
                                <div class="kt-login__actions">
                                    > <a href="/password/reset" class="btn btn-link btn-outline-primary">Mot de passe oublié ? </a>
                                </div>

                                <!--end::Action-->
                            </form>

                            <!--end::Form-->

                        </div>

                        <!--end::Signin-->
                    </div>

                    <!--end::Body-->
                </div>

                <!--end::Content-->
            </div>
        </div>
    </div>
    {{-- end:: Test Login page --}}
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/demo1/pages/login/login-general.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/general/jquery-validation/dist/localization/messages_fr.js') }}"
            type="text/javascript"></script>
@endsection