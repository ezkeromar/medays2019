<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="javascript:;">
                <img alt="Logo" src="{{ asset('assets/media/logos/logo-reeventy.svg') }}" width="180" height="100%" />
            </a>
        </div>
        <div class="kt-aside__brand-tools">
            <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
                <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon id="Shape" points="0 0 24 0 24 24 0 24" />
                            <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                            <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
                        </g>
                    </svg></span>
                <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon id="Shape" points="0 0 24 0 24 24 0 24" />
                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero" />
                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
                        </g>
                    </svg></span>
            </button>

            <!--
                <button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
            -->
        </div>
    </div>

    <!-- end:: Aside -->

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <li id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item {{ Request::is('participants') ? 'kt-menu__item--open' : null }} kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon id="Shape" points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                        id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path
                                        d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                        id="Combined-Shape" fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                        </span>
                        <span class="kt-menu__link-text">Participants</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu kt-menu__submenu--custom"><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item {{(empty(app('request')->input('status'))) ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/participants') }}" class="kt-menu__link">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Tous les participants</span>
                                </a>
                            </li>
                            <li class="kt-menu__item {{(!empty(app('request')->input('status')) && app('request')->input('status') == 1) ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/participants?status=1') }}" class="kt-menu__link">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">En attente</span>
                                </a>
                            </li>
                            <li class="kt-menu__item {{(!empty(app('request')->input('status')) && app('request')->input('status') == 3) ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/participants?status=3') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Validés</span>
                                </a>
                            </li>
                            <li class="kt-menu__item {{(!empty(app('request')->input('status')) && app('request')->input('status') == 4) ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/participants?status=4') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Refusés</span>
                                </a>
                            </li>
                            <li class="kt-menu__item {{(!empty(app('request')->input('status')) && app('request')->input('status') == 2) ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/participants?status=2') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Invitation envoyée</span>
                                </a>
                            </li>
                            <li class="kt-menu__item {{(!empty(app('request')->input('status')) && app('request')->input('status') == 11) ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/participants?status=11') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">PEC</span>
                                </a>
                            </li>
                            <li class="kt-menu__item {{(!empty(app('request')->input('status')) && app('request')->input('status') == 12) ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/participants?status=12') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">NOPEC</span>
                                </a>
                            </li>
                            <li class="kt-menu__item {{(!empty(app('request')->input('status')) && app('request')->input('status') == 6) ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/participants?status=6') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Demande transport</span>
                                </a>
                            </li>
                            <li class="kt-menu__item {{(!empty(app('request')->input('status')) && app('request')->input('status') == 7) ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/participants?status=7') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Attente info transferts</span>
                                </a>
                            </li>
                            <li class="kt-menu__item {{(!empty(app('request')->input('status')) && app('request')->input('status') == 13) ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/participants?status=13') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Attente de validation</span>
                                </a>
                            </li>
                            <li class="kt-menu__item {{(!empty(app('request')->input('status')) && app('request')->input('status') == 8) ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/participants?status=8') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Badge à éditer</span>
                                </a>
                            </li>
                            <li class="kt-menu__item {{(!empty(app('request')->input('status')) && app('request')->input('status') == 9) ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/participants?status=9') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Badge édité</span>
                                </a>
                            </li>
                            <li class="kt-menu__item {{(!empty(app('request')->input('status')) && app('request')->input('status') == 10) ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/participants?status=10') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Badge livré</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item {{ Request::is('formations') ? 'kt-menu__item--open' : null }} kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Stockholm-icons-/-Home-/-Armchair" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <path d="M20,8 L18.173913,8 C17.0693435,8 16.173913,8.8954305 16.173913,10 L16.173913,12 C16.173913,12.5522847 15.7261978,13 15.173913,13 L8.86956522,13 C8.31728047,13 7.86956522,12.5522847 7.86956522,12 L7.86956522,10 C7.86956522,8.8954305 6.97413472,8 5.86956522,8 L4,8 L4,6 C4,4.34314575 5.34314575,3 7,3 L17,3 C18.6568542,3 20,4.34314575 20,6 L20,8 Z" id="Path" fill="#000000" opacity="0.3"></path>
                                <path d="M6.15999985,21.0604779 L8.15999985,17.5963763 C8.43614222,17.1180837 9.04773263,16.9542085 9.52602525,17.2303509 C10.0043179,17.5064933 10.168193,18.1180837 9.89205065,18.5963763 L7.89205065,22.0604779 C7.61590828,22.5387706 7.00431787,22.7026457 6.52602525,22.4265033 C6.04773263,22.150361 5.88385747,21.5387706 6.15999985,21.0604779 Z M17.8320512,21.0301278 C18.1081936,21.5084204 17.9443184,22.1200108 17.4660258,22.3961532 C16.9877332,22.6722956 16.3761428,22.5084204 16.1000004,22.0301278 L14.1000004,18.5660262 C13.823858,18.0877335 13.9877332,17.4761431 14.4660258,17.2000008 C14.9443184,16.9238584 15.5559088,17.0877335 15.8320512,17.5660262 L17.8320512,21.0301278 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                <path d="M20,10 L20,15 C20,16.6568542 18.6568542,18 17,18 L7,18 C5.34314575,18 4,16.6568542 4,15 L4,10 L5.86956522,10 L5.86956522,12 C5.86956522,13.6568542 7.21271097,15 8.86956522,15 L15.173913,15 C16.8307673,15 18.173913,13.6568542 18.173913,12 L18.173913,10 L20,10 Z" id="Combined-Shape" fill="#000000"></path>
                            </g>
                        </svg>
                        </span>
                        <span class="kt-menu__link-text">Formations</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu kt-menu__submenu--custom"><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                        <li class="kt-menu__item {{(empty(app('request')->input('formations')) && app('request')->input('formation_state') == '1') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/formations?formation_state=1') }}" class="kt-menu__link">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Attente paiement</span>
                                </a>
                            </li>
                            <li class="kt-menu__item {{(empty(app('request')->input('formations')) && app('request')->input('formation_state') == '2') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/formations?formation_state=2') }}" class="kt-menu__link">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Payée</span>
                                </a>
                            </li>
                            <li class="kt-menu__item {{(empty(app('request')->input('formations')) && app('request')->input('formation_state') == '3') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/formations?formation_state=3') }}" class="kt-menu__link">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Annulée</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item {{ Request::is('hebergements') ? 'kt-menu__item--open' : null }} kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect id="bound" x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M4,22 L2,22 C2,19.2385763 4.23857625,18 7,18 L17,18 C19.7614237,18 22,19.2385763 22,22 L20,22 C20,20.3431458 18.6568542,20 17,20 L7,20 C5.34314575,20 4,20.3431458 4,22 Z"
                                        id="Path-61" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <rect id="Rectangle-137" fill="#000000" x="1" y="14" width="22" height="6" rx="1" />
                                    <path
                                        d="M13,13 L11,13 L11,12 C11,11.4477153 10.5522847,11 10,11 L6,11 C5.44771525,11 5,11.4477153 5,12 L5,13 L4,13 C3.44771525,13 3,12.5522847 3,12 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12 C21,12.5522847 20.5522847,13 20,13 L19,13 L19,12 C19,11.4477153 18.5522847,11 18,11 L14,11 C13.4477153,11 13,11.4477153 13,12 L13,13 Z"
                                        id="Combined-Shape" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                        </span>
                        <span class="kt-menu__link-text">Hébérgement</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu kt-menu__submenu--custom"><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item {{ (empty(app('request')->input('hebergements')) && app('request')->input('date') == 'arrival') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/hebergements?date=arrival') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Arrivées</span>
                                </a>
                            </li>
                            <li class="kt-menu__item {{ (empty(app('request')->input('hebergements')) && app('request')->input('date') == 'departure') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/hebergements?date=departure') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Départs</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item {{ request()->is('transferts/*') ? 'kt-menu__item--open' : null }} kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon id="Bound" points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M10,14 L5,14 C4.33333333,13.8856181 4,13.5522847 4,13 C4,12.4477153 4.33333333,12.1143819 5,12 L12,12 L12,19 C12,19.6666667 11.6666667,20 11,20 C10.3333333,20 10,19.6666667 10,19 L10,14 Z M15,9 L20,9 C20.6666667,9.11438192 21,9.44771525 21,10 C21,10.5522847 20.6666667,10.8856181 20,11 L13,11 L13,4 C13,3.33333333 13.3333333,3 14,3 C14.6666667,3 15,3.33333333 15,4 L15,9 Z"
                                        id="Combined-Shape" fill="#000000" fill-rule="nonzero" />
                                    <path
                                        d="M3.87867966,18.7071068 L6.70710678,15.8786797 C7.09763107,15.4881554 7.73079605,15.4881554 8.12132034,15.8786797 C8.51184464,16.2692039 8.51184464,16.9023689 8.12132034,17.2928932 L5.29289322,20.1213203 C4.90236893,20.5118446 4.26920395,20.5118446 3.87867966,20.1213203 C3.48815536,19.7307961 3.48815536,19.0976311 3.87867966,18.7071068 Z M16.8786797,5.70710678 L19.7071068,2.87867966 C20.0976311,2.48815536 20.7307961,2.48815536 21.1213203,2.87867966 C21.5118446,3.26920395 21.5118446,3.90236893 21.1213203,4.29289322 L18.2928932,7.12132034 C17.9023689,7.51184464 17.2692039,7.51184464 16.8786797,7.12132034 C16.4881554,6.73079605 16.4881554,6.09763107 16.8786797,5.70710678 Z"
                                        id="Combined-Shape" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                        </span>
                        <span class="kt-menu__link-text">Transferts</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu kt-menu__submenu--custom"><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item {{ Request::is('transferts/arrivees') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/transferts/arrivees') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Arrivées</span>
                                </a>
                            </li>
                            <li class="kt-menu__item {{ Request::is('transferts/departs') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                                <a href="{{ URL('/transferts/departs') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Départs</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
               
                <li class="kt-menu__item {{ request()->is('export') ? 'kt-menu__item--active' : null }}">
                    <a href="{{ URL('export') }}" class="kt-menu__link">
                        <span class="kt-menu__link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon id="Shape" points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z"
                                        id="Combined-Shape-Copy" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path
                                        d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z"
                                        id="Combined-Shape" fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                        </span>
                        <span class="kt-menu__link-text">Exports</span>
                    </a>
                </li>
                @role('admin')
                <li class="kt-menu__item {{ request()->is('import') ? 'kt-menu__item--active' : null }}">
                    <a href="{{ URL('import') }}" class="kt-menu__link">
                        <span class="kt-menu__link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect id="bound" x="0" y="0" width="24" height="24" />
                                    <rect id="Rectangle" fill="#000000" opacity="0.3"
                                        transform="translate(12.000000, 7.000000) rotate(-180.000000) translate(-12.000000, -7.000000) " x="11"
                                        y="1" width="2" height="12" rx="1" />
                                    <path
                                        d="M17,8 C16.4477153,8 16,7.55228475 16,7 C16,6.44771525 16.4477153,6 17,6 L18,6 C20.209139,6 22,7.790861 22,10 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,9.99305689 C2,7.7839179 3.790861,5.99305689 6,5.99305689 L7.00000482,5.99305689 C7.55228957,5.99305689 8.00000482,6.44077214 8.00000482,6.99305689 C8.00000482,7.54534164 7.55228957,7.99305689 7.00000482,7.99305689 L6,7.99305689 C4.8954305,7.99305689 4,8.88848739 4,9.99305689 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,10 C20,8.8954305 19.1045695,8 18,8 L17,8 Z"
                                        id="Path-103" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path
                                        d="M14.2928932,10.2928932 C14.6834175,9.90236893 15.3165825,9.90236893 15.7071068,10.2928932 C16.0976311,10.6834175 16.0976311,11.3165825 15.7071068,11.7071068 L12.7071068,14.7071068 C12.3165825,15.0976311 11.6834175,15.0976311 11.2928932,14.7071068 L8.29289322,11.7071068 C7.90236893,11.3165825 7.90236893,10.6834175 8.29289322,10.2928932 C8.68341751,9.90236893 9.31658249,9.90236893 9.70710678,10.2928932 L12,12.5857864 L14.2928932,10.2928932 Z"
                                        id="Path-104" fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                        </span>
                        <span class="kt-menu__link-text">Imports</span>
                    </a>
                </li>
                @endrole
                @role('admin')
                    <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                    viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z"
                                            id="Combined-Shape" fill="#000000" />
                                        <path
                                            d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z"
                                            id="Combined-Shape" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                            </span>
                            <span class="kt-menu__link-text">Paramètres</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu kt-menu__submenu--custom"><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item {{ Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'active' : null }}"
                                    aria-haspopup="true">
                                    <a href="{{ url('/users') }}" class="kt-menu__link ">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">{!! trans('titles.adminUserList') !!}</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item {{ Request::is('users/create') ? 'active' : null }}"
                                    aria-haspopup="true">
                                    <a href="{{ url('/users/create') }}" class="kt-menu__link ">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">{!! trans('titles.adminNewUser') !!}</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item {{ Request::is('hotels') ? 'active' : null }}"
                                    aria-haspopup="true">
                                    <a href="{{ url('/hotels') }}" class="kt-menu__link ">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">Hotels</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item {{ Request::is('types') ? 'active' : null }}" aria-haspopup="true">
                                    <a href="{{ url('/types') }}" class="kt-menu__link ">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">Types</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endrole
            </ul>
        </div>
    </div>

    <!-- end:: Aside Menu -->
</div>
<!-- end:: Aside -->