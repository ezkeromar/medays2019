@extends('layouts.app')

@section('template_title')
{{ 'EXPORTS' }}
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
                                Participants
                            </h3>
                        </div>
                    </div>
                    <form method="POST" action="export" class="kt-form kt-form--label-right">
                        {!! csrf_field() !!}
                        
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Type participant:</label>
                                <div class="col-lg-9 col-xl-6">
                                    <select class="form-control kt-selectpicker kt-types-form" name="type">
                                        <option value="">Tous les Participants</option>
                                        @if(empty(app('request')->input('ref')))
                                        @foreach($types as $key => $type)
                                        <optgroup
                                            label="{{($key == 1) ? 'PARTICIPANTS' : (($key == 2) ? 'PRESSE - SPONSORS' : 'ORGANISATION')}}">
                                            @foreach($type as $t)
                                            <option value="{{$t->id}}"
                                                {{ ($t->id == 4 || $t->id == 5) ? 'data-niveau="true"': "" }}
                                                {{ (old("type_id") == $t->id) ? "selected": "" }}>
                                                {{$t->name}}
                                            </option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                        @else
                                        @foreach($types as $key => $type)
                                        @if($key == 1)
                                        <optgroup label="PARTICIPANTS">
                                            @foreach($type as $t)
                                            @if($t->name == 'Conjoint' || $t->name == 'Délégation')
                                            <option value="{{$t->id}}"
                                                {{ ($t->id == 4 || $t->id == 5) ? 'data-niveau="true"': "" }}
                                                {{ (old("type_id") == $t->id || $t->name == 'Délégation') ? "selected": "" }}>
                                                {{$t->name}}
                                            </option>
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
                                <button type="submit" class="btn btn-brand btn-bold">Exporter</button>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="export" class="kt-form kt-form--label-right">
                        {!! csrf_field() !!}
                        
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">VIP:</label>
                                <div class="col-lg-9 col-xl-6">
                                    <select class="form-control kt-selectpicker kt-types-form" name="type">
                                        <optgroup label="SPEAKERS">
                                            <option value="4">Tous les speakers</option>
                                            <option value="4.1">Niveau 1</option>
                                            <option value="4.2">Niveau 2</option>
                                            <option value="4.3">Niveau 3</option>
                                        </optgroup>
                                        <optgroup label="DELEGATIONS">
                                            <option value="6">Toutes les délégations</option>
                                            <option value="6.1">Niveau 1</option>
                                            <option value="6.2">Niveau 2</option>
                                            <option value="6.3">Niveau 3</option>
                                        </optgroup>
                                        <option value="5">Conjoints</option>
                                    </select>
                                </div>
                                @error('type')
                                <div class="alert alert-danger formError">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-brand btn-bold">Exporter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--end:: Widgets/Order Statistics-->
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <!--begin:: Widgets/Order Statistics-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Hebergement
                            </h3>
                        </div>
                    </div>
                    <form method="POST" action="export-by-hotel" class="kt-form kt-form--label-right">
                        {!! csrf_field() !!}
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Hotels:</label>
                                <div class="col-lg-9 col-xl-6">
                                    <select class="form-control kt-selectpicker kt-types-form" name="hotel">
                                        <option value="">Tous les Hotels</option>
                                        @foreach($hotels as $key => $hotel)
                                        <option value="{{$hotel->id}}">{{$hotel->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('type')
                                <div class="alert alert-danger formError">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-brand btn-bold">Exporter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--end:: Widgets/Order Statistics-->
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <!--begin:: Widgets/Order Statistics-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Transfert
                            </h3>
                        </div>
                    </div>
                    <form method="POST" action="export" class="kt-form kt-form--label-right">
                        {!! csrf_field() !!}
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <label class="col-xl-2 col-lg-2 col-form-label">Type transfert:</label>
                                <div class="col-lg-4 col-xl-4">
                                    <select class="form-control kt-selectpicker kt-types-form" name="transfer">
                                        <option value="1">Arrivées</option>
                                        <option value="2">Départs</option>
                                    </select>
                                </div>
                                <label class="col-xl-1 col-lg-1 col-form-label">Aeroports:</label>
                                <div class="col-lg-4 col-xl-4">
                                    <select class="form-control kt-selectpicker kt-types-form" name="airport">
                                        @foreach(config('meDays.airports') as $item)
                                        <option value="{{$item['id']}}">{{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-2 col-lg-2 col-form-label">Date:</label>
                                <div class="col-lg-4 col-xl-4">
                                    <input style="width:100%" class="form-control exportpicker" type="text" alt="" name="dateTransfer"
                                        placeholder="date" value="" />
                                </div>
                                <div class="col-lg-4 col-xl-4 offset-xl-1 offset-lg-1">
                                    <button style="width:100%" type="submit" class="btn btn-brand btn-bold">Exporter</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <!--end:: Widgets/Order Statistics-->
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <!--begin:: Widgets/Order Statistics-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Formation
                            </h3>
                        </div>
                    </div>
                    <form method="POST" action="export" class="kt-form kt-form--label-right">
                        {!! csrf_field() !!}
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Formations:</label>
                                <div class="col-lg-9 col-xl-6">
                                    <select name="formation_name" class="form-control kt-selectpicker">
                                        <option value="all">Toutes les formations</option>
                                        <option value="1">Intelligence économique</option>
                                        <option value="2">ZLECA : quels mécanismes et quelles opportunités pour les
                                            entreprises marocaines ?</option>
                                    </select>
                                </div>
                                @error('type')
                                <div class="alert alert-danger formError">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-brand btn-bold">Exporter</button>
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
<script>
   $('.exportpicker').datepicker({
        format: 'dd/mm/yyyy',
        startDate: '09/11/2019',
        minDate: '09/11/2019',
        maxViewMode:0,
        endDate:'18/11/2019',
        stepMonths: 0,
        maxDate: '18/11/2019'
    })
</script>
@endsection