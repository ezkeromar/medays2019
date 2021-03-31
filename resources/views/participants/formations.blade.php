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
                <select id='statusFilter' class="form-control kt-select2" id="kt_select2_9" name="formation">
                    <option value="">Toutes les formations</option>
                    <option value="ie" {{(app('request')->input('formation') == 'ie') ? 'selected' : ''}}>IE</option>
                    <option value="zlecaf" {{(app('request')->input('formation') == 'zlecaf') ? 'selected' : ''}}>ZLECAF</option>
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
                        <th title="Field #3">Formation</th>
                        <th title="Field #4">Statut</th>
                        <th title="Field #5">Pays</th>
                        <th title="Field #6">Date d'inscription</th>
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
                        <td align="right">{{$participant->level?$participant->type_id.'@'.$participant->level:$participant->type_id}}</td>
                        <td>{{ $participant->formation_name }}</td>
                        <td>{{$participant->formation_state}}
                       </td>
                       {{-- @if(!empty(PragmaRX\Countries\Package\Countries::where('adm0_a3_us', $participant->country)->first()->name_fr))
                            <td>{{utf8_decode(PragmaRX\Countries\Package\Countries::where('adm0_a3_us', $participant->country)->first()->name_fr)}}</td>
                        @else
                            <td>{{$participant->country}}</td>
                        @endif--}}
                        <td>{{ $participant->theCountry ? $participant->theCountry->name_fr : '-'}}</td>
                        <td>{{ $participant->inscriptionDate ? $participant->inscriptionDate->format('d/m/Y H:i') : '-'}}</td>
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
                                @foreach($types as $key => $type)
                                    @if(count($type) > 0)
                                        <optgroup label="{{($key == 1) ? 'PARTICIPANTS' : (($key == 2) ? 'PRESSE - SPONSORS' : 'ORGANISATION')}}">
                                            @foreach($type as $t)
                                                <option value="{{$t->id}}" {{(app('request')->input('type') == $t->id) ? 'selected' : ''}}>{{$t->name}}</option>
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
                        <select id="nextLevel" class="form-control kt-selectpicker UpNextTypePop">
                            @foreach($types as $key => $type)
                                @if(count($type) > 0)
                                    <optgroup label="{{($key == 1) ? 'PARTICIPANTS' : (($key == 2) ? 'PRESSE - SPONSORS' : 'ORGANISATION')}}">
                                        @foreach($type as $t)
                                            <option value="{{$t->id}}" {{(app('request')->input('type') == $t->id) ? 'selected' : ''}}>{{$t->name}}</option>
                                        @endforeach
                                    </optgroup>
                                @endif
                            @endforeach
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
            var type = ($('#typeFilter option:selected').val() != undefined) ? $('#typeFilter option:selected').val() : '';
            var status = ($('#statusFilter option:selected').val() != undefined) ? $('#statusFilter option:selected').val() : '';
            window.location.href = 'formations?query='+query+'&type='+type+'&formation='+status+'&formation_state='+{{(app('request')->input('formation_state')) }};
        }

        $('body').on('change', '#statusFilter', function () {
            FilterDataTable();
        })

        $('body').on('change', '#typeFilter', function () {
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
