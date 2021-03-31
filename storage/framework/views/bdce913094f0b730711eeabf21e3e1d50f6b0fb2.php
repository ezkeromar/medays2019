    
<?php $__env->startSection('content'); ?>
    <main class="content">
    <div class="content__step content__step--step2"> 
            <div class="inscription">
              <h1 class="inscription__title title__primary">
                <?php echo e(__('front.'.$lang.'.inscriptionrequest')); ?>

              </h1>

              <form class="form">
                <div class="form__group form__group--selector required">
                  <select name="nationality" class="form__selector">
                    <option value="" disabled selected><?php echo e(__('front.'.$lang.'.inscriptionrequest')); ?></option>
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($country)): ?>
                            <option value="<?php echo e($key); ?>"><?php echo e(utf8_decode($country)); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                <div class="form__group required">
                  <input
                    class="form__input"
                    type="text"
                    alt="city"
                    placeholder="<?php echo e(__('front.'.$lang.'.city')); ?>"
                    id="city"
                    required
                  />
                  <label class="form__label" for="city"><?php echo e(__('front.'.$lang.'.city')); ?></label>
                </div>
                <div class="form__group required">
                  <input
                    class="form__input"
                    type="text"
                    alt="Email"
                    placeholder="<?php echo e(__('front.'.$lang.'.email')); ?>"
                    id="email"
                    required
                  />
                  <label class="form__label" for="email"><?php echo e(__('front.'.$lang.'.email')); ?></label>
                </div>
                <div class="form__group required">
                  <input
                    class="form__input"
                    type="text"
                    alt="<?php echo e(__('front.'.$lang.'.professionalphone')); ?>"
                    placeholder="<?php echo e(__('front.'.$lang.'.professionalphone')); ?>"
                    id="teleprof"
                    required
                  />
                  <label class="form__label" for="teleprof"
                    ><?php echo e(__('front.'.$lang.'.professionalphone')); ?></label
                  >
                </div>
                <div class="form__group required">
                  <input
                    class="form__input"
                    type="text"
                    alt="<?php echo e(__('front.'.$lang.'.mobilephone')); ?>"
                    placeholder="<?php echo e(__('front.'.$lang.'.mobilephone')); ?>"
                    id="telemob"
                    required
                  />
                  <label class="form__label" for="telemob"
                    ><?php echo e(__('front.'.$lang.'.mobilephone')); ?></label
                  >
                </div>
                <div class="form__group">
                  <span class="form__simple-label"
                    ><?php echo e(__('front.'.$lang.'.ID')); ?> <span class="form__etoile">*</span></span
                  >

                  <div class="form__radio-group">
                    <input
                      class="form__radio-input"
                      type="radio"
                      name="size"
                      id="small"
                    />
                    <label class="form__radio-label" for="small">
                      <span class="form__radio-button"></span>
                      <?php echo e(__('front.'.$lang.'.cin')); ?></label
                    >
                  </div>

                  <div class="form__radio-group">
                    <input
                      class="form__radio-input"
                      type="radio"
                      name="size"
                      id="large"
                    />
                    <label class="form__radio-label" for="large">
                      <span class="form__radio-button"></span>
                      <?php echo e(__('front.'.$lang.'.passport')); ?></label
                    >
                  </div>
                </div>

                <div class="form__group required">
                  <input
                    class="form__input"
                    type="file"
                    alt="nbrId"
                    placeholder="<?php echo e(__('front.'.$lang.'.idnumber')); ?>"
                    id="nbrId"
                    required
                  />
                  <label class="form__label" for="nbrId"
                    ><?php echo e(__('front.'.$lang.'.idnumber')); ?></label
                  >
                </div>

                <div class="form__group form__group--right-content">
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
                <div class="info__step info__step--2 info__step--active">
                  <span>2</span>
                </div>
                <div class="info__step info__step--3"><span>3</span></div>
              </div>
              <div class="info__content">
                <div class="info__tips">
                  <svg class="info__logo">
                    <image xlink:href="/img/icon-info-perso.svg" />
                  </svg>
                  <h2 class="title__secondary"><?php echo e(__('front.'.$lang.'.personalinformations')); ?></h2>
                  <div class="info__desp">
                    <?php echo e(__('front.'.$lang.'.thankstoaddinfovalide')); ?>

                    <?php echo e(__('front.'.$lang.'.requestbestcondition')); ?>

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
<?php echo $__env->make('registerFront', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\medyas\resources\views/front/stepthree.blade.php ENDPATH**/ ?>