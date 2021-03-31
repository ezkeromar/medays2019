@extends('layouts.app')

@section('template_title')
    {{ 'Profile Participant' }}
@endsection

@section('content')
    <!--Begin:: Portlet-->
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
        <!--Begin:: App Aside Mobile Toggle-->
        <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
            <i class="la la-close"></i>
        </button>
        <!--End:: App Aside Mobile Toggle-->

        @include('partials.participants.side')

        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">Historique</h3>
                            </div>
                        </div>
                        <form class="kt-form kt-form--label-right">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="kt-timeline-v3">
                                            <div class="kt-timeline-v3__items">
                                            @foreach($actions as $action)
                                                <div class="kt-timeline-v3__item kt-timeline-v3__item--info">
                                                    <span class="kt-timeline-v3__item-time">{{ Carbon\Carbon::parse($action->created_at)->format('d/m/Y H:i') }}</span>
                                                    <div class="kt-timeline-v3__item-desc">
                                                        <span class="kt-timeline-v3__item-text">
                                                            {!!$action->title!!}
                                                        </span><br>
                                                        <span class="kt-timeline-v3__item-user-name">
                                                            <a href="#" class="kt-link kt-link--dark kt-timeline-v3__item-link">
                                                            @if(!empty($action->user))
                                                                par {{$action->user->first_name}} {{$action->user->last_name}}
                                                            @else
                                                                ...
                                                            @endif
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End:: App Content-->
    </div>
    <!--End:: Portlet-->
@endsection

@section('footer_scripts')

@endsection
