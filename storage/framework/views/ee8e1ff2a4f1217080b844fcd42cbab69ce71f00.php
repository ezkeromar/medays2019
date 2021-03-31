    
<?php $__env->startSection('content'); ?>
    <main class="content">
    <div class="content__step content__step--step3">
            <div class="inscription">
              <h1 class="inscription__title title__primary">
                <?php echo e(__('front.'.$lang.'.inscriptionrequest')); ?>

              </h1>
              <form class="form">
                <label class="form__simple-label" for="nbrId"
                  ><?php echo e(__('front.'.$lang.'.motivation')); ?></label
                >
                <div class="form__group">
                  <input
                    class="form__input"
                    type="text"
                    alt=""
                    placeholder=""
                    id="motivation"
                    required
                  />
                </div>
                <div
                  class="form__group form__group--push-bottom form__group--right-content "
                >
                  <button class="btn btn--left-arrow btn--secondary">
                    <?php echo e(__('front.'.$lang.'.previous')); ?>

                  </button>
                  <button class="btn btn--right-arrow btn--primary">
                    <?php echo e(__('front.'.$lang.'.next')); ?>

                  </button>
                </div>
              </form>
              <p class="inscription__tip">* <?php echo e(__('front.'.$lang.'.requiredfields')); ?></p>
            </div>
            <div class="info">
              <div class="info__steps">
                <div class="info__step info__step--1 ">
                  <span>1</span>
                </div>
                <div class="info__step info__step--2"><span>2</span></div>
                <div class="info__step info__step--3 info__step--active">
                  <span>3</span>
                </div>
              </div>
              <div class="info__content">
                <div class="info__tips">
                  <svg class="info__logo">
                    <image xlink:href="/img/icon-info-perso.svg" />
                  </svg>
                  <h2 class="title__secondary"><?php echo e(__('front.'.$lang.'.motivationtitle')); ?></h2>
                  <div class="info__desp">
                    <?php echo e(__('front.'.$lang.'.motivationexpliq')); ?>

                    <?php echo e(__('front.'.$lang.'.atteindmedyas')); ?>

                  </div>
                </div>
                <div class="info__contact">
                  <h2 class="title__secondary"><?php echo e(__('front.'.$lang.'.amadeuxonstitut')); ?></h2>
                  <p class="info__desp">
                      <?php echo e(__('front.'.$lang.'.contactusforinfo')); ?>


                    <a href="#" class="info__link"
                      >inscriptions@amadeusonline.org</a
                    >
                    <a href="#" class="info__link">www.medays.org</a>
                  </p>
                </div>
              </div>
            </div>
          </div> 
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('registerFront', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\medyas\resources\views/front/stepfour.blade.php ENDPATH**/ ?>