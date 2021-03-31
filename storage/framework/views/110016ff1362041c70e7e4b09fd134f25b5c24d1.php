<?php $__env->startSection('template_title'); ?>
    <?php echo e('Profile Participant'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!--Begin:: Portlet-->
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
        <!--Begin:: App Aside Mobile Toggle-->
        <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
            <i class="la la-close"></i>
        </button>
        <!--End:: App Aside Mobile Toggle-->

        <?php echo $__env->make('partials.participants.side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">Historique</h3>
                            </div>
                        </div>
                        <form class="kt-form kt-form--label-right">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="kt-timeline-v3">
                                            <div class="kt-timeline-v3__items">
                                            <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="kt-timeline-v3__item kt-timeline-v3__item--info">
                                                    <span class="kt-timeline-v3__item-time"><?php echo e(Carbon\Carbon::parse($action->created_at)->format('Y-m-d H:i')); ?></span>
                                                    <div class="kt-timeline-v3__item-desc">
                                                        <span class="kt-timeline-v3__item-text">
                                                            <?php echo $action->title; ?>

                                                        </span><br>
                                                        <span class="kt-timeline-v3__item-user-name">
                                                            <a href="#" class="kt-link kt-link--dark kt-timeline-v3__item-link">
                                                                par <?php echo e($action->user->first_name); ?> <?php echo e($action->user->last_name); ?>

                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\medyas\resources\views/participants/history.blade.php ENDPATH**/ ?>