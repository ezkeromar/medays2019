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
                                <h3 class="kt-portlet__head-title">Prestations affectées</h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <button class="btn btn-label-primary btn-sm btn-icon-h kt-form--enable" id="UpdateUnblockBlock">
                                    Modifier
                                </button>
                            </div>
                        </div>
                        {{ Form::open(array('url' => '/participant/'.$participant->id.'/update-prestation', 'method' => 'post', 'class' => 'kt-form kt-form--label-right kt-form--disable', 'enctype' => "multipart/form-data")) }}
                            {!! csrf_field() !!}
                            <input type='hidden' value="{{$participant->room_category_id}}" id="participantRoomCatId" />
                            <div id="UpdateUnblockBlockSection" class="updateBlockDiv"></div>
                            <div class="kt-portlet__body">
                            @if($participant->has_restoration == 2)
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Restauration :</h3>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-last row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Restaurant :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select name="restoration" class="form-control kt-selectpicker">
                                                    <option value="none">Choisir un type...</option>
                                                    @foreach($restaurents as $restaurent)
                                                        <option value="{{$restaurent->id}}" {{ ($restaurent->id == $participant->restoration) ? "selected": "" }}>{{$restaurent->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg">
                                </div>
                            @endif
                            @if($participant->has_formation == 2)
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">FORMATION :</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Titre :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select name="formation_name" class="form-control kt-selectpicker">
                                                    <option value="none">Choisir une formation...</option>
                                                    <option value="1" {{ ('1' == $participant->formation_name) ? "selected": "" }}>Intelligence économique</option>
                                                    <option value="2" {{ ('2' == $participant->formation_name) ? "selected": "" }}>ZLECA : quels mécanismes et quelles opportunités pour les entreprises marocaines ?</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Statuts :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select name="formation_state" class="form-control kt-selectpicker">
                                                    <option value="none">Choisir un statut...</option>
                                                    <option value="1" {{ ('1' == $participant->formation_state) ? "selected": "" }}>Attente paiement</option>
                                                    <option value="2" {{ ('2' == $participant->formation_state) ? "selected": "" }}>Payée</option>
                                                    <option value="3" {{ ('3' == $participant->formation_state) ? "selected": "" }}>Annulée</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg">
                                </div>
                            @endif
                            @if($participant->has_hebergement == 2)
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Hebergement</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Hôtel :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select name="hotel_id" class="form-control kt-selectpicker" id="hotelsSelect">
                                                    <option value="none">Choisir un hôtel...</option>
                                                    @foreach($hotels as $hotel)
                                                        <option value="{{$hotel->id}}" {{ ($hotel->id == $participant->hotel_id) ? "selected": "" }}>{{$hotel->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Catégorie de chambre :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select name="room_category_id" class="form-control kt-selectpicker" id="roomCatsSelect">
                                                    <option value="none">Choisir une catégorie...</option>
                                                    @foreach($roomsCategories as $category)
                                                        <option value="{{$category->id}}" {{ ($category->id == $participant->room_category_id) ? "selected": "" }}>{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Type de chambre :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select name="room_type" class="form-control kt-selectpicker">
                                                    <option value="none">Choisir un type...</option>
                                                    <option value="1" {{ (1 == $participant->room_type) ? "selected": "" }}>Single</option>
                                                    <option value="2" {{ (2 == $participant->room_type) ? "selected": "" }}>Double</option>
                                                    <option value="3" {{ (3 == $participant->room_type) ? "selected": "" }}>Twin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Date d’arrivée :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input type='text' class="form-control arrival_date" value="{{$participant->arrival_date}}" name="arrival_date" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Date de départ :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input type='text' class="form-control departure_date" value="{{ $participant->departure_date }}" name="departure_date" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Nombre de nuitées :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input type='text' class="form-control" readonly type="text" id='nights_count' name="nights_count" value="{{$participant->nights_count}}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg">
                                </div>
                            @endif
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                    @if($participant->has_transfert == 2)
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Transfert arrivée :</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Date Arrivée :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input name='transfer_arrival_date' value='{{$participant->transfer_arrival_date}}' class="form-control transfert_arrival" readonly placeholder="Date" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Heure Arrivée :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input name='transfer_arrival_time' value='{{$participant->transfer_arrival_time}}' class="form-control timepicker01" readonly placeholder="Heure" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Aéroport de provenance :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input name='arrival_airport' value='{{$participant->arrival_airport}}' class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Compagnie Aérienne :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input name='arrival_airline_company' value='{{$participant->arrival_airline_company}}' class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Numéro de vol :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input name='arrival_flight_number' value='{{$participant->arrival_flight_number}}' class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Aéroport d'arrivée :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select name="arrival_recovery_point" class="form-control kt-selectpicker">
                                                    <option value="none">Choisir un aéroport...</option>
                                                    @foreach(config('meDays.airports') as $item)
                                                    <option value="{{$item['id']}}" {{$item['id'] == $participant->arrival_recovery_point ? 'selected="selected"' : '' }}>{{ $item['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                       {{-- <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Hôtel :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select name="arrival_deposit_point" class="form-control kt-selectpicker" id="hotelsSelect">
                                                    <option value="none">Choisir un hôtel...</option>
                                                    @foreach($hotels as $hotel)
                                                        <option value="{{$hotel->id}}" {{ ($hotel->id == $participant->arrival_deposit_point) ? "selected": "" }}>{{$hotel->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>--}}
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Transfert départ :</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Date Départ :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input name='transfer_departure_date'
                                                       value='{{ $participant->transfer_departure_date }}'
                                                       class="form-control transfert_departure" readonly
                                                       placeholder="Date" type="text"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Heure Départ :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input name='transfer_departure_time' value='{{$participant->transfer_departure_time}}' class="form-control timepicker01" readonly placeholder="Heure" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Aéroport de destination :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input name='departure_airport' value='{{$participant->departure_airport}}' class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Compagnie Aérienne :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input name='departure_airline_company' value='{{$participant->departure_airline_company}}' class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Numéro de vol :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input name='departure_flight_number' value='{{$participant->departure_flight_number}}' class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Aéroport de départ :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select name='departure_deposit_point' class="form-control kt-selectpicker">
                                                    <option value="none">Choisir un aéroport...</option>
                                                    @foreach(config('meDays.airports') as $item)
                                                    <option value="{{$item['id']}}" {{$item['id'] == $participant->departure_deposit_point ? 'selected="selected"' : '' }}>{{ $item['name'] }}</option>
                                                    @endforeach                                               
                                                    </select>
                                            </div>
                                        </div>
                                        {{--<div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Hôtel :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select name="departure_recovery_point" class="form-control kt-selectpicker" id="hotelsSelect">
                                                    <option value="none">Choisir un hôtel...</option>
                                                    @foreach($hotels as $hotel)
                                                        <option value="{{$hotel->id}}" {{ ($hotel->id == $participant->departure_recovery_point) ? "selected": "" }}>{{$hotel->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>--}}
                                    @endif
                                    @if($participant->has_pec == 2)
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg">
                                        </div>
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Préférence de vol :</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-ladesired_departure_date



                                            bel">Date d'arrivée souhaitée :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input name='desired_arrival_date'
                                                       value='{{ $participant->desired_arrival_date }}'
                                                       class="form-control desired_arrival" readonly placeholder="Date"
                                                       type="text"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Heure d'arrivée souhaitée :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select name='desired_arrival_hour' class="form-control kt-selectpicker">
                                                    <option value="none" selected>Choisir une tranche horaire...</option>
                                                    <option value="1" {{($participant->desired_arrival_hour == 1) ? 'selected' : ''}}>Matin</option>
                                                    <option value="2" {{($participant->desired_arrival_hour == 2) ? 'selected' : ''}}>Après-midi</option>
                                                    <option value="3" {{($participant->desired_arrival_hour == 3) ? 'selected' : ''}}>Soir</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Aéroport de provenance :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input name='pec_arrival_airport' value='{{$participant->pec_arrival_airport}}' class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Date de départ souhaitée :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input name='desired_departure_date'
                                                       value='{{ $participant->desired_departure_date }}'
                                                       class="form-control desired_departure" readonly
                                                       placeholder="Date" type="text"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Heure de départ souhaitée :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select name='desired_departure_hour' class="form-control kt-selectpicker">
                                                    <option value="none" selected>Choisir une tranche horaire...</option>
                                                    <option value="1" {{($participant->desired_departure_hour == 1) ? 'selected' : ''}}>Matin</option>
                                                    <option value="2" {{($participant->desired_departure_hour == 2) ? 'selected' : ''}}>Après-midi</option>
                                                    <option value="3" {{($participant->desired_departure_hour == 3) ? 'selected' : ''}}>Soir</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Aéroport de destination :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input name='pec_departure_airport' value='{{$participant->pec_departure_airport}}' class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">PEC :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <span class="kt-switch">
                                                    <label>
                                                        <input type="checkbox" name="has_pec" {{($participant->has_pec == 2) ? 'checked' : ''}} class="pec_prestation" />
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group row {{($participant->has_pec == 2) ? '' : 'kt-hidden'}} kt-billet-avion">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Billet d'avion :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                @if(!empty($participant->air_ticket))
                                                    <a class='kt-widget4__number kt-font-info' style="z-index: 1000000 !important; position: absolute;" href="{{$participant->air_ticket}}" target="_blank">Visualiser le billet d'avion</a>
                                                @endif
                                                <div class="custom-file" style="margin-top: 22px !important;">
                                                    <input type="file" name="air_ticket" class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile" style="text-align: left;">Choisir un fichier (pdf)</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-3 col-xl-3">
                                        </div>
                                        <div id='actionsBtNS' class="col-lg-9 col-xl-9 hideActions">
                                            <input type="submit" class="btn btn-brand btn-bold" value='Enregistrer'/>&nbsp;
                                            <input type="reset" class="btn btn-secondary kt-form-disable--cta" value='Annuler'/>
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
    <script src="{{ asset('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/demo1/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts.custom.js') }}" type="text/javascript"></script>
    <script>
        $('body').on('click', '#UpdateUnblockBlock', function () {
            $('#UpdateUnblockBlockSection').removeClass('updateBlockDiv')
            $('#actionsBtNS').removeClass('hideActions')
            if($('#hotelsSelect').find(":selected").val() !== '') {
                $("#roomCatsSelect").selectpicker('refresh')
            }
        })

        jQuery(document).ready(function() {
            if($('#hotelsSelect').find(":selected").val() !== '') {
                $.post( "/hotel/"+$('#hotelsSelect').find(":selected").val()+"/room-cats", {'_token': $('meta[name=csrf-token]').attr('content')}, function( data ) {
                    $("#roomCatsSelect").children('option:not(:first)').remove();
                    var participantRoomCatId = $('#participantRoomCatId').val()
                    $.each(data, function( index, value ) {
                        let isSelected = ''
                        if(participantRoomCatId == index) {
                            isSelected = 'selected';
                        }
                        $('#roomCatsSelect').append('<option value="'+index+'" '+isSelected+'>'+value+'</option>');
                    });
                    $("#roomCatsSelect").selectpicker('refresh')
                    console.log('here')
                });
            }
        })

        $('body').on('change', '#hotelsSelect', function () {
            if($(this).find(":selected").val() !== '') {
                $.post( "/hotel/"+$(this).find(":selected").val()+"/room-cats", {'_token': $('meta[name=csrf-token]').attr('content')}, function( data ) {
                    $("#roomCatsSelect").children('option:not(:first)').remove();
                    var participantRoomCatId = $('#participantRoomCatId').val()
                    $.each(data, function( index, value ) {
                        let isSelected = ''
                        if(participantRoomCatId == index) {
                            isSelected = 'selected';
                        }
                        $('#roomCatsSelect').append('<option value="'+index+'" '+isSelected+'>'+value+'</option>');
                    });
                    $("#roomCatsSelect").selectpicker('refresh')
                });
            }
        })

        $('body').on('change', '.departure_date', function (e) {
            console.log('departure_date')
            console.log($('.departure_date').val())
            if($(this).val() !== '') {
                changeNumberNight()
            }
        })

        $('body').on('change', '.arrival_date', function (e) {
            console.log('arrival_date')
            console.log($('.arrival_date').val())
            if($(this).val() !== '') {
                changeNumberNight()
            }
        })
    </script>
@endsection
