@extends('layouts.app')

@section('template_title')
    {{ 'Profile Participant' }}
@endsection

@section('template_toolbar')
    <div class="kt-subheader__group" id="kt_subheader_group_actions">
        <div class="btn-toolbar kt-margin-l-20">

            @if( (in_array($participant->type_id,[2,4,8,6,3,9])))
                <button data-url="/participant/{{$participant->id}}/15" data-action="Envoyer invidation"
                        class=" DataTableVUrl btn btn-label-brand btn-bold btn-sm btn-icon-h" id="UpdateUnblockBlock">
                    <i class="la la-edit"></i> Envoyer invitation
                </button>
            @endif

            <button data-url="/participant/{{$participant->id}}/1" data-action="Valider" class="DataTableVUrl btn btn-label-success btn-bold btn-sm btn-icon-h" id="kt_sweetalert_demo_6">
                <i class="la la-check-circle"></i> Valider
            </button>
            <button data-url="/participant/{{$participant->id}}/2" data-action="Refuser" class="DataTableVUrl btn btn-label-danger btn-bold btn-sm btn-icon-h" id="kt_sweetalert_demo_8">
                <i class="la la-minus-circle"></i> Refuser
            </button>

            @if(auth()->user()->hasRole('admin') || auth()->user()->hasPermission('upgrade'))
                <button class="btn btn-label-primary btn-bold btn-sm btn-icon-h" data-toggle="modal" data-target="#kt_modal_6">
                    <i class="la la-thumbs-o-up"></i> Upgrader
                </button>
            @endif
            <button data-url="/participant/{{$participant->id}}/4" data-action="Livrer le Badge" class="DataTableVUrl btn btn-label-info btn-bold btn-sm btn-icon-h" id="kt_sweetalert_demo_8">
                <i class="la la-credit-card"></i> Livrer le Badge
            </button>
            <button class="btn btn-label-brand btn-bold btn-sm btn-icon-h" id="UpdateUnblockBlock">
                <i class="la la-edit"></i> Modifier
            </button>
            <button data-url="/participant/{{$participant->id}}/6" data-action="Désactiver" class="DataTableVUrl btn btn-label-danger btn-bold btn-sm btn-icon-h" id="kt_sweetalert_demo_8">
                    <i class="la la-close"></i> Désactiver
            </button>
            @if(auth()->user()->hasRole('admin') || auth()->user()->hasPermission('delete'))
                <button data-url="/participant/{{$participant->id}}/99" data-action="Supprimer" class="DataTableVUrl btn btn-label-danger btn-bold btn-sm btn-icon-h" id="kt_sweetalert_demo_8">
                    <i class="la la-trash"></i> Supprimer
                </button>
            @endif
        </div>
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

        @include('partials.participants.side')

        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    <!--begin:: Widgets/Order Statistics-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Fiche participant
                                </h3>
                            </div>
                            <!-- <div class="kt-portlet__head-toolbar">
                                <button class="btn btn-label-primary btn-sm btn-icon-h kt-form--enable">
                                    Modifier
                                </button>
                            </div> -->
                        </div>
                        <form method="POST" action="/participant/{{$participant->id}}/update" class="kt-form kt-form--label-right">
                            {!! csrf_field() !!}
                            <input type='hidden' value="{{$participant->id}}" id="partcipantIdField" />
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div id="UpdateUnblockBlockSection" class="updateBlockDiv"></div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Langue :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="kt-radio-inline">
                                                    <label class="kt-radio">
                                                        <input type="radio" name="language" value="fr" {{ ($participant->language == "fr") ? "checked": "" }}> Français
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-radio">
                                                        <input type="radio" name="language" value="en" {{ ($participant->language == "en") ? "checked": "" }}> Anglais
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            @error('language')
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
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Civilité :</label>
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
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Prénom :</label>
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
                                                            <input 
                                                            class="form-control dateField" 
                                                            value="{{(!empty($participant->birthday)) ? $participant->birthday : ''}}" 
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
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Pays de nationalité :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <select class="form-control countrySelect" name="nationality">
                                                            <option value="">Choix du pays</option>
                                                            @foreach($countries as  $country)
                                                                @if(!empty($country))
                                                                    <option value="{{$country->code2}}" {{($country->code2 == $participant->nationality) ? 'selected' : ''}}>
                                                                        {{$country->name_fr}}
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
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Numero d'identité :</label>
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
                                        @if($participant->type_id == 7)
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-section__body">
                                                    <div class="row">
                                                        <label class="col-xl-3"></label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <h3 class="kt-section__title kt-section__title-sm">Press :</h3>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-group-last row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Carte :</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            @if(!empty($participant->press_cart))
                                                                <a class='kt-widget4__number kt-font-info' style="z-index: 1000000 !important; position: absolute;" href="{{$participant->press_cart}}" target="_blank">Clicker pour voir la carte</a>
                                                            @endif
                                                            <div class="custom-file" style="margin-top: 22px !important;">
                                                                <input type="file" name="press_cart" class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile" style="text-align: left;">Choisir un fichier (PDF, JPG, JPEG, PNG) | max 6mo</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg">
                                            </div>
                                        @endif
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
                                                        <select class="form-control countrySelect" name="country">
                                                            <option value="">Choix du pays</option>
                                                            @foreach($countries as $country)
                                                                @if(!empty($country))
                                                                    <option value="{{$country->code2}}" {{($country->code2 == $participant->country) ? 'selected="selected"' : ''}}>
                                                                        {{$country->name_fr}}
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
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Téléphone Professionel:</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="pro_phone" id="" value='{{$participant->pro_phone}}'>
                                                    </div>
                                                    @error('pro_phone')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Téléphone Mobile :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="mobile_phone" id="" value='{{$participant->mobile_phone}}'>
                                                    </div>
                                                    @error('mobile_phone')
                                                        <div class="alert alert-danger formError">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Motivation :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <textarea class="form-control" name="motivation" id="" rows="{{strlen($participant->motivation)/50}}">{{$participant->motivation}}</textarea>
                                                    </div>
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
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Hébérgement :</label>
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
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">FORMATION:</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <span class="kt-switch">
															<label>
																<input type="checkbox" name="has_formation" {{ ($participant->has_formation == 2) ? "checked": "" }}/>
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
                                        <div id='actionsBtNS' class="col-lg-9 col-xl-9 hideActions">
                                            <button type="submit" class="btn btn-brand btn-bold">Enregistrer</button>&nbsp;
                                            <a href="{{ URL('/participant/'.$participant->id) }}" type="reset" class="btn btn-secondary kt-form-disable--cta">Annuler</a>
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

    <div class="modal fade" id="kt_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upgrader ce participant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Type actuel :</label>
                        <div class="col-lg-9">
                            <select class="form-control kt-selectpicker" readonly="readonly" disabled>
                                @foreach($types as $key => $type)
                                    @if(count($type) > 0)
                                        <optgroup label="{{($key == 1) ? 'PARTICIPANTS' : (($key == 2) ? 'PRESSE - SPONSORS' : 'ORGANISATION')}}">
                                            @foreach($type as $t)
                                                <option value="{{$t->id}}" {{($participant->type_id == $t->id) ? 'selected' : ''}}>{{$t->name}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-bottom: 0.3rem;">
                        <label class="col-lg-3 col-form-label">Upgrader vers :</label>
                        <div class="col-lg-9">
                        <select id="nextLevel" class="form-control kt-selectpicker" onchange="changeType()">
                            @foreach($types as $key => $type)
                                @if(count($type) > 0)
                                    <optgroup label="{{($key == 1) ? 'PARTICIPANTS' : (($key == 2) ? 'PRESSE - SPONSORS' : 'ORGANISATION')}}">
                                        @foreach($type as $t)
                                            <option value="{{$t->id}}" {{($participant->type_id == $t->id) ? 'selected' : ''}}>{{$t->name}}</option>
                                        @endforeach
                                    </optgroup>
                                @endif
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row kt-niveau  {{ $participant->type_id == "4" ? "" : "kt-hidden" }}"  id="type-level">
                        <label class="col-xl-3 col-lg-3 col-form-label">Niveau :</label>
                        <div class="col-lg-9">
                        <div class="">
                            <select class="form-control kt-selectpicker" name="level" id="level-select">
                                <option value="">Choisir un niveau...</option>
                                <option value="1" {{ ($participant->level == "1") ? "selected": "" }}>Niveau 1</option>
                                <option value="2" {{ ($participant->level == "2") ? "selected": "" }}>Niveau 2</option>
                                <option value="3" {{ ($participant->level == "3") ? "selected": "" }}>Niveau 3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" data-action="Upgrader" data-url="upgrade" class="btn btn-primary DataTableVUrl">Upgrader</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts.custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/demo1/pages/components/extended/sweetalert2.js') }}" type="text/javascript"></script>
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
        $('body').on('click', '.DataTableVUrl', function () {
            Swal.fire({
                title: $(this).data('action'),
                text: "Voulez vous vraiment exécuter cette action",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui'
            }).then((result) => {
                if (result.value) {
                    if($(this).data('url') == 'upgrade') {
                        var nextLevel = ($('#nextLevel').val() != 'aucun') ? $('#nextLevel').val() : ''
                        var participantId = $('#partcipantIdField').val()
                        let levelSelect = document.getElementById('level-select')
                        window.location.href = '/participant/' + participantId + '/7/' + nextLevel + (levelSelect.value ? '?level=' + levelSelect.value : "")
                    } else {
                        window.location.href = $(this).data('url');
                    }
                }
            })
        })
        $('body').on('click', '#UpdateUnblockBlock', function () {
            $('#UpdateUnblockBlockSection').removeClass('updateBlockDiv') 
            $('#actionsBtNS').removeClass('hideActions')
        })

        function changeType($event) {
            let nextLevel = document.getElementById('nextLevel')
            let typeLevel = document.getElementById('type-level')
            if (nextLevel.value == '4' || nextLevel.value == '6') {
                typeLevel.classList.remove('kt-hidden')
            } else {
                typeLevel.classList.add('kt-hidden')
            }
        }
    </script>
@endsection
