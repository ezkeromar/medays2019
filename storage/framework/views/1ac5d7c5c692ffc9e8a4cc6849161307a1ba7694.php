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
                                <h3 class="kt-portlet__head-title">Commentaires: nombre total <?php echo e(count($comments)); ?></h3>
                            </div>
                        </div>
                        <div class="kt-form kt-form--label-right">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <form method="POST" action="add/comment">
                                        <?php echo csrf_field(); ?>

                                            <div class="form-group">
                                                <textarea class="form-control" name="comment" id="exampleTextarea" rows="3" placeholder="Ajouter un commentaire" required></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="submit" class="btn btn-label-brand btn-bold" value='Ajouter un commentaire'/>
                                                    <input type="reset" class="btn btn-clean btn-bold" value='Annuler'/>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="kt-separator kt-separator--space-lg kt-separator--border-dashed"></div>
                                        <div class="kt-notes kt-scroll kt-scroll--pull" data-scroll="true" style="height: 500px;">
                                            <div class="kt-notes__items">
                                            <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="kt-notes__item">
                                                    <div class="kt-notes__media">
                                                        <span class="kt-notes__icon">
                                                            <img src="<?php echo $comment->user->avatar_url; ?>" height="50px">
                                                        </span>
                                                    </div>
                                                    <div class="kt-notes__content">
                                                        <div class="kt-notes__section">
                                                            <div class="kt-notes__info">
                                                                <a href="#" class="kt-notes__title">
                                                                    <?php echo e($comment->user->first_name); ?> <?php echo e($comment->user->last_name); ?>

                                                                </a>
                                                                <span class="kt-notes__desc">
                                                                    <?php echo e(Carbon\Carbon::parse($comment->created_at)->format('Y-m-d H:i')); ?>

                                                                </span>
                                                            </div>
                                                        </div>
                                                        <span class="kt-notes__body">
                                                            <?php echo e($comment->content); ?>

                                                        </span>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\medyas\resources\views/participants/comments.blade.php ENDPATH**/ ?>