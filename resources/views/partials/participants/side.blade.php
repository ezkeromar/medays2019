<!--Begin:: App Aside-->
<div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside" style="opacity: 1;">
    <!--begin:: Widgets/Applications/User/Profile1-->
    <div class="kt-portlet kt-portlet--height-fluid-">
        <div class="kt-portlet__head  kt-portlet__head--noborder">
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit-y">
            <!--begin::Widget -->
            <div class="kt-widget kt-widget--user-profile-1">
                <div class="kt-widget__head">
                    <div class="kt-widget__media">
                        <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">B</span>
                    </div>
                    <div class="kt-widget__content">
                        <div class="kt-widget__section">
                            <span class="kt-widget__username">
                                <span></span> {{$participant->first_name}} {{$participant->last_name}}
                                <i class="flaticon2-correct kt-font-success"></i>
                            </span>
                            <span class="kt-widget__subtitle">
                                {{$participant->function}}
                            </span>
                            <!-- <span class="kt-widget__subtitle">
                                Directeur
                            </span> -->
                        </div>
                    </div>
                </div>
                <div class="kt-widget__body">
                    <div class="kt-widget__content">
                        <div class="kt-widget__info">
                            <span class="kt-widget__label">
                                @if($participant->type_id == 4 || $participant->type_id == 6)
                                <span class="kt-widget4__number kt-font-info">{{$typename.' - Niveau '.$participant->level}}</span>
                                @else
                                <span class="kt-widget4__number kt-font-info">{{$typename}}</span>
                                @endif
                            </span>
                        </div>
                        @if(!empty($participantParentName) && $participant->type_id == 5 || $participant->type_id == 6)
                            <div class="kt-widget__info">
                                <span class="kt-widget__data">
                                    <a href="{{'/participant/'.$participant->parent_id}}">{{$participantParentName}}</a>
                                </span>
                            </div>
                        @endif
                        <div class="kt-widget__info">
                            <span class="kt-widget__label">Code d'accès :</span>
                            <span class="kt-widget__data">{{$participant->access_code}}</span>
                        </div>
                        <div class="kt-widget__info">
                            <span class="kt-widget__label">WebCode :</span>
                            <span class="kt-widget__data">{{$participant->webcode}}</span>
                        </div>
                    </div>
                    <div class="kt-widget__items">
                        <a href="{{ URL('participant/'.$participant->id) }}"
                            class="kt-widget__item {{ $active_link == 'profil' ? 'kt-widget__item--active' : null }}">
                            <span class="kt-widget__section">
                                <span class="kt-widget__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                        viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon id="Bound" points="0 0 24 0 24 24 0 24"></polygon>
                                            <path
                                                d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                                id="Shape" fill="#000000" fill-rule="nonzero"></path>
                                            <path
                                                d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                                id="Path" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg> </span>
                                <span class="kt-widget__desc">
                                    Profil
                                </span>
                            </span>
                        </a>
                        <a href="{{ URL('participant/'.$participant->id.'/prestations') }}"
                            class="kt-widget__item {{ $active_link == 'prestations' ? 'kt-widget__item--active' : null }}">
                            <span class="kt-widget__section">
                                <span class="kt-widget__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                        viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                            <path
                                                d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z"
                                                id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                            <path
                                                d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z"
                                                id="Combined-Shape" fill="#000000"></path>
                                        </g>
                                    </svg> </span>
                                <span class="kt-widget__desc">
                                    Prestations
                                </span>

                            </span></a>
                        @if($participant->type_id == 4)
                        <a href="{{ URL('participant/'.$participant->id.'/delegation') }}"
                            class="kt-widget__item {{ $active_link == 'delegation' ? 'kt-widget__item--active' : null }}">
                            <span class="kt-widget__section">
                                <span class="kt-widget__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                        viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="Rectangle-5" x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M6,7 C7.1045695,7 8,6.1045695 8,5 C8,3.8954305 7.1045695,3 6,3 C4.8954305,3 4,3.8954305 4,5 C4,6.1045695 4.8954305,7 6,7 Z M6,9 C3.790861,9 2,7.209139 2,5 C2,2.790861 3.790861,1 6,1 C8.209139,1 10,2.790861 10,5 C10,7.209139 8.209139,9 6,9 Z"
                                                id="Oval-7" fill="#000000" fill-rule="nonzero" />
                                            <path
                                                d="M7,11.4648712 L7,17 C7,18.1045695 7.8954305,19 9,19 L15,19 L15,21 L9,21 C6.790861,21 5,19.209139 5,17 L5,8 L5,7 L7,7 L7,8 C7,9.1045695 7.8954305,10 9,10 L15,10 L15,12 L9,12 C8.27142571,12 7.58834673,11.8052114 7,11.4648712 Z"
                                                id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path
                                                d="M18,22 C19.1045695,22 20,21.1045695 20,20 C20,18.8954305 19.1045695,18 18,18 C16.8954305,18 16,18.8954305 16,20 C16,21.1045695 16.8954305,22 18,22 Z M18,24 C15.790861,24 14,22.209139 14,20 C14,17.790861 15.790861,16 18,16 C20.209139,16 22,17.790861 22,20 C22,22.209139 20.209139,24 18,24 Z"
                                                id="Oval-7-Copy" fill="#000000" fill-rule="nonzero" />
                                            <path
                                                d="M18,13 C19.1045695,13 20,12.1045695 20,11 C20,9.8954305 19.1045695,9 18,9 C16.8954305,9 16,9.8954305 16,11 C16,12.1045695 16.8954305,13 18,13 Z M18,15 C15.790861,15 14,13.209139 14,11 C14,8.790861 15.790861,7 18,7 C20.209139,7 22,8.790861 22,11 C22,13.209139 20.209139,15 18,15 Z"
                                                id="Oval-7-Copy-3" fill="#000000" fill-rule="nonzero" />
                                        </g>
                                    </svg> </span>
                                <span class="kt-widget__desc">
                                    Délégation
                                </span>

                            </span></a>
                        @endif
                        <a href="{{ URL('participant/'.$participant->id.'/historique') }}"
                            class="kt-widget__item {{ $active_link == 'historique' ? 'kt-widget__item--active' : null }}">
                            <span class="kt-widget__section">
                                <span class="kt-widget__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" id="Combined-Shape" fill="#000000"/>
                                        <rect id="Rectangle-152" fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                        <rect id="Rectangle-152-Copy-2" fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                        <rect id="Rectangle-152-Copy-3" fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                        <rect id="Rectangle-152-Copy" fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                        <rect id="Rectangle-152-Copy-5" fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                        <rect id="Rectangle-152-Copy-4" fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                    </g>
                                </svg>
                                </span>
                                <span class="kt-widget__desc">
                                    Historique
                                </span>
                            </span>
                        </a>
                        <a href="{{ URL('participant/'.$participant->id.'/commentaire') }}"
                            class="kt-widget__item {{ $active_link == 'commentaire' ? 'kt-widget__item--active' : null }}">
                            <span class="kt-widget__section">
                                <span class="kt-widget__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <polygon id="Path-75" fill="#000000" opacity="0.3" points="5 15 3 21.5 9.5 19.5"/>
                                            <path d="M13.5,21 C8.25329488,21 4,16.7467051 4,11.5 C4,6.25329488 8.25329488,2 13.5,2 C18.7467051,2 23,6.25329488 23,11.5 C23,16.7467051 18.7467051,21 13.5,21 Z M8.5,13 C9.32842712,13 10,12.3284271 10,11.5 C10,10.6715729 9.32842712,10 8.5,10 C7.67157288,10 7,10.6715729 7,11.5 C7,12.3284271 7.67157288,13 8.5,13 Z M13.5,13 C14.3284271,13 15,12.3284271 15,11.5 C15,10.6715729 14.3284271,10 13.5,10 C12.6715729,10 12,10.6715729 12,11.5 C12,12.3284271 12.6715729,13 13.5,13 Z M18.5,13 C19.3284271,13 20,12.3284271 20,11.5 C20,10.6715729 19.3284271,10 18.5,10 C17.6715729,10 17,10.6715729 17,11.5 C17,12.3284271 17.6715729,13 18.5,13 Z" id="Combined-Shape" fill="#000000"/>
                                        </g>
                                    </svg>
                                </span>
                                <span class="kt-widget__desc">
                                    Commentaires ({{ \App\Models\Participants::commentsCount($participant->id) }})
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <!--end::Widget -->
        </div>
    </div>
    <!--end:: Widgets/Applications/User/Profile1-->

</div>
<!--End:: App Aside-->