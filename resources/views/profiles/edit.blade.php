@extends('layouts.app')

@section('template_title')
    {{ trans('profile.templateTitle') }}
@endsection

@section('template_linked_css')
{{-- <link href="./assets/css/demo1/pages/wizard/wizard-4.css" rel="stylesheet" type="text/css" /> --}}
@endsection

@section('content')
    @if ($user->profile)
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
                                    <img class="kt-widget__img kt-hidden-" src="{{ $user->avatar_url }}" alt="image" id="profile-image-left">
                                    <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light kt-hidden">
                                        PR
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
                                <a href="{{ url('/profile/'.Auth::user()->name.'/edit') }}" class="kt-widget__item kt-widget__item--active">
                                    Mes informations
                                </a>
                                <a href="{{ url('/profile/role-permissions') }}" class="kt-widget__item">
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
                                        {{ trans('profile.editAccountTitle') }}
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <button class="btn btn-label-primary btn-sm btn-icon-h kt-form--enable">
                                        Modifier
                                    </button>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <div class="col-xl-12 col-lg-12 col-form-label">
                                                <div class="dz-preview"></div>
                                                {!! Form::open(array('route' => 'avatar.upload', 'method' => 'POST', 'name' => 'avatarDropzone','id' => 'avatarDropzone', 'class' => 'form single-dropzone dropzone single', 'files' => true)) !!}
                                                    <img id="user_selected_avatar" class="user-avatar" src="{{ $user->avatar_url  }}" alt="{{ $user->name }}">
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                        {!! Form::model($user, array('action' => array('ProfilesController@updateUserAccount', $user->id), 'method' => 'PUT',
                                        'id' => 'user_basics_form', 'class' => 'kt-form kt-form--label-right kt-form--disable')) !!}
                                            {!! csrf_field() !!}
                                        <div class="form-group row">
                                            {!! Form::label('name', trans('forms.create_user_label_username'), array('class' => 'col-xl-3 col-lg-3 col-form-label')); !!}
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group">
                                                    {!! Form::text('name', $user->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_username'))) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {!! Form::label('email', trans('forms.create_user_label_email'), array('class' => 'col-xl-3 col-lg-3 col-form-label')); !!}
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group">
                                                    {!! Form::text('email', $user->email, array('id' => 'email', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_email'))) !!}
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {!! Form::label('first_name', trans('forms.create_user_label_firstname'), array('class' => 'col-xl-3 col-lg-3 col-form-label')); !!}
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group">
                                                    {!! Form::text('first_name', $user->first_name, array('id' => 'first_name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_firstname'))) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {!! Form::label('last_name', trans('forms.create_user_label_lastname'), array('class' => 'col-xl-3 col-lg-3 col-form-label')); !!}
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group">
                                                    {!! Form::text('last_name', $user->last_name, array('id' => 'last_name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_lastname'))) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot kt-form-action--disable">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-3 col-xl-3">
                                        </div>
                                        <div class="col-lg-9 col-xl-9">
                                            {!! Form::button(
                                                trans('profile.submitButton'),
                                                array(
                                                    'class'    => 'btn btn-brand btn-bold',
                                                    'id'       => 'update-password',
                                                    'disabled' => false,
                                                    'type'     => 'submit'
                                            )) !!}
                                            <button type="reset" class="btn btn-secondary kt-form-disable--cta">Annuler</button>
                                        </div>
                                        {!! Form::close() !!}
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
    @endif
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/scripts.custom.js') }}" type="text/javascript"></script>
    @include('scripts.user-avatar-dz')
@endsection
