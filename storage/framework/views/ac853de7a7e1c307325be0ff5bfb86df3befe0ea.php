
<div class="content__step content__step--step1">
            <div class="inscription">
              <h1 class="inscription__title title__primary">
              <?php echo e(__('front.'.$lang.'.inscriptionrequest')); ?>

              </h1>
                <?php echo e(csrf_field()); ?>

                <div class="form__group">
                  <div class="form__radio-group">
                    <input
                      class="form__radio-input"
                      type="radio"
                      name="civility"
                      value="1"
                      id="small"
                      <?php echo e((!empty($participant->civility) && $participant->civility == 1) ? 'checked' : ''); ?>

                      <?php echo e((empty($participant->civility)) ? 'checked' : ''); ?>

                    />
                    <label class="form__radio-label" for="small">
                      <span class="form__radio-button"></span>
                      <?php echo e(__('front.'.$lang.'.madame')); ?></label
                    >
                  </div>
                  <div class="form__radio-group">
                    <input
                      class="form__radio-input"
                      type="radio"
                      name="civility"
                      value="2"
                      id="large"
                      <?php echo e((!empty($participant->civility) && $participant->civility == 2) ? 'checked' : ''); ?>

                    />
                    <label class="form__radio-label" for="large">
                      <span class="form__radio-button"></span>
                      <?php echo e(__('front.'.$lang.'.monsieu')); ?></label
                    >
                  </div>
                </div>
                <div class="form__group required">
                  <input
                    class="form__input"
                    value="<?php echo e((!empty($participant->first_name)) ? $participant->first_name : ''); ?>"
                    type="text"
                    alt="First name"
                    name="first_name"
                    placeholder="<?php echo e(__('front.'.$lang.'.firstname')); ?>"
                    id="firstname"
                  />
                  <label class="form__label" for="firstname"><?php echo e(__('front.'.$lang.'.firstname')); ?></label>
                </div>
                <div class="form__group required">
                  <input
                    class="form__input"
                    value="<?php echo e((!empty($participant->last_name)) ? $participant->last_name : ''); ?>"
                    type="text"
                    alt="Last name"
                    name="last_name"
                    placeholder="<?php echo e(__('front.'.$lang.'.lastname')); ?>"
                    id="lastname"
                  />
                  <label class="form__label" for="lastname"><?php echo e(__('front.'.$lang.'.lastname')); ?></label>
                </div>
                <div class="form__group required">
                  <input
                    class="form__input"
                    value="<?php echo e((!empty($participant->organization)) ? $participant->organization : ''); ?>"
                    type="text"
                    alt="Organisme"
                    name="organization"
                    placeholder="<?php echo e(__('front.'.$lang.'.organism')); ?>"
                    id="organisme"
                  />
                  <label class="form__label" for="organisme"><?php echo e(__('front.'.$lang.'.organism')); ?></label>
                </div>
                <div class="form__group required">
                  <input
                    class="form__input"
                    value="<?php echo e((!empty($participant->function)) ? $participant->function : ''); ?>"
                    type="text"
                    alt="fonction"
                    name="function"
                    placeholder="<?php echo e(__('front.'.$lang.'.function')); ?>"
                    id="fonction"
                  />
                  <label class="form__label" for="fonction"><?php echo e(__('front.'.$lang.'.function')); ?></label>
                </div>
                <div class="form__group form__group--selector required">
                  <select name="nationality" class="form__selector">
                    <option value="none" disabled <?php echo e((empty($participant->nationality)) ? 'selected' : ''); ?>><?php echo e(__('front.'.$lang.'.origincountry')); ?></option>
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($country)): ?>
                        <option <?php echo e((!empty($participant->nationality) && $participant->nationality == $country->code2) ? 'selected="selected"' : ''); ?> value="<?php echo e($country->code2); ?>">
                          <?php echo $lang =='fr' ? $country->name_fr : $country->name_en; ?>

                        </option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                <div class="form__group required">
                  <input 
                    class="form__input" 
                    value="<?php echo e((!empty($participant->birthday)) ? $participant->birthday : ''); ?>" 
                    name="birthday" 
                    type="text" 
                    maxlength="10" 
                    placeholder="<?php echo e(__('front.'.$lang.'.dateformat')); ?>" 
                    alt="" 
                    id="birthdate"/>
                  <label class="form__label" for="birthdate"
                    ><?php echo e(__('front.'.$lang.'.birthday')); ?></label
                  >
                </div>
                <input type="hidden" value="<?php echo e($lang); ?>" name="language" />
                <input type="hidden" value="<?php echo e(app('request')->input('type')); ?>" name="type" />
                <div class="form__group form__group--right-content">
                  <button class="btn btn--with-arrow btn--primary gosteptow">
                    <?php echo e(__('front.'.$lang.'.next')); ?>

                  </button>
                </div>
              <p class="inscription__tip">* <?php echo e(__('front.'.$lang.'.requiredfields')); ?></p>
            </div>
            <div class="info">
              <div class="info__content">
                <div class="info__tips">
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
</div><?php /**PATH C:\laragon\www\medyas\resources\views/front/substepone.blade.php ENDPATH**/ ?>