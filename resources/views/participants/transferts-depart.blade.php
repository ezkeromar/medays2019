@extends('layouts.app')

@section('template_header_title')
    Listing Participants
@endsection

@section('template_title')
    <div class="kt-subheader__group" id="kt_subheader_search">
        <span class="kt-subheader__desc" id="kt_subheader_total">
            <span class="kt-widget4__number kt-font-primary">Total : {{$participants->total()}}</span>
        </span>
    </div>
    <div class="kt-subheader__group kt-hidden" id="kt_subheader_group_actions">
        <div class="kt-subheader__desc"><span id="kt_subheader_group_selected_rows"></span> Selected:</div>
        <div class="btn-toolbar kt-margin-l-20">
            <button data-action="Valider" data-url="/participant/multiple/1/#id#" class="btn btn-label-success btn-bold btn-sm btn-icon-h actionmultiple">
                <i class="la la-check-circle"></i> Valider
            </button>
            <button  data-action="Refuser" data-url="/participant/multiple/2/#id#" class="btn btn-label-danger btn-bold btn-sm btn-icon-h actionmultiple">
                <i class="la la-minus-circle"></i> Refuser
            </button>
        </div>
    </div>
@endsection

@section('template_toolbar')
    <div class="kt-margin-l-20 kt-participants--filter" id="kt_subheader_search_form">
        <div class="kt-input-icon kt-input-icon--right kt-subheader__search">
            <input type="text" class="form-control" placeholder="Recherche..." id="generalSearch" value="{{app('request')->input('query')}}">
        </div>
    </div>
    <div class="btn-toolbar kt-margin-l-20 kt-participants--filter">
        <div class="kt-form__group kt-form__group--inline">
            <div class="kt-form__control">
            <select id='airportsFilter' class="form-control kt-select2" id="kt_select2_9" name="formation">
                    <option value="Tous">Tous les aéroports</option>
                    @foreach(config('meDays.airports') as $item)
                    <option value="{{$item['id']}}" {{$item['id'] == app('request')->input('airport') ? 'selected="selected"' : '' }}>{{ $item['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="btn-toolbar kt-margin-l-20 kt-participants--filter">
        <div class="kt-form__group kt-form__group--inline">
            <div class="kt-form__control">
            <select id='hotelsFilter' class="form-control kt-select2" id="kt_select2_9" name="formation">
                    <option value="Tous">Tous les hotels</option>
                    @foreach($hotels as $key => $hotel)
                    <option value="{{$hotel->id}}" {{(app('request')->input('hotel') == $hotel->id) ? 'selected' : ''}}>{{$hotel->name}}</option>          
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="btn-toolbar kt-margin-l-20">
        <a href="/add/participant" class="btn btn-label-success btn-pill kt-add-participant">
            <i class="la la-user-plus"></i>
        </a>
    </div>
@endsection

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <!--begin: Datatable -->
            <table class="kt-datatable" id="html_table4" width="100%">
                <thead>
                    <tr>
                        <th title="Field #0">ID</th>
                        <th title="Field #1">Informations personnelles</th>
                        <th title="Field #2">Type</th>
                        <th title="Field #3">Aéroport Départ</th>
                        <th title="Field #4">Aéroport Destination</th>
                        <th title="Field #5">Date Départ</th>
                        <th title="Field #6">Heure Départ</th>
                        <th title="Field #7">Hotel</th>
                        <th title="Field #8">PEC</th>
                        <th title="Field #9">Statut Participant</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($participants as $participant)
                    <tr>
                        <td>{{$participant->id}}</td>
                        <td>
                            <div class="kt-user-card-v2">
                                <div class="kt-user-card-v2__details">
                                    <span class="kt-user-card-v2__desc">{{$participant->access_code}} <span style="margin:0 5px">|</span> WebCode : {{$participant->webcode}}</span>
                                    <a class="kt-user-card-v2__name" href="{{ url('/participant/'.$participant->id) }}">{{$participant->first_name}} {{$participant->last_name}}</a>
                                    <span class="kt-user-card-v2__desc">{{$participant->organization}}</span>
                                </div>
                            </div>
                        </td>
                        <td>{{$participant->level?$participant->type_id.'@'.$participant->level:$participant->type_id}}</td>
                        <td>
                        @foreach(config('meDays.airports') as $item)
                        @if($item['id']==$participant->departure_deposit_point)
                            {{$item['name']}}
                        @endif
                        @endforeach
                        </td> 
                        <td>{{$participant->departure_airport}}</td>
                        <td>
                        @php
                        try {
                            echo $participant->transfer_departure_date ? \Carbon\Carbon::parse($participant->transfer_departure_date)->format("d/m/Y") : "";
                        } catch(Exception $e) {
                            echo $participant->transfer_departure_date;
                        }
                        @endphp
                        </td>
                        <td>{{!empty($participant->transfer_departure_time)?Carbon\Carbon::createFromFormat("H:i:s", $participant->transfer_departure_time)->format("H:i"):'' }}</td>
                        <td>{{$participant->hotel['name']}}</td>
                        <td>{{$participant->has_pec==2?'Oui':'Non'}}</td>
                        <td>{{$participant->status}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="dataTablePagination">
            {{$participants->appends(request()->input())->links()}}
            </div>
            <!--end: Datatable -->
        </div>
    </div>
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
                            <select class="form-control kt-selectpicker UpTypePop">
                                <option value="" selected></option>
                               
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-bottom: 0.3rem;">
                        <label class="col-lg-3 col-form-label">Upgrader vers :</label>
                        <div class="col-lg-9">
                        <select id="nextLevel" class="form-control kt-selectpicker UpNextTypePop">
                         
                        </select>
                        </div>
                    </div>
                    <input type="hidden" value="" id="UpPopParticipantId" />
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
    <script src="{{ asset('assets/js/demo1/pages/crud/metronic-datatable/base/html-table.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/demo1/pages/crud/forms/widgets/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/demo1/pages/components/extended/sweetalert2.js') }}" type="text/javascript"></script>
    <script>
        function FilterDataTable () {
            var query = ($('#generalSearch').val() != undefined) ? $('#generalSearch').val() : '';
            var hotel = ($('#hotelsFilter option:selected').val() != undefined) ? $('#hotelsFilter option:selected').val() : '';
            var airport = ($('#airportsFilter option:selected').val() != undefined) ? $('#airportsFilter option:selected').val() : '';
            if ('URLSearchParams' in window) {
                let searchParams = new URLSearchParams(window.location.search);
                if(query.length)
                searchParams.set("query", query);
                if(airport.length)
                searchParams.set("airport", airport);
                if(hotel.length)
                searchParams.set("hotel", hotel);
                window.location.search = searchParams.toString();
            }
        }

        $('body').on('change', '#airportsFilter', function () {
            FilterDataTable();
        })

        $('body').on('change', '#hotelsFilter', function () {
            FilterDataTable();
        })

        $('body').on('keypress', '#generalSearch', function () {
            var keycode = (event.keyCode) ? event.keyCode : event.which;
            if (keycode == '13') {
                FilterDataTable();
            }
        })

        $('body').on('click', '.showUpPop', function () {
            $('#UpPopParticipantId').val($(this).data('id'))
            document.getElementsByClassName('UpTypePop')[0].value = $(this).data('type')
            document.getElementsByClassName('UpTypePop')[0].setAttribute('disabled',true)
        })

        $('body').on('click', '.DataTableVUrlNPOP', function () {
            window.location.href = $(this).data('url');
        })
    </script>
@endsection
