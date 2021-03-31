@extends('layouts.app')

@section('template_title')
    {{ 'Profile Participant' }}
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
                                    Ajouter un participant
                                </h3>
                            </div>
                        </div>
                        <form method="POST" action="/add/participant" class="kt-form kt-form--label-right">
                            {!! csrf_field() !!}
                            <input type='hidden' value="{{ app('request')->input('ref') }}" name="ref" />
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Type de participant :</h3>
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
                                                    @if($t->name != 'Conjoint' && $t->name != 'Délégation')
                                                    <option value="{{$t->id}}" {{ ($t->id == 4 || $t->id == 5) ? 'data-niveau="true"': "" }} {{ (old("type_id") == $t->id) ? "selected": "" }}>{{$t->name}}</option>
                                                    @endif
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
                                        @if(empty(app('request')->input('ref')))
                                        <div class="form-group row kt-niveau {{ (old('type_id') != '4' && old('type_id') != '5') ? 'kt-hidden': '' }}">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Niveau :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select class="form-control kt-selectpicker" name="level">
                                                    <option value="">Choisir un niveau...</option>
                                                    <option value="1" {{ (old("level") == "1") ? "selected": "selected" }}>Niveau 1</option>
                                                    <option value="2" {{ (old("level") == "2") ? "selected": "" }}>Niveau 2</option>
                                                    <option value="3" {{ (old("level") == "3") ? "selected": "" }}>Niveau 3</option>
                                                </select>
                                            </div>
                                            @error('level')
                                                <div class="alert alert-danger formError">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @endif
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                        <div class="kt-section" style="width: 100%">
                                            <div class="kt-section__body">
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">Informations personnelles :</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Langue :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-radio-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="language" value="fr" {{ (old("language") == "fr") ? "checked": "" }}> Français
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="language" value="en" {{ (old("language") == "en") ? "checked": "" }}> Anglais
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('language')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Civilité :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-radio-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="civility" value="1" {{ (old("civility") == "1") ? "checked": "" }}> Madame
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="civility" value="2" {{ (old("civility") == "2") ? "checked": "" }}> Monsieur
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('civility')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Prénom :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="first_name" id="" value='{{old("first_name")}}'>
                                                    </div>
                                                    @error('first_name')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Nom :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="last_name" id="" value='{{old("last_name")}}'>
                                                    </div>
                                                    @error('last_name')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Date de naissance :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input 
                                                        class="form-control dateField" 
                                                        value="{{old("birthday")}}" 
                                                        name="birthday" 
                                                        type="text" 
                                                        maxlength="10" 
                                                        alt="" 
                                                        id="birthdate"/> 
                                                    </div>
                                                    @error('birthday')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Organisme :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="organization" id="" value='{{old("organization")}}'>
                                                    </div>
                                                    @error('organization')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Fonction :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="function" id="" value='{{old("function")}}'>
                                                    </div>
                                                    @error('function')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Pays de nationalité :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <select class="form-control countrySelect" name="nationality" id="nationality">
                                                            <option value="">Choix du pays</option>
                                                            @foreach($countries as $country)
                                                                @if(!empty($country))
                                                                    <option value="{{$country->code2}}" {{($country->code2 == old('nationality')) ? 'selected="selected"' : ''}}>
                                                                        {{ $country->name_fr }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('nationality')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Type d'identité :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-radio-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="identity_type" value="2" {{ (old("identity_type") == "2") ? "checked": "" }}> Passport
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="identity_type" value="1" {{ (old("identity_type") == "1") ? "checked": "" }}> CIN
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('identity_type')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Numero d'identité :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="num_identity" id="" value='{{old("num_identity")}}'>
                                                    </div>
                                                    @error('num_identity')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                        <div class="kt-section" style="width: 100%">
                                            <div class="kt-section__body">
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">Coordonnées professionnelles :</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Pays de résidence :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <select class="form-control countrySelect" name="country" id="country">
                                                            <option value="">Choix du pays</option>
                                                            @foreach($countries as $country)
                                                                @if(!empty($country))
                                                                    <option value="{{$country->code2}}" {{($country->code2 == old('country')) ? 'selected="selected"' : ''}}>
                                                                        {{ $country->name_fr }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('country')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Ville :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="city" id="" value='{{old("city")}}'>
                                                    </div>
                                                    @error('city')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Email :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="mail" class="form-control" name="email" id="" value='{{old("email")}}'>
                                                    </div>
                                                    @error('email')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Téléphone Professionel:</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="pro_phone" id="" value='{{old("pro_phone")}}'>
                                                    </div>
                                                    @error('pro_phone')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Téléphone Mobile :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="mobile_phone" id="" value='{{old("mobile_phone")}}'>
                                                    </div>
                                                    @error('mobile_phone')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg" style="display: none"></div>
                                        <div class="kt-section" style="width: 100%; display: none">
                                            <div class="kt-section__body">
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">SERVICES :</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Restauration :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <span class="kt-switch">
															<label>
																<input type="checkbox" name="has_restoration" {{ (old("has_restoration") == true) ? "checked": "" }}/>
																<span></span>
															</label>
														</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Hébérgement :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <span class="kt-switch">
															<label>
																<input type="checkbox" name="has_hebergement" {{ (old("has_hebergement") == true) ? "checked": "" }}/>
																<span></span>
															</label>
														</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Transfert :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <span class="kt-switch">
															<label>
																<input type="checkbox" name="has_transfert" {{ (old("has_transfert") == true) ? "checked": "" }}/>
																<span></span>
															</label>
														</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">PEC:</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <span class="kt-switch">
															<label>
																<input type="checkbox" name="has_pec" {{ (old("has_pec") == true) ? "checked": "" }}/>
																<span></span>
															</label>
														</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">FORMATION:</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <span class="kt-switch">
															<label>
																<input type="checkbox" name="has_formation" {{ (old("has_formation") == true) ? "checked": "" }}/>
																<span></span>
															</label>
														</span>
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
                                            <button type="submit" class="btn btn-brand btn-bold">Ajouter</button>&nbsp;
                                            <a href="{{ URL('/participants') }}" type="reset" class="btn btn-secondary kt-form-disable--cta">Annuler</a>
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
    <script src="{{ asset('assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts.custom.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/moment.min.js"></script>
    <script>

            if ($.trim($('input[name=birthday]').val()) != ""){
                $('#birthdate').attr('value', moment($('#birthdate').val(), 'YYYY-MM-DD').format("DD/MM/YYYY"))
            }
            $("input[name=birthday]").inputmask("datetime", {
                inputFormat: "dd/mm/yyyy",
                outputFormat: "dd/mm/yyyy",
                inputEventOnly: true
            });
    </script>
@endsection
