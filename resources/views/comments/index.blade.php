@extends('layouts.app')

@section('template_title')
    {{ 'Commentaires' }}
@endsection

@section('content')
    <!--Begin:: Portlet-->
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">Commentaires: nombre total {{count($comments)}}</h3>
                            </div>
                        </div>
                        <div class="kt-form kt-form--label-right">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="kt-separator kt-separator--space-lg kt-separator--border-dashed"></div>
                                        <div class="kt-notes kt-scroll kt-scroll--pull" data-scroll="true" style="height: 500px;">
                                            <div class="kt-notes__items">
                                            @foreach($comments as $comment)
                                                <div class="kt-notes__item">
                                                    <div class="kt-notes__media">
                                                        <span class="kt-notes__icon">
                                                            <img src="{!! $comment->user->avatar_url !!}" height="50px">
                                                        </span>
                                                    </div>
                                                    <div class="kt-notes__content">
                                                        <div class="kt-notes__section">
                                                            <div class="kt-notes__info">
                                                                <a href="#" class="kt-notes__title">
                                                                    {{$comment->user->first_name}} {{$comment->user->last_name}}
                                                                </a>
                                                                <span class="kt-notes__desc">
                                                                    {{ Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:i') }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <span class="kt-notes__body">
                                                            {{$comment->content}}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
