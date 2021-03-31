<div class="content__step content__step--step3">
            <div class="inscription">
              <h1 class="inscription__title title__primary">
                <?php echo e(__('front.'.$lang.'.inscriptionrequest')); ?>

              </h1>
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
                    name="motivation"
                  />
                </div>
                <div
                  class="form__group form__group--push-bottom form__group--right-content "
                  style="position: relative;"
                >
                  <button class="btn btn--left-arrow btn--secondary goback">
                    <?php echo e(__('front.'.$lang.'.previous')); ?>

                  </button>
                  <?php if(app('request')->input('type') == 7 || $lang == 'en'): ?>
                    <input type="submit" class="btn btn--right-arrow btn--primary submitformfrommotiv" value="<?php echo e(__('front.'.$lang.'.next')); ?>" />  
                  <?php else: ?>
                    <button class="btn btn--right-arrow btn--primary gotoformationfrommotiv">
                      <?php echo e(__('front.'.$lang.'.next')); ?>

                    </button>
                  <?php endif; ?>
                </div>
              <p class="inscription__tip">* <?php echo e(__('front.'.$lang.'.requiredfields')); ?></p>
            </div>
            <div class="info">
              <div class="info__content">
                <div class="info__tips">
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


                    <?php if(empty($type_id)): ?>
                      <a href="mailto:inscriptions@amadeusonline.org" target="_blank" class="info__link">inscriptions@amadeusonline.org</a>
                    <?php elseif($type_id == 2 || $type_id == 3): ?>
                      <a href="mailto:premium@amadeusonline.org" target="_blank" class="info__link">premium@amadeusonline.org</a>
                    <?php elseif($type_id == 2 && $type_id == 3): ?>
                      <a href="mailto:medays2019@amadeusonline.org" target="_blank" class="info__link">medays2019@amadeusonline.org</a>
                    <?php elseif($type_id == 4): ?>
                    <a href="medays2019@amadeusonline.org" target="_blank" class="info__link">medays2019@amadeusonline.org</a>
                    <?php endif; ?>
                    <a href="http://www.medays.org" target="_blank" class="info__link">www.medays.org</a>
                  </p>
                </div>
              </div>
            </div>
    </div><?php /**PATH C:\laragon\www\medyas\resources\views/front/motivationstep.blade.php ENDPATH**/ ?>