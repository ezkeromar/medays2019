@extends('layouts.app')

@section('template_title')
    {{ 'Profile Participant' }}
@endsection

@section('template_toolbar')
<a href="{{ URL('participant/22') }}" class="btn kt-subheader__btn-primary">< Retour</a>
@endsection

@section('content')
    <!--Begin:: Portlet-->
    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_2" role="tab">
                            <i class="flaticon2-calendar-3"></i> Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_apps_contacts_view_tab_3" role="tab">
                            <i class="flaticon2-user-outline-symbol"></i> Prestation
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_4" role="tab">
                            <i class="flaticon2-gear"></i> Delegation
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_4" role="tab">
                            <i class="flaticon2-gear"></i> Historique
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_apps_contacts_view_tab_1" role="tab">
                            <i class="flaticon2-note"></i> Commentaires
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="tab-content  kt-margin-t-20">

                <!--Begin:: Tab Content-->
                <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                <form method="POST" action="/participant/{{$participant->id}}/update" class="kt-form kt-form--label-right">
                            {!! csrf_field() !!}
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
                                                <select class="form-control kt-selectpicker kt-types-form" name="type_id">
                                                    @foreach($types as $key => $type)
                                                    <optgroup label="{{($key == 1) ? 'PARTICIPANTS' : ($key == 2) ? 'PRESSE - SPONSORS' : 'ORGANISATION'}}">
                                                    @foreach($type as $t)
                                                    <option value="{{$t->id}}" {{ ($participant->type_id == $t->id) ? "selected": "" }}>{{$t->name}}</option>
                                                    @endforeach
                                                    </optgroup>
                                                    @endforeach
                                                    </select>
                                                    <!-- data-niveau="true"  -->
                                                    <!-- {{ (old('type_id') == '4' || old('type_id') == '5') ? 'kt-hidden': '' }} -->
                                                </select>
                                            </div>
                                            @error('type')
                                                <div class="alert alert-danger formError">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group row kt-niveau">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Niveau :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select class="form-control kt-selectpicker" name="level">
                                                    <option value="">Choisir un niveau...</option>
                                                    <option value="1" {{ ($participant->level == "1") ? "selected": "" }}>Niveau 1</option>
                                                    <option value="2" {{ ($participant->level == "2") ? "selected": "" }}>Niveau 2</option>
                                                    <option value="3" {{ ($participant->level == "3") ? "selected": "" }}>Niveau 3</option>
                                                </select>
                                            </div>
                                            @error('level')
                                                <div class="alert alert-danger formError">{{ $message }}</div>
                                            @enderror
                                        </div>
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
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Civilit?? :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-radio-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="civility" value="1" {{ ($participant->civility == "1") ? "checked": "" }}> Madame
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="civility" value="2" {{ ($participant->civility == "2") ? "checked": "" }}> Monsieur
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('civility')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Pr??nom :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="first_name" id="" value='{{$participant->first_name}}'>
                                                    </div>
                                                    @error('first_name')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Nom :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="last_name" id="" value='{{$participant->last_name}}'>
                                                    </div>
                                                    @error('last_name')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Date de naissance :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="date" class="form-control" name="birthday" id="" value='{{$participant->birthday}}'
                                                        min="1901-01-01" max="2000-12-31"
                                                        >
                                                    </div>
                                                    @error('birthday')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Organisme :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="organization" id="" value='{{$participant->organization}}'>
                                                    </div>
                                                    @error('organization')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Fonction :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="function" id="" value='{{$participant->function}}'>
                                                    </div>
                                                    @error('function')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Nationalit?? :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="nationality" id="" value='{{$participant->nationality}}'>
                                                    </div>
                                                    @error('nationality')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Type d'identit?? :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-radio-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="identity_type" value="2" {{ ($participant->identity_type == "2") ? "checked": "" }}> Passport
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="identity_type" value="1" {{ ($participant->identity_type == "1") ? "checked": "" }}> CIN
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('identity_type')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Numero d'identit?? :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="num_identity" id="" value='{{$participant->num_identity}}'>
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
                                                        <h3 class="kt-section__title kt-section__title-sm">Coordonn??es professionnelles :</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Pays :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <select class="form-control kt-selectpicker" name="country" id="country">
                                                            <option value="">Choix du pays</option>
                                                            @foreach($countries as  $country)
                                                                @if(!empty($country))
                                                                    <option value="{{$country->code2}}" {{($country->code2 == $participant->country) ? 'selected' : ''}}>
                                                                        {{$country->namne_fr}}
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
                                                        <input type="text" class="form-control" name="city" id="" value='{{$participant->city}}'>
                                                    </div>
                                                    @error('city')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Email :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="mail" class="form-control" name="email" id="" value='{{$participant->email}}'>
                                                    </div>
                                                    @error('email')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">T??l??phone Professionel:</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="pro_phone" id="" value='{{$participant->pro_phone}}'>
                                                    </div>
                                                    @error('pro_phone')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">T??l??phone Mobile :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="mobile_phone" id="" value='{{$participant->mobile_phone}}'>
                                                    </div>
                                                    @error('mobile_phone')
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
                                                        <h3 class="kt-section__title kt-section__title-sm">SERVICES :</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Restauration :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <span class="kt-switch">
															<label>
																<input type="checkbox" name="has_restoration" {{ ($participant->has_restoration == 2) ? "checked": "" }}/>
																<span></span>
															</label>
														</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">H??b??rgement :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <span class="kt-switch">
															<label>
																<input type="checkbox" name="has_hebergement" {{ ($participant->has_hebergement == 2) ? "checked": "" }}/>
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
																<input type="checkbox" name="has_transfert" {{ ($participant->has_transfert == 2) ? "checked": "" }}/>
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
																<input type="checkbox" name="has_pec" {{ ($participant->has_pec == 2) ? "checked": "" }}/>
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
                                            <button type="submit" class="btn btn-brand btn-bold">Modifier</button>&nbsp;
                                            <a href="{{ URL('/participant/'.{{participant->id}}) }}" type="reset" class="btn btn-secondary kt-form-disable--cta">Annuler</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>

                <!--End:: Tab Content-->

                <!--Begin:: Tab Content-->
                <div class="tab-pane" id="kt_apps_contacts_view_tab_3" role="tabpanel">
                    <form class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="alert alert-solid-danger alert-bold fade show kt-margin-b-20" role="alert">
                                <div class="alert-icon"><i class="fa fa-exclamation-triangle"></i></div>
                                <div class="alert-text">Configure user passwords to expire periodically.
                                    <br>Users will need warning that their passwords are going to expire, or they might inadvertently get locked out of the system!</div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="la la-close"></i></span>
                                    </button>
                                </div>
                            </div>
                            <div class="kt-section">
                                <div class="kt-section__body">
                                    <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h3 class="kt-section__title kt-section__title-sm">Account:</h3>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Username</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="kt-spinner kt-spinner--sm kt-spinner--success kt-spinner--right kt-spinner--input">
                                                <input class="form-control" type="text" value="nick84">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                <input type="text" class="form-control" value="nick.watson@loop.com" placeholder="Email" aria-describedby="basic-addon1">
                                            </div>
                                            <span class="form-text text-muted">Email will not be publicly displayed. <a href="#" class="kt-link">Learn more</a>.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Language</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <select class="form-control">
                                                <option>Select Language...</option>
                                                <option value="id">Bahasa Indonesia - Indonesian</option>
                                                <option value="msa">Bahasa Melayu - Malay</option>
                                                <option value="ca">Catal?? - Catalan</option>
                                                <option value="cs">??e??tina - Czech</option>
                                                <option value="da">Dansk - Danish</option>
                                                <option value="de">Deutsch - German</option>
                                                <option value="en" selected="">English</option>
                                                <option value="en-gb">English UK - British English</option>
                                                <option value="es">Espa??ol - Spanish</option>
                                                <option value="eu">Euskara - Basque (beta)</option>
                                                <option value="fil">Filipino</option>
                                                <option value="fr">Fran??ais - French</option>
                                                <option value="ga">Gaeilge - Irish (beta)</option>
                                                <option value="gl">Galego - Galician (beta)</option>
                                                <option value="hr">Hrvatski - Croatian</option>
                                                <option value="it">Italiano - Italian</option>
                                                <option value="hu">Magyar - Hungarian</option>
                                                <option value="nl">Nederlands - Dutch</option>
                                                <option value="no">Norsk - Norwegian</option>
                                                <option value="pl">Polski - Polish</option>
                                                <option value="pt">Portugu??s - Portuguese</option>
                                                <option value="ro">Rom??n?? - Romanian</option>
                                                <option value="sk">Sloven??ina - Slovak</option>
                                                <option value="fi">Suomi - Finnish</option>
                                                <option value="sv">Svenska - Swedish</option>
                                                <option value="vi">Ti???ng Vi???t - Vietnamese</option>
                                                <option value="tr">T??rk??e - Turkish</option>
                                                <option value="el">???????????????? - Greek</option>
                                                <option value="bg">?????????????????? ???????? - Bulgarian</option>
                                                <option value="ru">?????????????? - Russian</option>
                                                <option value="sr">???????????? - Serbian</option>
                                                <option value="uk">???????????????????? ???????? - Ukrainian</option>
                                                <option value="he">???????????????? - Hebrew</option>
                                                <option value="ur">???????? - Urdu (beta)</option>
                                                <option value="ar">?????????????? - Arabic</option>
                                                <option value="fa">?????????? - Persian</option>
                                                <option value="mr">??????????????? - Marathi</option>
                                                <option value="hi">?????????????????? - Hindi</option>
                                                <option value="bn">??????????????? - Bangla</option>
                                                <option value="gu">????????????????????? - Gujarati</option>
                                                <option value="ta">??????????????? - Tamil</option>
                                                <option value="kn">??????????????? - Kannada</option>
                                                <option value="th">????????????????????? - Thai</option>
                                                <option value="ko">????????? - Korean</option>
                                                <option value="ja">????????? - Japanese</option>
                                                <option value="zh-cn">???????????? - Simplified Chinese</option>
                                                <option value="zh-tw">???????????? - Traditional Chinese</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Time Zone</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <select class="form-control">
                                                <option data-offset="-39600" value="International Date Line West">(GMT-11:00) International Date Line West</option>
                                                <option data-offset="-39600" value="Midway Island">(GMT-11:00) Midway Island</option>
                                                <option data-offset="-39600" value="Samoa">(GMT-11:00) Samoa</option>
                                                <option data-offset="-36000" value="Hawaii">(GMT-10:00) Hawaii</option>
                                                <option data-offset="-28800" value="Alaska">(GMT-08:00) Alaska</option>
                                                <option data-offset="-25200" value="Pacific Time (US &amp; Canada)">(GMT-07:00) Pacific Time (US &amp; Canada)</option>
                                                <option data-offset="-25200" value="Tijuana">(GMT-07:00) Tijuana</option>
                                                <option data-offset="-25200" value="Arizona">(GMT-07:00) Arizona</option>
                                                <option data-offset="-21600" value="Mountain Time (US &amp; Canada)">(GMT-06:00) Mountain Time (US &amp; Canada)</option>
                                                <option data-offset="-21600" value="Chihuahua">(GMT-06:00) Chihuahua</option>
                                                <option data-offset="-21600" value="Mazatlan">(GMT-06:00) Mazatlan</option>
                                                <option data-offset="-21600" value="Saskatchewan">(GMT-06:00) Saskatchewan</option>
                                                <option data-offset="-21600" value="Central America">(GMT-06:00) Central America</option>
                                                <option data-offset="-18000" value="Central Time (US &amp; Canada)">(GMT-05:00) Central Time (US &amp; Canada)</option>
                                                <option data-offset="-18000" value="Guadalajara">(GMT-05:00) Guadalajara</option>
                                                <option data-offset="-18000" value="Mexico City">(GMT-05:00) Mexico City</option>
                                                <option data-offset="-18000" value="Monterrey">(GMT-05:00) Monterrey</option>
                                                <option data-offset="-18000" value="Bogota">(GMT-05:00) Bogota</option>
                                                <option data-offset="-18000" value="Lima">(GMT-05:00) Lima</option>
                                                <option data-offset="-18000" value="Quito">(GMT-05:00) Quito</option>
                                                <option data-offset="-14400" value="Eastern Time (US &amp; Canada)">(GMT-04:00) Eastern Time (US &amp; Canada)</option>
                                                <option data-offset="-14400" value="Indiana (East)">(GMT-04:00) Indiana (East)</option>
                                                <option data-offset="-14400" value="Caracas">(GMT-04:00) Caracas</option>
                                                <option data-offset="-14400" value="La Paz">(GMT-04:00) La Paz</option>
                                                <option data-offset="-14400" value="Georgetown">(GMT-04:00) Georgetown</option>
                                                <option data-offset="-10800" value="Atlantic Time (Canada)">(GMT-03:00) Atlantic Time (Canada)</option>
                                                <option data-offset="-10800" value="Santiago">(GMT-03:00) Santiago</option>
                                                <option data-offset="-10800" value="Brasilia">(GMT-03:00) Brasilia</option>
                                                <option data-offset="-10800" value="Buenos Aires">(GMT-03:00) Buenos Aires</option>
                                                <option data-offset="-9000" value="Newfoundland">(GMT-02:30) Newfoundland</option>
                                                <option data-offset="-7200" value="Greenland">(GMT-02:00) Greenland</option>
                                                <option data-offset="-7200" value="Mid-Atlantic">(GMT-02:00) Mid-Atlantic</option>
                                                <option data-offset="-3600" value="Cape Verde Is.">(GMT-01:00) Cape Verde Is.</option>
                                                <option data-offset="0" value="Azores">(GMT) Azores</option>
                                                <option data-offset="0" value="Monrovia">(GMT) Monrovia</option>
                                                <option data-offset="0" value="UTC">(GMT) UTC</option>
                                                <option data-offset="3600" value="Dublin">(GMT+01:00) Dublin</option>
                                                <option data-offset="3600" value="Edinburgh">(GMT+01:00) Edinburgh</option>
                                                <option data-offset="3600" value="Lisbon">(GMT+01:00) Lisbon</option>
                                                <option data-offset="3600" value="London">(GMT+01:00) London</option>
                                                <option data-offset="3600" value="Casablanca">(GMT+01:00) Casablanca</option>
                                                <option data-offset="3600" value="West Central Africa">(GMT+01:00) West Central Africa</option>
                                                <option data-offset="7200" value="Belgrade">(GMT+02:00) Belgrade</option>
                                                <option data-offset="7200" value="Bratislava">(GMT+02:00) Bratislava</option>
                                                <option data-offset="7200" value="Budapest">(GMT+02:00) Budapest</option>
                                                <option data-offset="7200" value="Ljubljana">(GMT+02:00) Ljubljana</option>
                                                <option data-offset="7200" value="Prague">(GMT+02:00) Prague</option>
                                                <option data-offset="7200" value="Sarajevo">(GMT+02:00) Sarajevo</option>
                                                <option data-offset="7200" value="Skopje">(GMT+02:00) Skopje</option>
                                                <option data-offset="7200" value="Warsaw">(GMT+02:00) Warsaw</option>
                                                <option data-offset="7200" value="Zagreb">(GMT+02:00) Zagreb</option>
                                                <option data-offset="7200" value="Brussels">(GMT+02:00) Brussels</option>
                                                <option data-offset="7200" value="Copenhagen">(GMT+02:00) Copenhagen</option>
                                                <option data-offset="7200" value="Madrid">(GMT+02:00) Madrid</option>
                                                <option data-offset="7200" value="Paris">(GMT+02:00) Paris</option>
                                                <option data-offset="7200" value="Amsterdam">(GMT+02:00) Amsterdam</option>
                                                <option data-offset="7200" value="Berlin">(GMT+02:00) Berlin</option>
                                                <option data-offset="7200" value="Bern">(GMT+02:00) Bern</option>
                                                <option data-offset="7200" value="Rome">(GMT+02:00) Rome</option>
                                                <option data-offset="7200" value="Stockholm">(GMT+02:00) Stockholm</option>
                                                <option data-offset="7200" value="Vienna">(GMT+02:00) Vienna</option>
                                                <option data-offset="7200" value="Cairo">(GMT+02:00) Cairo</option>
                                                <option data-offset="7200" value="Harare">(GMT+02:00) Harare</option>
                                                <option data-offset="7200" value="Pretoria">(GMT+02:00) Pretoria</option>
                                                <option data-offset="10800" value="Bucharest">(GMT+03:00) Bucharest</option>
                                                <option data-offset="10800" value="Helsinki">(GMT+03:00) Helsinki</option>
                                                <option data-offset="10800" value="Kiev">(GMT+03:00) Kiev</option>
                                                <option data-offset="10800" value="Kyiv">(GMT+03:00) Kyiv</option>
                                                <option data-offset="10800" value="Riga">(GMT+03:00) Riga</option>
                                                <option data-offset="10800" value="Sofia">(GMT+03:00) Sofia</option>
                                                <option data-offset="10800" value="Tallinn">(GMT+03:00) Tallinn</option>
                                                <option data-offset="10800" value="Vilnius">(GMT+03:00) Vilnius</option>
                                                <option data-offset="10800" value="Athens">(GMT+03:00) Athens</option>
                                                <option data-offset="10800" value="Istanbul">(GMT+03:00) Istanbul</option>
                                                <option data-offset="10800" value="Minsk">(GMT+03:00) Minsk</option>
                                                <option data-offset="10800" value="Jerusalem">(GMT+03:00) Jerusalem</option>
                                                <option data-offset="10800" value="Moscow">(GMT+03:00) Moscow</option>
                                                <option data-offset="10800" value="St. Petersburg">(GMT+03:00) St. Petersburg</option>
                                                <option data-offset="10800" value="Volgograd">(GMT+03:00) Volgograd</option>
                                                <option data-offset="10800" value="Kuwait">(GMT+03:00) Kuwait</option>
                                                <option data-offset="10800" value="Riyadh">(GMT+03:00) Riyadh</option>
                                                <option data-offset="10800" value="Nairobi">(GMT+03:00) Nairobi</option>
                                                <option data-offset="10800" value="Baghdad">(GMT+03:00) Baghdad</option>
                                                <option data-offset="14400" value="Abu Dhabi">(GMT+04:00) Abu Dhabi</option>
                                                <option data-offset="14400" value="Muscat">(GMT+04:00) Muscat</option>
                                                <option data-offset="14400" value="Baku">(GMT+04:00) Baku</option>
                                                <option data-offset="14400" value="Tbilisi">(GMT+04:00) Tbilisi</option>
                                                <option data-offset="14400" value="Yerevan">(GMT+04:00) Yerevan</option>
                                                <option data-offset="16200" value="Tehran">(GMT+04:30) Tehran</option>
                                                <option data-offset="16200" value="Kabul">(GMT+04:30) Kabul</option>
                                                <option data-offset="18000" value="Ekaterinburg">(GMT+05:00) Ekaterinburg</option>
                                                <option data-offset="18000" value="Islamabad">(GMT+05:00) Islamabad</option>
                                                <option data-offset="18000" value="Karachi">(GMT+05:00) Karachi</option>
                                                <option data-offset="18000" value="Tashkent">(GMT+05:00) Tashkent</option>
                                                <option data-offset="19800" value="Chennai">(GMT+05:30) Chennai</option>
                                                <option data-offset="19800" value="Kolkata">(GMT+05:30) Kolkata</option>
                                                <option data-offset="19800" value="Mumbai">(GMT+05:30) Mumbai</option>
                                                <option data-offset="19800" value="New Delhi">(GMT+05:30) New Delhi</option>
                                                <option data-offset="19800" value="Sri Jayawardenepura">(GMT+05:30) Sri Jayawardenepura</option>
                                                <option data-offset="20700" value="Kathmandu">(GMT+05:45) Kathmandu</option>
                                                <option data-offset="21600" value="Astana">(GMT+06:00) Astana</option>
                                                <option data-offset="21600" value="Dhaka">(GMT+06:00) Dhaka</option>
                                                <option data-offset="21600" value="Almaty">(GMT+06:00) Almaty</option>
                                                <option data-offset="21600" value="Urumqi">(GMT+06:00) Urumqi</option>
                                                <option data-offset="23400" value="Rangoon">(GMT+06:30) Rangoon</option>
                                                <option data-offset="25200" value="Novosibirsk">(GMT+07:00) Novosibirsk</option>
                                                <option data-offset="25200" value="Bangkok">(GMT+07:00) Bangkok</option>
                                                <option data-offset="25200" value="Hanoi">(GMT+07:00) Hanoi</option>
                                                <option data-offset="25200" value="Jakarta">(GMT+07:00) Jakarta</option>
                                                <option data-offset="25200" value="Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                                                <option data-offset="28800" value="Beijing">(GMT+08:00) Beijing</option>
                                                <option data-offset="28800" value="Chongqing">(GMT+08:00) Chongqing</option>
                                                <option data-offset="28800" value="Hong Kong">(GMT+08:00) Hong Kong</option>
                                                <option data-offset="28800" value="Kuala Lumpur">(GMT+08:00) Kuala Lumpur</option>
                                                <option data-offset="28800" value="Singapore">(GMT+08:00) Singapore</option>
                                                <option data-offset="28800" value="Taipei">(GMT+08:00) Taipei</option>
                                                <option data-offset="28800" value="Perth">(GMT+08:00) Perth</option>
                                                <option data-offset="28800" value="Irkutsk">(GMT+08:00) Irkutsk</option>
                                                <option data-offset="28800" value="Ulaan Bataar">(GMT+08:00) Ulaan Bataar</option>
                                                <option data-offset="32400" value="Seoul">(GMT+09:00) Seoul</option>
                                                <option data-offset="32400" value="Osaka">(GMT+09:00) Osaka</option>
                                                <option data-offset="32400" value="Sapporo">(GMT+09:00) Sapporo</option>
                                                <option data-offset="32400" value="Tokyo">(GMT+09:00) Tokyo</option>
                                                <option data-offset="32400" value="Yakutsk">(GMT+09:00) Yakutsk</option>
                                                <option data-offset="34200" value="Darwin">(GMT+09:30) Darwin</option>
                                                <option data-offset="34200" value="Adelaide">(GMT+09:30) Adelaide</option>
                                                <option data-offset="36000" value="Canberra">(GMT+10:00) Canberra</option>
                                                <option data-offset="36000" value="Melbourne">(GMT+10:00) Melbourne</option>
                                                <option data-offset="36000" value="Sydney">(GMT+10:00) Sydney</option>
                                                <option data-offset="36000" value="Brisbane">(GMT+10:00) Brisbane</option>
                                                <option data-offset="36000" value="Hobart">(GMT+10:00) Hobart</option>
                                                <option data-offset="36000" value="Vladivostok">(GMT+10:00) Vladivostok</option>
                                                <option data-offset="36000" value="Guam">(GMT+10:00) Guam</option>
                                                <option data-offset="36000" value="Port Moresby">(GMT+10:00) Port Moresby</option>
                                                <option data-offset="36000" value="Solomon Is.">(GMT+10:00) Solomon Is.</option>
                                                <option data-offset="39600" value="Magadan">(GMT+11:00) Magadan</option>
                                                <option data-offset="39600" value="New Caledonia">(GMT+11:00) New Caledonia</option>
                                                <option data-offset="43200" value="Fiji">(GMT+12:00) Fiji</option>
                                                <option data-offset="43200" value="Kamchatka">(GMT+12:00) Kamchatka</option>
                                                <option data-offset="43200" value="Marshall Is.">(GMT+12:00) Marshall Is.</option>
                                                <option data-offset="43200" value="Auckland">(GMT+12:00) Auckland</option>
                                                <option data-offset="43200" value="Wellington">(GMT+12:00) Wellington</option>
                                                <option data-offset="46800" value="Nuku'alofa">(GMT+13:00) Nuku'alofa</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-last row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Communication</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="kt-checkbox-inline">
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" checked=""> Email
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" checked=""> SMS
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox"> Phone
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h3 class="kt-section__title kt-section__title-sm">Security:</h3>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Login verification</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <button type="button" class="btn btn-label-brand btn-bold btn-sm kt-margin-t-5 kt-margin-b-5">Setup login verification</button>
                                            <span class="form-text text-muted">
                                                After you log in, you will be asked for additional information to confirm your identity and protect your account from being compromised.
                                                <a href="#" class="kt-link">Learn more</a>.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Password reset verification</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="kt-checkbox-single">
                                                <label class="kt-checkbox">
                                                    <input type="checkbox"> Require personal information to reset your password.
                                                    <span></span>
                                                </label>
                                            </div>
                                            <span class="form-text text-muted">
                                                For extra security, this requires you to confirm your email or phone number when you reset your password.
                                                <a href="#" class="kt-link">Learn more</a>.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row kt-margin-t-10 kt-margin-b-10">
                                        <label class="col-xl-3 col-lg-3 col-form-label"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <button type="button" class="btn btn-label-danger btn-bold btn-sm kt-margin-t-5 kt-margin-b-5">Deactivate your account ?</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-xl-3"></div>
                                <div class="col-lg-9 col-xl-6">
                                    <a href="#" class="btn btn-brand btn-bold">Save changes</a>
                                    <a href="#" class="btn btn-clean btn-bold">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!--End:: Tab Content-->

                <!--Begin:: Tab Content-->
                <div class="tab-pane" id="kt_apps_contacts_view_tab_4" role="tabpanel">
                    <form class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h3 class="kt-section__title kt-section__title-sm">Setup Email Notification:</h3>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Email Notification</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <span class="kt-switch">
                                                <label>
                                                    <input type="checkbox" checked="checked" name="email_notification_1">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-last row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Send Copy To Personal Email</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <span class="kt-switch">
                                                <label>
                                                    <input type="checkbox" name="email_notification_2">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h3 class="kt-section__title kt-section__title-sm">Activity Related Emails:</h3>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">When To Email</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="kt-checkbox-list">
                                                <label class="kt-checkbox">
                                                    <input type="checkbox"> You have new notifications.
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox"> You're sent a direct message
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" checked="checked"> Someone adds you as a connection
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-last row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">When To Escalate Emails</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="kt-checkbox-list">
                                                <label class="kt-checkbox kt-checkbox--brand">
                                                    <input type="checkbox"> Upon new order.
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox kt-checkbox--brand">
                                                    <input type="checkbox"> New membership approval
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox kt-checkbox--brand">
                                                    <input type="checkbox" checked="checked"> Member registration
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h3 class="kt-section__title kt-section__title-sm">Updates From Keenthemes:</h3>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Email You With</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="kt-checkbox-list">
                                                <label class="kt-checkbox">
                                                    <input type="checkbox"> News about Metronic product and feature updates
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox"> Tips on getting more out of Keen
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" checked="checked"> Things you missed since you last logged into Keen
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" checked="checked"> News about Metronic on partner products and other services
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" checked="checked"> Tips on Metronic business products
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-xl-3"></div>
                                <div class="col-lg-9 col-xl-6">
                                    <a href="#" class="btn btn-label-brand btn-bold">Save changes</a>
                                    <a href="#" class="btn btn-clean btn-bold">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!--End:: Tab Content-->

                <!--Begin:: Tab Content-->
                <div class="tab-pane " id="kt_apps_contacts_view_tab_1" role="tabpanel">

                    <!--Begin:: Tab Content-->
                    <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                        <form class="kt-form kt-form--label-right" action="">
                            <div class="kt-form__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Project Info:</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Project Name</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" type="text" value="Nick">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Project Owner</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" type="text" value="Bold">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Customer Name</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" type="text" value="Loop Inc.">
                                                <span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Contact Info:</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                    <input type="text" class="form-control" value="+35278953712" placeholder="Phone" aria-describedby="basic-addon1">
                                                </div>
                                                <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                    <input type="text" class="form-control" value="nick.bold@loop.com" placeholder="Email" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-last row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Company Site</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Username" value="loop">
                                                    <div class="input-group-append"><span class="input-group-text">.com</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-xl-3"></div>
                                    <div class="col-lg-9 col-xl-6">
                                        <a href="#" class="btn btn-brand btn-bold">Save changes</a>
                                        <a href="#" class="btn btn-clean btn-bold">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!--End:: Tab Content-->

                    <!--Begin:: Tab Content-->
                    <div class="tab-pane" id="kt_apps_contacts_view_tab_3" role="tabpanel">
                        <form class="kt-form kt-form--label-right">
                            <div class="kt-form__body">
                                <div class="alert alert-solid-danger alert-bold fade show kt-margin-b-20" role="alert">
                                    <div class="alert-icon"><i class="fa fa-exclamation-triangle"></i></div>
                                    <div class="alert-text">Configure user passwords to expire periodically.
                                        <br>Users will need warning that their passwords are going to expire, or they might inadvertently get locked out of the system!</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="kt-section">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Account:</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Username</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="kt-spinner kt-spinner--sm kt-spinner--success kt-spinner--right kt-spinner--input">
                                                    <input class="form-control" type="text" value="nick84">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                    <input type="text" class="form-control" value="nick.watson@loop.com" placeholder="Email" aria-describedby="basic-addon1">
                                                </div>
                                                <span class="form-text text-muted">Email will not be publicly displayed. <a href="#" class="kt-link">Learn more</a>.</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Language</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select class="form-control">
                                                    <option>Select Language...</option>
                                                    <option value="id">Bahasa Indonesia - Indonesian</option>
                                                    <option value="msa">Bahasa Melayu - Malay</option>
                                                    <option value="ca">Catal?? - Catalan</option>
                                                    <option value="cs">??e??tina - Czech</option>
                                                    <option value="da">Dansk - Danish</option>
                                                    <option value="de">Deutsch - German</option>
                                                    <option value="en" selected="">English</option>
                                                    <option value="en-gb">English UK - British English</option>
                                                    <option value="es">Espa??ol - Spanish</option>
                                                    <option value="eu">Euskara - Basque (beta)</option>
                                                    <option value="fil">Filipino</option>
                                                    <option value="fr">Fran??ais - French</option>
                                                    <option value="ga">Gaeilge - Irish (beta)</option>
                                                    <option value="gl">Galego - Galician (beta)</option>
                                                    <option value="hr">Hrvatski - Croatian</option>
                                                    <option value="it">Italiano - Italian</option>
                                                    <option value="hu">Magyar - Hungarian</option>
                                                    <option value="nl">Nederlands - Dutch</option>
                                                    <option value="no">Norsk - Norwegian</option>
                                                    <option value="pl">Polski - Polish</option>
                                                    <option value="pt">Portugu??s - Portuguese</option>
                                                    <option value="ro">Rom??n?? - Romanian</option>
                                                    <option value="sk">Sloven??ina - Slovak</option>
                                                    <option value="fi">Suomi - Finnish</option>
                                                    <option value="sv">Svenska - Swedish</option>
                                                    <option value="vi">Ti???ng Vi???t - Vietnamese</option>
                                                    <option value="tr">T??rk??e - Turkish</option>
                                                    <option value="el">???????????????? - Greek</option>
                                                    <option value="bg">?????????????????? ???????? - Bulgarian</option>
                                                    <option value="ru">?????????????? - Russian</option>
                                                    <option value="sr">???????????? - Serbian</option>
                                                    <option value="uk">???????????????????? ???????? - Ukrainian</option>
                                                    <option value="he">???????????????? - Hebrew</option>
                                                    <option value="ur">???????? - Urdu (beta)</option>
                                                    <option value="ar">?????????????? - Arabic</option>
                                                    <option value="fa">?????????? - Persian</option>
                                                    <option value="mr">??????????????? - Marathi</option>
                                                    <option value="hi">?????????????????? - Hindi</option>
                                                    <option value="bn">??????????????? - Bangla</option>
                                                    <option value="gu">????????????????????? - Gujarati</option>
                                                    <option value="ta">??????????????? - Tamil</option>
                                                    <option value="kn">??????????????? - Kannada</option>
                                                    <option value="th">????????????????????? - Thai</option>
                                                    <option value="ko">????????? - Korean</option>
                                                    <option value="ja">????????? - Japanese</option>
                                                    <option value="zh-cn">???????????? - Simplified Chinese</option>
                                                    <option value="zh-tw">???????????? - Traditional Chinese</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Time Zone</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select class="form-control">
                                                    <option data-offset="-39600" value="International Date Line West">(GMT-11:00) International Date Line West</option>
                                                    <option data-offset="-39600" value="Midway Island">(GMT-11:00) Midway Island</option>
                                                    <option data-offset="-39600" value="Samoa">(GMT-11:00) Samoa</option>
                                                    <option data-offset="-36000" value="Hawaii">(GMT-10:00) Hawaii</option>
                                                    <option data-offset="-28800" value="Alaska">(GMT-08:00) Alaska</option>
                                                    <option data-offset="-25200" value="Pacific Time (US &amp; Canada)">(GMT-07:00) Pacific Time (US &amp; Canada)</option>
                                                    <option data-offset="-25200" value="Tijuana">(GMT-07:00) Tijuana</option>
                                                    <option data-offset="-25200" value="Arizona">(GMT-07:00) Arizona</option>
                                                    <option data-offset="-21600" value="Mountain Time (US &amp; Canada)">(GMT-06:00) Mountain Time (US &amp; Canada)</option>
                                                    <option data-offset="-21600" value="Chihuahua">(GMT-06:00) Chihuahua</option>
                                                    <option data-offset="-21600" value="Mazatlan">(GMT-06:00) Mazatlan</option>
                                                    <option data-offset="-21600" value="Saskatchewan">(GMT-06:00) Saskatchewan</option>
                                                    <option data-offset="-21600" value="Central America">(GMT-06:00) Central America</option>
                                                    <option data-offset="-18000" value="Central Time (US &amp; Canada)">(GMT-05:00) Central Time (US &amp; Canada)</option>
                                                    <option data-offset="-18000" value="Guadalajara">(GMT-05:00) Guadalajara</option>
                                                    <option data-offset="-18000" value="Mexico City">(GMT-05:00) Mexico City</option>
                                                    <option data-offset="-18000" value="Monterrey">(GMT-05:00) Monterrey</option>
                                                    <option data-offset="-18000" value="Bogota">(GMT-05:00) Bogota</option>
                                                    <option data-offset="-18000" value="Lima">(GMT-05:00) Lima</option>
                                                    <option data-offset="-18000" value="Quito">(GMT-05:00) Quito</option>
                                                    <option data-offset="-14400" value="Eastern Time (US &amp; Canada)">(GMT-04:00) Eastern Time (US &amp; Canada)</option>
                                                    <option data-offset="-14400" value="Indiana (East)">(GMT-04:00) Indiana (East)</option>
                                                    <option data-offset="-14400" value="Caracas">(GMT-04:00) Caracas</option>
                                                    <option data-offset="-14400" value="La Paz">(GMT-04:00) La Paz</option>
                                                    <option data-offset="-14400" value="Georgetown">(GMT-04:00) Georgetown</option>
                                                    <option data-offset="-10800" value="Atlantic Time (Canada)">(GMT-03:00) Atlantic Time (Canada)</option>
                                                    <option data-offset="-10800" value="Santiago">(GMT-03:00) Santiago</option>
                                                    <option data-offset="-10800" value="Brasilia">(GMT-03:00) Brasilia</option>
                                                    <option data-offset="-10800" value="Buenos Aires">(GMT-03:00) Buenos Aires</option>
                                                    <option data-offset="-9000" value="Newfoundland">(GMT-02:30) Newfoundland</option>
                                                    <option data-offset="-7200" value="Greenland">(GMT-02:00) Greenland</option>
                                                    <option data-offset="-7200" value="Mid-Atlantic">(GMT-02:00) Mid-Atlantic</option>
                                                    <option data-offset="-3600" value="Cape Verde Is.">(GMT-01:00) Cape Verde Is.</option>
                                                    <option data-offset="0" value="Azores">(GMT) Azores</option>
                                                    <option data-offset="0" value="Monrovia">(GMT) Monrovia</option>
                                                    <option data-offset="0" value="UTC">(GMT) UTC</option>
                                                    <option data-offset="3600" value="Dublin">(GMT+01:00) Dublin</option>
                                                    <option data-offset="3600" value="Edinburgh">(GMT+01:00) Edinburgh</option>
                                                    <option data-offset="3600" value="Lisbon">(GMT+01:00) Lisbon</option>
                                                    <option data-offset="3600" value="London">(GMT+01:00) London</option>
                                                    <option data-offset="3600" value="Casablanca">(GMT+01:00) Casablanca</option>
                                                    <option data-offset="3600" value="West Central Africa">(GMT+01:00) West Central Africa</option>
                                                    <option data-offset="7200" value="Belgrade">(GMT+02:00) Belgrade</option>
                                                    <option data-offset="7200" value="Bratislava">(GMT+02:00) Bratislava</option>
                                                    <option data-offset="7200" value="Budapest">(GMT+02:00) Budapest</option>
                                                    <option data-offset="7200" value="Ljubljana">(GMT+02:00) Ljubljana</option>
                                                    <option data-offset="7200" value="Prague">(GMT+02:00) Prague</option>
                                                    <option data-offset="7200" value="Sarajevo">(GMT+02:00) Sarajevo</option>
                                                    <option data-offset="7200" value="Skopje">(GMT+02:00) Skopje</option>
                                                    <option data-offset="7200" value="Warsaw">(GMT+02:00) Warsaw</option>
                                                    <option data-offset="7200" value="Zagreb">(GMT+02:00) Zagreb</option>
                                                    <option data-offset="7200" value="Brussels">(GMT+02:00) Brussels</option>
                                                    <option data-offset="7200" value="Copenhagen">(GMT+02:00) Copenhagen</option>
                                                    <option data-offset="7200" value="Madrid">(GMT+02:00) Madrid</option>
                                                    <option data-offset="7200" value="Paris">(GMT+02:00) Paris</option>
                                                    <option data-offset="7200" value="Amsterdam">(GMT+02:00) Amsterdam</option>
                                                    <option data-offset="7200" value="Berlin">(GMT+02:00) Berlin</option>
                                                    <option data-offset="7200" value="Bern">(GMT+02:00) Bern</option>
                                                    <option data-offset="7200" value="Rome">(GMT+02:00) Rome</option>
                                                    <option data-offset="7200" value="Stockholm">(GMT+02:00) Stockholm</option>
                                                    <option data-offset="7200" value="Vienna">(GMT+02:00) Vienna</option>
                                                    <option data-offset="7200" value="Cairo">(GMT+02:00) Cairo</option>
                                                    <option data-offset="7200" value="Harare">(GMT+02:00) Harare</option>
                                                    <option data-offset="7200" value="Pretoria">(GMT+02:00) Pretoria</option>
                                                    <option data-offset="10800" value="Bucharest">(GMT+03:00) Bucharest</option>
                                                    <option data-offset="10800" value="Helsinki">(GMT+03:00) Helsinki</option>
                                                    <option data-offset="10800" value="Kiev">(GMT+03:00) Kiev</option>
                                                    <option data-offset="10800" value="Kyiv">(GMT+03:00) Kyiv</option>
                                                    <option data-offset="10800" value="Riga">(GMT+03:00) Riga</option>
                                                    <option data-offset="10800" value="Sofia">(GMT+03:00) Sofia</option>
                                                    <option data-offset="10800" value="Tallinn">(GMT+03:00) Tallinn</option>
                                                    <option data-offset="10800" value="Vilnius">(GMT+03:00) Vilnius</option>
                                                    <option data-offset="10800" value="Athens">(GMT+03:00) Athens</option>
                                                    <option data-offset="10800" value="Istanbul">(GMT+03:00) Istanbul</option>
                                                    <option data-offset="10800" value="Minsk">(GMT+03:00) Minsk</option>
                                                    <option data-offset="10800" value="Jerusalem">(GMT+03:00) Jerusalem</option>
                                                    <option data-offset="10800" value="Moscow">(GMT+03:00) Moscow</option>
                                                    <option data-offset="10800" value="St. Petersburg">(GMT+03:00) St. Petersburg</option>
                                                    <option data-offset="10800" value="Volgograd">(GMT+03:00) Volgograd</option>
                                                    <option data-offset="10800" value="Kuwait">(GMT+03:00) Kuwait</option>
                                                    <option data-offset="10800" value="Riyadh">(GMT+03:00) Riyadh</option>
                                                    <option data-offset="10800" value="Nairobi">(GMT+03:00) Nairobi</option>
                                                    <option data-offset="10800" value="Baghdad">(GMT+03:00) Baghdad</option>
                                                    <option data-offset="14400" value="Abu Dhabi">(GMT+04:00) Abu Dhabi</option>
                                                    <option data-offset="14400" value="Muscat">(GMT+04:00) Muscat</option>
                                                    <option data-offset="14400" value="Baku">(GMT+04:00) Baku</option>
                                                    <option data-offset="14400" value="Tbilisi">(GMT+04:00) Tbilisi</option>
                                                    <option data-offset="14400" value="Yerevan">(GMT+04:00) Yerevan</option>
                                                    <option data-offset="16200" value="Tehran">(GMT+04:30) Tehran</option>
                                                    <option data-offset="16200" value="Kabul">(GMT+04:30) Kabul</option>
                                                    <option data-offset="18000" value="Ekaterinburg">(GMT+05:00) Ekaterinburg</option>
                                                    <option data-offset="18000" value="Islamabad">(GMT+05:00) Islamabad</option>
                                                    <option data-offset="18000" value="Karachi">(GMT+05:00) Karachi</option>
                                                    <option data-offset="18000" value="Tashkent">(GMT+05:00) Tashkent</option>
                                                    <option data-offset="19800" value="Chennai">(GMT+05:30) Chennai</option>
                                                    <option data-offset="19800" value="Kolkata">(GMT+05:30) Kolkata</option>
                                                    <option data-offset="19800" value="Mumbai">(GMT+05:30) Mumbai</option>
                                                    <option data-offset="19800" value="New Delhi">(GMT+05:30) New Delhi</option>
                                                    <option data-offset="19800" value="Sri Jayawardenepura">(GMT+05:30) Sri Jayawardenepura</option>
                                                    <option data-offset="20700" value="Kathmandu">(GMT+05:45) Kathmandu</option>
                                                    <option data-offset="21600" value="Astana">(GMT+06:00) Astana</option>
                                                    <option data-offset="21600" value="Dhaka">(GMT+06:00) Dhaka</option>
                                                    <option data-offset="21600" value="Almaty">(GMT+06:00) Almaty</option>
                                                    <option data-offset="21600" value="Urumqi">(GMT+06:00) Urumqi</option>
                                                    <option data-offset="23400" value="Rangoon">(GMT+06:30) Rangoon</option>
                                                    <option data-offset="25200" value="Novosibirsk">(GMT+07:00) Novosibirsk</option>
                                                    <option data-offset="25200" value="Bangkok">(GMT+07:00) Bangkok</option>
                                                    <option data-offset="25200" value="Hanoi">(GMT+07:00) Hanoi</option>
                                                    <option data-offset="25200" value="Jakarta">(GMT+07:00) Jakarta</option>
                                                    <option data-offset="25200" value="Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                                                    <option data-offset="28800" value="Beijing">(GMT+08:00) Beijing</option>
                                                    <option data-offset="28800" value="Chongqing">(GMT+08:00) Chongqing</option>
                                                    <option data-offset="28800" value="Hong Kong">(GMT+08:00) Hong Kong</option>
                                                    <option data-offset="28800" value="Kuala Lumpur">(GMT+08:00) Kuala Lumpur</option>
                                                    <option data-offset="28800" value="Singapore">(GMT+08:00) Singapore</option>
                                                    <option data-offset="28800" value="Taipei">(GMT+08:00) Taipei</option>
                                                    <option data-offset="28800" value="Perth">(GMT+08:00) Perth</option>
                                                    <option data-offset="28800" value="Irkutsk">(GMT+08:00) Irkutsk</option>
                                                    <option data-offset="28800" value="Ulaan Bataar">(GMT+08:00) Ulaan Bataar</option>
                                                    <option data-offset="32400" value="Seoul">(GMT+09:00) Seoul</option>
                                                    <option data-offset="32400" value="Osaka">(GMT+09:00) Osaka</option>
                                                    <option data-offset="32400" value="Sapporo">(GMT+09:00) Sapporo</option>
                                                    <option data-offset="32400" value="Tokyo">(GMT+09:00) Tokyo</option>
                                                    <option data-offset="32400" value="Yakutsk">(GMT+09:00) Yakutsk</option>
                                                    <option data-offset="34200" value="Darwin">(GMT+09:30) Darwin</option>
                                                    <option data-offset="34200" value="Adelaide">(GMT+09:30) Adelaide</option>
                                                    <option data-offset="36000" value="Canberra">(GMT+10:00) Canberra</option>
                                                    <option data-offset="36000" value="Melbourne">(GMT+10:00) Melbourne</option>
                                                    <option data-offset="36000" value="Sydney">(GMT+10:00) Sydney</option>
                                                    <option data-offset="36000" value="Brisbane">(GMT+10:00) Brisbane</option>
                                                    <option data-offset="36000" value="Hobart">(GMT+10:00) Hobart</option>
                                                    <option data-offset="36000" value="Vladivostok">(GMT+10:00) Vladivostok</option>
                                                    <option data-offset="36000" value="Guam">(GMT+10:00) Guam</option>
                                                    <option data-offset="36000" value="Port Moresby">(GMT+10:00) Port Moresby</option>
                                                    <option data-offset="36000" value="Solomon Is.">(GMT+10:00) Solomon Is.</option>
                                                    <option data-offset="39600" value="Magadan">(GMT+11:00) Magadan</option>
                                                    <option data-offset="39600" value="New Caledonia">(GMT+11:00) New Caledonia</option>
                                                    <option data-offset="43200" value="Fiji">(GMT+12:00) Fiji</option>
                                                    <option data-offset="43200" value="Kamchatka">(GMT+12:00) Kamchatka</option>
                                                    <option data-offset="43200" value="Marshall Is.">(GMT+12:00) Marshall Is.</option>
                                                    <option data-offset="43200" value="Auckland">(GMT+12:00) Auckland</option>
                                                    <option data-offset="43200" value="Wellington">(GMT+12:00) Wellington</option>
                                                    <option data-offset="46800" value="Nuku'alofa">(GMT+13:00) Nuku'alofa</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-last row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Communication</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="kt-checkbox-inline">
                                                    <label class="kt-checkbox">
                                                        <input type="checkbox" checked=""> Email
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox">
                                                        <input type="checkbox" checked=""> SMS
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox">
                                                        <input type="checkbox"> Phone
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Security:</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Login verification</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <button type="button" class="btn btn-label-brand btn-bold btn-sm kt-margin-t-5 kt-margin-b-5">Setup login verification</button>
                                                <span class="form-text text-muted">
                                                    After you log in, you will be asked for additional information to confirm your identity and protect your account from being compromised.
                                                    <a href="#" class="kt-link">Learn more</a>.
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Password reset verification</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="kt-checkbox-single">
                                                    <label class="kt-checkbox">
                                                        <input type="checkbox"> Require personal information to reset your password.
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <span class="form-text text-muted">
                                                    For extra security, this requires you to confirm your email or phone number when you reset your password.
                                                    <a href="#" class="kt-link">Learn more</a>.
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group row kt-margin-t-10 kt-margin-b-10">
                                            <label class="col-xl-3 col-lg-3 col-form-label"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <button type="button" class="btn btn-label-danger btn-bold btn-sm kt-margin-t-5 kt-margin-b-5">Deactivate your account ?</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-xl-3"></div>
                                    <div class="col-lg-9 col-xl-6">
                                        <a href="#" class="btn btn-brand btn-bold">Save changes</a>
                                        <a href="#" class="btn btn-clean btn-bold">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!--End:: Tab Content-->

                    <!--Begin:: Tab Content-->
                    <div class="tab-pane" id="kt_apps_contacts_view_tab_4" role="tabpanel">
                        <form class="kt-form kt-form--label-right">
                            <div class="kt-form__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Setup Email Notification:</h3>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Email Notification</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <span class="kt-switch">
                                                    <label>
                                                        <input type="checkbox" checked="checked" name="email_notification_1">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-last row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Send Copy To Personal Email</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <span class="kt-switch">
                                                    <label>
                                                        <input type="checkbox" name="email_notification_2">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Activity Related Emails:</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">When To Email</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox">
                                                        <input type="checkbox"> You have new notifications.
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox">
                                                        <input type="checkbox"> You're sent a direct message
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox">
                                                        <input type="checkbox" checked="checked"> Someone adds you as a connection
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-last row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">When To Escalate Emails</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox--brand">
                                                        <input type="checkbox"> Upon new order.
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox kt-checkbox--brand">
                                                        <input type="checkbox"> New membership approval
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox kt-checkbox--brand">
                                                        <input type="checkbox" checked="checked"> Member registration
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Updates From Keenthemes:</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Email You With</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox">
                                                        <input type="checkbox"> News about Metronic product and feature updates
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox">
                                                        <input type="checkbox"> Tips on getting more out of Keen
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox">
                                                        <input type="checkbox" checked="checked"> Things you missed since you last logged into Keen
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox">
                                                        <input type="checkbox" checked="checked"> News about Metronic on partner products and other services
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox">
                                                        <input type="checkbox" checked="checked"> Tips on Metronic business products
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-xl-3"></div>
                                    <div class="col-lg-9 col-xl-6">
                                        <a href="#" class="btn btn-label-brand btn-bold">Save changes</a>
                                        <a href="#" class="btn btn-clean btn-bold">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!--End:: Tab Content-->

                    <!--Begin:: Tab Content-->
                    <div class="tab-pane " id="kt_apps_contacts_view_tab_1" role="tabpanel">
                        <div class="kt-container">
                            <form>
                                <div class="form-group">
                                    <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Type notes"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <a href="#" class="btn btn-label-brand btn-bold">Add notes</a>
                                        <a href="#" class="btn btn-clean btn-bold">Cancel</a>
                                    </div>
                                </div>
                            </form>
                            <div class="kt-separator kt-separator--space-lg kt-separator--border-dashed"></div>
                            <div class="kt-notes kt-scroll kt-scroll--pull" data-scroll="true" style="height: 500px;">
                                <div class="kt-notes__items">
                                    <div class="kt-notes__item">
                                        <div class="kt-notes__media">
                                            <img class="kt-hidden-" src="./assets/media/users/100_3.jpg" alt="image">
                                            <span class="kt-notes__icon kt-font-boldest kt-hidden">
                                                <i class="flaticon2-cup"></i>
                                            </span>
                                            <h3 class="kt-notes__user kt-font-boldest kt-hidden">
                                                N S
                                            </h3>
                                        </div>
                                        <div class="kt-notes__content">
                                            <div class="kt-notes__section">
                                                <div class="kt-notes__info">
                                                    <a href="#" class="kt-notes__title">
                                                        New order
                                                    </a>
                                                    <span class="kt-notes__desc">
                                                        9:30AM 16 June, 2015
                                                    </span>
                                                    <span class="kt-badge kt-badge--success kt-badge--inline">new</span>
                                                </div>
                                                <div class="kt-notes__dropdown">
                                                    <a href="#" class="btn btn-sm btn-icon-md btn-icon" data-toggle="dropdown">
                                                        <i class="flaticon-more-1 kt-font-brand"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="kt-notes__body">
                                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-notes__item">
                                        <div class="kt-notes__media">
                                            <span class="kt-notes__icon">
                                                <i class="flaticon2-rocket kt-font-danger"></i>
                                            </span>
                                        </div>
                                        <div class="kt-notes__content">
                                            <div class="kt-notes__section">
                                                <div class="kt-notes__info">
                                                    <a href="#" class="kt-notes__title">
                                                        Notification
                                                    </a>
                                                    <span class="kt-notes__desc">
                                                        10:30AM 23 May, 2013
                                                    </span>
                                                </div>
                                                <div class="kt-notes__dropdown">
                                                    <a href="#" class="btn btn-sm btn-icon-md btn-icon" data-toggle="dropdown">
                                                        <i class="flaticon2-rectangular kt-font-brand"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="kt-notes__body">
                                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-notes__item">
                                        <div class="kt-notes__media">
                                            <h3 class="kt-notes__user kt-font-brand kt-font-boldest">
                                                DS
                                            </h3>
                                        </div>
                                        <div class="kt-notes__content">
                                            <div class="kt-notes__section">
                                                <div class="kt-notes__info">
                                                    <a href="#" class="kt-notes__title">
                                                        System alert
                                                    </a>
                                                    <span class="kt-notes__desc">
                                                        7:10AM 21 February, 2016
                                                    </span>
                                                </div>
                                                <div class="kt-notes__dropdown">
                                                    <a href="#" class="btn btn-sm btn-icon-md btn-icon" data-toggle="dropdown">
                                                        <i class="flaticon2-note kt-font-brand"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="kt-notes__body">
                                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-notes__item">
                                        <div class="kt-notes__media">
                                            <span class="kt-notes__icon">
                                                <i class="flaticon2-poll-symbol kt-font-success"></i>
                                            </span>
                                        </div>
                                        <div class="kt-notes__content">
                                            <div class="kt-notes__section">
                                                <div class="kt-notes__info">
                                                    <a href="#" class="kt-notes__title">
                                                        New order
                                                    </a>
                                                    <span class="kt-notes__desc">
                                                        10:30AM 23 May, 2013
                                                    </span>
                                                </div>
                                                <div class="kt-notes__dropdown">
                                                    <a href="#" class="btn btn-sm btn-icon-md btn-icon" data-toggle="dropdown">
                                                        <i class="flaticon2-gear kt-font-brand"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="kt-notes__body">
                                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-notes__item">
                                        <div class="kt-notes__media">
                                            <span class="kt-notes__icon">
                                                <i class="flaticon2-box-1 kt-font-brand"></i>
                                            </span>
                                        </div>
                                        <div class="kt-notes__content">
                                            <div class="kt-notes__section">
                                                <div class="kt-notes__info">
                                                    <a href="#" class="kt-notes__title">
                                                        Notification
                                                    </a>
                                                    <span class="kt-notes__desc">
                                                        10:30AM 23 May, 2013
                                                    </span>
                                                </div>
                                                <div class="kt-notes__dropdown">
                                                    <a href="#" class="btn btn-sm btn-icon-md btn-icon" data-toggle="dropdown">
                                                        <i class="flaticon2-sort kt-font-brand"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="kt-notes__body">
                                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-notes__item">
                                        <div class="kt-notes__media">
                                            <span class="kt-notes__icon">
                                                <i class="flaticon2-rocket kt-font-danger"></i>
                                            </span>
                                        </div>
                                        <div class="kt-notes__content">
                                            <div class="kt-notes__section">
                                                <div class="kt-notes__info">
                                                    <a href="#" class="kt-notes__title">
                                                        Notification
                                                    </a>
                                                    <span class="kt-notes__desc">
                                                        10:30AM 23 May, 2013
                                                    </span>
                                                </div>
                                                <div class="kt-notes__dropdown">
                                                    <a href="#" class="btn btn-sm btn-icon-md btn-icon" data-toggle="dropdown">
                                                        <i class="flaticon2-rectangular kt-font-brand"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                    <span class="kt-nav__link-text">Reports</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                    <span class="kt-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                    <span class="kt-nav__link-text">Charts</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                    <span class="kt-nav__link-text">Members</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="kt-notes__body">
                                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-notes__item kt-notes__item--clean">
                                        <div class="kt-notes__media">
                                            <img class="kt-hidden" src="./assets/media/users/100_1.jpg" alt="image">
                                            <span class="kt-notes__icon kt-font-boldest kt-hidden">
                                                <i class="flaticon2-cup"></i>
                                            </span>
                                            <h3 class="kt-notes__user kt-font-boldest kt-hidden">
                                                M E
                                            </h3>
                                            <span class="kt-notes__circle kt-hidden-"></span>
                                        </div>
                                        <div class="kt-notes__content">
                                            <div class="kt-notes__section">
                                                <div class="kt-notes__info">
                                                    <a href="#" class="kt-notes__title">
                                                        Order
                                                    </a>
                                                    <span class="kt-notes__desc">
                                                        11:40AM 14 March, 2012
                                                    </span>
                                                    <span class="kt-badge kt-badge--danger kt-badge--inline">important</span>
                                                </div>
                                            </div>
                                            <span class="kt-notes__body">
                                                Sed ut sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-notes__item kt-notes__item--clean">
                                        <div class="kt-notes__media">
                                            <img class="kt-hidden" src="./assets/media/users/100_1.jpg" alt="image">
                                            <span class="kt-notes__icon kt-font-boldest kt-hidden">
                                                <i class="flaticon2-cup"></i>
                                            </span>
                                            <h3 class="kt-notes__user kt-font-boldest kt-hidden">
                                                N B
                                            </h3>
                                            <span class="kt-notes__circle kt-hidden-"></span>
                                        </div>
                                        <div class="kt-notes__content">
                                            <div class="kt-notes__section">
                                                <div class="kt-notes__info">
                                                    <a href="#" class="kt-notes__title">
                                                        Remarks
                                                    </a>
                                                    <span class="kt-notes__desc">
                                                        10:30AM 23 April, 2013
                                                    </span>
                                                </div>
                                            </div>
                                            <span class="kt-notes__body">
                                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--End:: Tab Content-->
                </div>
            </div>
        </div>

        <!--End:: Portlet-->
    </div>
    <!-- end:: Content -->
@endsection

@section('footer_scripts')
    <script src="./assets/js/demo1/pages/crud/metronic-datatable/base/html-table.js" type="text/javascript"></script>
@endsection
