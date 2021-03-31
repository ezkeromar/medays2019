<!--begin: User Bar -->
<div class="kt-header__topbar-item kt-header__topbar-item--user">
    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
        <div class="kt-header__topbar-user">
            <span class="kt-header__topbar-welcome kt-hidden-mobile">Bonjour </span>
            <span class="kt-header__topbar-username kt-hidden-mobile"><?php echo e(Auth::user()->first_name); ?></span>
            <img class="kt-hidden" alt="Pic" src="./assets/media/users/300_25.jpg" />

            <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
            <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold"><?php echo e(ucfirst(substr(Auth::user()->first_name, 0, 1))); ?></span>
        </div>
    </div>
    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

        <!--begin: Head -->
        <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(<?php echo e(asset('assets/media/misc/bg-1.jpg')); ?>)">
            <div class="kt-user-card__avatar">
                <img class="kt-hidden" alt="Pic" src="./assets/media/users/300_25.jpg" />

                <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success"><?php echo e(ucfirst(substr(Auth::user()->first_name, 0, 1))); ?></span>
            </div>
            <div class="kt-user-card__name">
                <?php echo e(Auth::user()->first_name . ' ' . Auth::user()->last_name); ?>

            </div>
        </div>

        <!--end: Head -->

        <!--begin: Navigation -->
        <div class="kt-notification">
            <a href="<?php echo e(url('/profile/'.Auth::user()->name.'/edit')); ?>" class="kt-notification__item">
                <div class="kt-notification__item-icon">
                    <i class="flaticon2-calendar-3 kt-font-success"></i>
                </div>
                <div class="kt-notification__item-details">
                    <div class="kt-notification__item-title kt-font-bold">
                        Mon profil
                    </div>
                </div>
            </a>
            <div class="kt-notification__custom kt-space-between">
                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-label btn-label-brand btn-sm btn-bold"><?php echo e(trans('titles.logout')); ?></a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </div>
        <!--end: Navigation -->
    </div>
</div>
<!--end: User Bar --><?php /**PATH C:\laragon\www\medyas\resources\views/partials/user-bar.blade.php ENDPATH**/ ?>