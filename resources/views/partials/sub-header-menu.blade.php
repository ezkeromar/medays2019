<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default">
    <ul class="kt-menu__nav ">
        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                        viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect id="bound" x="0" y="0" width="24" height="24" />
                            <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" id="Combined-Shape" fill="#000000" />
                            <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" id="Combined-Shape" fill="#000000" opacity="0.3" />
                        </g>
                    </svg>
                </span>
                <span class="kt-menu__link-text">Administration</span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu  kt-menu__submenu--fixed kt-menu__submenu--left" style="width:500px">
                <div class="kt-menu__subnav">
                    <ul class="kt-menu__content">
                        <li class="kt-menu__item ">
                            <ul class="kt-menu__inner" style="padding-bottom: 0">
                                <li class="kt-menu__item {{ (Request::is('roles') || Request::is('permissions')) ? 'active' : null }}" aria-haspopup="true">
                                    <a href="{{ route('laravelroles::roles.index') }}" class="kt-menu__link ">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">{!! trans('titles.laravelroles') !!}</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item {{ Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'active' : null }}" aria-haspopup="true">
                                    <a href="{{ url('/users') }}" class="kt-menu__link ">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">{!! trans('titles.adminUserList') !!}</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item {{ Request::is('users/create') ? 'active' : null }}" aria-haspopup="true">
                                    <a href="{{ url('/users/create') }}" class="kt-menu__link ">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">{!! trans('titles.adminNewUser') !!}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</div>