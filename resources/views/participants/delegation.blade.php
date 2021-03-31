@extends('layouts.app')

@section('template_title')
{{ 'Profile Participant' }}
@endsection

@section('template_toolbar')
<div class="kt-subheader__group" id="kt_subheader_group_actions">
    <div class="btn-toolbar kt-margin-l-20">
        <button class="btn btn-label-success btn-bold btn-sm btn-icon-h" id="kt_sweetalert_demo_6">
            Valider
        </button>
        <button class="btn btn-label-danger btn-bold btn-sm btn-icon-h" id="kt_sweetalert_demo_8">
            Refuser
        </button>
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
                                Délégation
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="/add/participant?ref={{$participant->id}}" class="btn btn-label-primary btn-sm btn-icon-h kt-add-delegue">
                                Ajouter un délégué
                            </a>
                        </div>
                    </div>
                    <form class="kt-form kt-form--label-right kt-form--disable">
                        <div class="kt-portlet__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <!--begin: Datatable -->
                                    <table class="kt-datatable" id="delegation_table" width="100%">
                                        <thead>
                                            <tr>
                                                <th title="Field #0">ID</th>
                                                <th title="Field #1">Informations personnelles</th>
                                                <th title="Field #7">Statut</th>
                                                <th title="Field #10">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($delegates as $delegate)
                                            <tr>
                                                <td>{{$delegate->id}}</td>
                                                <td>
                                                    <div class="kt-user-card-v2">
                                                        <div class="kt-user-card-v2__details">
                                                            <span class="kt-user-card-v2__desc">{{$delegate->access_code}} <span style="margin:0 5px">|</span> WebCode :
                                                            {{$delegate->webcode}}</span>
                                                            <a class="kt-user-card-v2__name" href="{{ url('/participant/'.$delegate->id) }}">{{$delegate->first_name}} {{$delegate->last_name}}</a>
                                                            <span class="kt-user-card-v2__desc">{{$delegate->organization}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{$delegate->status}}</td>
                                                <!-- <td align="right">3</td>
                                                <td>Maroc</td>
                                                <td>11/12/2019</td>
                                                <td>TEST</td>
                                                <td>09/09/1989</td>
                                                <td>2</td>
                                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
                                                <td></td> -->
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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
<script src="{{ asset('assets/js/demo1/pages/crud/metronic-datatable/base/html-table.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/scripts.custom.js') }}" type="text/javascript"></script>
<script>
        $('body').on('click', '.DataTableVUrl', function () {
            Swal.fire({
                title: 'Confirmation',
                text: "Voulez vous vraiment exécuter cette action",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui'
            }).then((result) => {
                if (result.value) {
                    window.location.href = '{{asset("/")}}'+$(this).data('url');
                }
            })
        })
</script>

@endsection