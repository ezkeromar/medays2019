@extends('layouts.app')

@section('template_title')
    {!! trans('usersmanagement.editing-user', ['name' => $user->name]) !!}
@endsection

@section('template_linked_css')
    <style type="text/css">
        .btn-save,
        .pw-change-container {
            display: none;
        }
    </style>
@endsection

@section('content')
    <!--Begin:: App Content-->
    <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
        <div class="row">
            <div class="col-xl-12">
                <!--begin:: Widgets/Order Statistics-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                {!! trans('usersmanagement.editing-user', ['name' => $user->name]) !!}
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="flaticon-more-1"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(761px, 46px, 0px);">
                                <ul class="kt-nav">
                                    <li class="kt-nav__item">
                                        <a href="{{ route('users') }}" class="kt-nav__link">
                                            <i class="kt-nav__link-icon fa fa-fw fa-reply-all"></i>
                                            <span class="kt-nav__link-text">{!! trans('usersmanagement.buttons.back-to-users') !!}</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon fa fa-fw fa-reply"></i>
                                            <span class="kt-nav__link-text">{!! trans('usersmanagement.buttons.back-to-user') !!}</span>
                                        </a>
                                    </li>
                                </ul>
                                <!--end::Nav-->
                            </div>
                        </div>
                    </div>
                    {!! Form::open(array('route' => ['users.update', $user->id], 'method' => 'PUT','enctype' => 'multipart/form-data', 'role' => 'form', 'class' => 'kt-form kt-form--label-right')) !!}
                    {!! csrf_field() !!}
                        <div class="kt-portlet__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="kt-section" style="width: 100%">
                                        <div class="kt-section__body">
                                            <div class="form-group has-feedback row {{ $errors->has('avatar') ? ' has-error text-danger ' : '' }}">
                                                {!! Form::label('Avatar', 'Avatar', array('class' => 'col-md-3 control-label')); !!}
                                                <div class="col-md-5">
                                                    <div class="input-group">
                                                        {!! Form::file('avatar', null, array('id' => 'avatar', 'class' => 'form-control')) !!}
                                                        <div class="input-group-append">
                                                            <label for="avatar" class="input-group-text">
                                                                <i class="fa fa-image" aria-hidden="true"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('avatar'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('avatar') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-md-2 float-left">
                                                    <img src="{{ $user->avatar_url }}" height="60px">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                {!! Form::label('name', trans('forms.create_user_label_username'), array('class' => 'col-xl-3 col-lg-3 col-form-label')); !!}
                                                <div class="col-lg-9 col-xl-6">
                                                    {!! Form::text('name', $user->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_username'))) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                {!! Form::label('first_name', trans('forms.create_user_label_firstname'), array('class' => 'col-xl-3 col-lg-3 col-form-label')); !!}
                                                <div class="col-lg-9 col-xl-6">
                                                    {!! Form::text('first_name', $user->first_name, array('id' => 'first_name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_firstname'))) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                {!! Form::label('last_name', trans('forms.create_user_label_lastname'), array('class' => 'col-xl-3 col-lg-3 col-form-label')); !!}
                                                <div class="col-lg-9 col-xl-6">
                                                    {!! Form::text('last_name', $user->last_name, array('id' => 'last_name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_lastname'))) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                {!! Form::label('email', trans('forms.create_user_label_email'), array('class' => 'col-xl-3 col-lg-3 col-form-label')); !!}
                                                <div class="col-lg-9 col-xl-6">
                                                    {!! Form::text('email', $user->email, array('id' => 'email', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_email'))) !!}
                                                </div>
                                            </div>
                                            <div class="form-group has-feedback row {{ $errors->has('role') ? ' has-error text-danger ' : '' }}">
                                                {!! Form::label('role', trans('forms.create_user_label_role'), array('class' => 'col-md-3 control-label')); !!}
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group">
                                                        <select class="custom-select form-control" name="role"
                                                                id="role">
                                                            @foreach($roles as $role)
                                                                <option value="{{ $role->id }}"
                                                                        {!! ($user->hasRole($role->id) ? 'selected="selected"' : '') !!}>
                                                                    {{ $role->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="input-group-append">
                                                            <label class="input-group-text" for="role">
                                                                <i class="{{ trans('forms.create_user_icon_role') }}"
                                                                   aria-hidden="true"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('role'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('role') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group has-feedback row {{ $errors->has('permissions') ? ' has-error text-danger ' : '' }}">
                                                {!! Form::label('permissions', 'Permissions', array('class' => 'col-md-3 control-label')); !!}
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group">
                                                        @foreach($permissions as $permission)
                                                            <div class="form-check col-6">
                                                                <input type="checkbox" {!! ($user->hasPermission($permission->id) ? 'checked="checked"' : '') !!}
                                                                       class="form-check-input" id="{{$permission->id}}" name="permissions[]" value="{{$permission->id}}">
                                                                <label class="form-check-label" for="{{$permission->id}}">{{ $permission->name }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    @if ($errors->has('permissions'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('permissions') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                {!! Form::label('password', trans('forms.create_user_label_password'), array('class' => 'col-xl-3 col-lg-3 col-form-label')); !!}
                                                <div class="col-lg-9 col-xl-6">
                                                    {!! Form::password('password', array('id' => 'password', 'class' => 'form-control ', 'placeholder' => trans('forms.create_user_ph_password'))) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                {!! Form::label('password_confirmation', trans('forms.create_user_label_pw_confirmation'), array('class' => 'col-xl-3 col-lg-3 col-form-label')); !!}
                                                <div class="col-lg-9 col-xl-6">
                                                    {!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_pw_confirmation'))) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-3 col-xl-3">
                                    </div>
                                    <div class="col-lg-9 col-xl-9">
                                        {!! Form::button(trans('forms.save-changes'), array(
                                            'class'        => 'btn btn-brand btn-bold',
                                            'type'         => 'button',
                                            'data-toggle'  => 'modal',
                                            'data-target'  => '#confirmSave',
                                            'data-title'   => trans('modals.edit_user__modal_text_confirm_title'),
                                            'data-message' => trans('modals.edit_user__modal_text_confirm_message')
                                            ))
                                        !!}
                                        <button type="reset" class="btn btn-secondary kt-form-disable--cta">Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                <!--end:: Widgets/Order Statistics-->
            </div>
        </div>
    </div>
    <!--End:: App Content-->

    @include('modals.modal-save')
    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
  @include('scripts.check-changed')
@endsection
