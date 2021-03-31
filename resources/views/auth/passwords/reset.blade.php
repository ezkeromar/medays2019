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
                                <h3>réinitialiser le mot de passe</h3>
                            </div>
                            <hr>
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.request') }}" class="kt-form">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group row">

                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ $email or old('email') }}" required autofocus
                                           placeholder="Email">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required placeholder="Mot de passe">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <input id="password-confirm" type="password"
                                           class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                           name="password_confirmation" required placeholder="Confirmer Mot de passe">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="kt-login__actions">
                                    <label></label>
                                    <button type="submit" class="btn btn-primary">
                                        Réinitialiser le mot de passe
                                    </button>
                                </div>
                                <hr>
                                <div class="kt-login__actions">
                                    ><a href="/login" class="btn btn-link btn-outline-primary"> S'identifier </a>
                                </div>
                            </form>

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