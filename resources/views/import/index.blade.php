@extends('layouts.app')

@section('template_title')
    {{ 'Importer Participants' }}
@endsection

@section('template_toolbar')
    <div class="kt-subheader__group" id="kt_subheader_group_actions">
        <!-- <div class="btn-toolbar kt-margin-l-20">
            <button class="btn btn-label-success btn-bold btn-sm btn-icon-h" id="kt_sweetalert_demo_6">
                Valider
            </button>
            <button class="btn btn-label-danger btn-bold btn-sm btn-icon-h" id="kt_sweetalert_demo_8">
                Refuser
            </button>
        </div> -->
    </div>
@endsection

@section('content')
    <!--Begin:: Portlet-->
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
        <!--Begin:: App Aside Mobile Toggle-->
        <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
            <i class="la la-close"></i>
        </button>
        <!--End:: App Aside Mobile Toggle-->

        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    <!--begin:: Widgets/Order Statistics-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Importer Participants
                                </h3>
                            </div>
                        </div>
                        <form method="POST" action="import" class="kt-form kt-form--label-right" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="kt-portlet__body">
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Fichier Excel</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="custom-file">
                                            <input type="file" name="file" class="custom-file-input" id="file" accept=".xlsx, .xls, .csv">
                                            <label class="custom-file-label" for="file" style="text-align: left;">Choisir
                                                un fichier (excel)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Type :</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <select class="form-control kt-selectpicker kt-types-form" name="type">
                                            @if(empty(app('request')->input('ref')))
                                                @foreach($types as $key => $type)
                                                    <optgroup label="{{($key == 1) ? 'PARTICIPANTS' : (($key == 2) ? 'PRESSE - SPONSORS' : 'ORGANISATION')}}">
                                                        @foreach($type as $t)
                                                            <option value="{{$t->id}}" {{ ($t->id == 4 || $t->id == 5) ? 'data-niveau="true"': "" }} {{ (old("type_id") == $t->id) ? "selected": "" }}>{{$t->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            @else
                                                @foreach($types as $key => $type)
                                                    @if($key == 1)
                                                        <optgroup label="PARTICIPANTS">
                                                            @foreach($type as $t)
                                                                @if($t->name == 'Conjoint' || $t->name == 'Délégation')
                                                                    <option value="{{$t->id}}" {{ ($t->id == 4 || $t->id == 5) ? 'data-niveau="true"': "" }} {{ (old("type_id") == $t->id || $t->name == 'Délégation') ? "selected": "" }}>{{$t->name}}</option>
                                                                @endif
                                                            @endforeach
                                                        </optgroup>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        </select>
                                    </div>
                                    @error('type')
                                    <div class="alert alert-danger formError">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-3 col-xl-3">
                                        </div>
                                        <div class="col-lg-9 col-xl-9">
                                            <button type="submit" class="btn btn-brand btn-bold">Importer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--end:: Widgets/Order Statistics-->
                </div>
            </div>
        </div>
        <!--End:: App Content-->
    </div>
    <!--End:: Portlet-->
@endsection

@section('footer_scripts')
@endsection
