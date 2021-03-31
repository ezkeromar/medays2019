<div class="content__step content__step--pec">
            <div class="inscription">
              <h1 class="inscription__title title__primary">
                <?php echo e(__('front.'.$lang.'.flightticket')); ?>

              </h1>
                
                  <h2 class="title__secondary"><?php echo e(__('front.'.$lang.'.arriveflight')); ?></h2>
                  
                 
                <div class="form__group required">

                  <input
                    class="form__input datepicker"
                    type="text"
                    alt="<?php echo e(__('front.'.$lang.'.arrivaldate')); ?>"
                    name="desired_arrival_date"
                    id="dateArrivee"
                    placeholder="<?php echo e(__('front.'.$lang.'.dateformat')); ?>"
                    value="<?php echo e(!empty($participant->desired_arrival_date) ? $participant->desired_arrival_date : ''); ?>"

                  />
                  <label class="form__label" for="dateArrivee"
                    ><?php echo e(__('front.'.$lang.'.arrivaldate')); ?></label
                  >
                </div>

                <div class="form__group form__group--selector required">
                  <select name="desired_arrival_hour" class="form__selector">
                    <option value="none" disabled <?php echo e((empty($participant->desired_arrival_hour)) ? 'selected' : ''); ?>><?php echo e(__('front.'.$lang.'.wantedhour')); ?></option>
                    <option value="1" <?php echo e(($participant->desired_arrival_hour == 1) ? 'selected' : ''); ?>><?php echo e(__('front.'.$lang.'.morning')); ?></option>
                    <option value="2" <?php echo e(($participant->desired_arrival_hour == 2) ? 'selected' : ''); ?>><?php echo e(__('front.'.$lang.'.afterlunch')); ?></option>
                    <option value="3" <?php echo e(($participant->desired_arrival_hour == 3) ? 'selected' : ''); ?>><?php echo e(__('front.'.$lang.'.night')); ?></option>
                  </select>
                </div>

                
                <div class="form__group required">

                  <input
                    class="form__input"
                    type="text"
                    alt="Aéroport de provenance"
                    placeholder="<?php echo e(__('front.'.$lang.'.aeroportprev')); ?>"
                    name="pec_departure_airport"
                    value="<?php echo e($participant->pec_departure_airport); ?>"
                    id="aeroPort_prov"
                  />
                  <label class="form__label" for="aeroPort_prov"
                    ><?php echo e(__('front.'.$lang.'.aeroportprev')); ?></label
                  >
                </div>

              <!--  <div class="form__group form__group--selector required">
                  <select name="pec_arrival_airport" class="form__selector">
                    <option value="none" disabled selected>Aéroport d'arrivée</option>
                    <?php $__currentLoopData = config('meDays.airports'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($item['id']); ?>" <?php echo e($item['id'] == $participant->pec_arrival_airport ? 'selected="selected"' : ''); ?>><?php echo e($item['name']); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div> -->
                <hr style="margin-bottom: 15px;">
                <h2 class="title__secondary"><?php echo e(__('front.'.$lang.'.voldepart')); ?></h2> 
                 <div class="form__group required">

                  <input
                    class="form__input datepicker"
                    type="text"
                    alt="<?php echo e(__('front.'.$lang.'.departuredate')); ?>"
                    name="desired_departure_date"
                    id="dateDepart"
                    placeholder="<?php echo e(__('front.'.$lang.'.dateformat')); ?>"
                    value="<?php echo e(!empty($participant->desired_departure_date) ? $participant->desired_departure_date : ''); ?>"

                  />
                  <label class="form__label" for="dateDepart"
                    ><?php echo e(__('front.'.$lang.'.departuredate')); ?></label
                  >
                </div>

                <div class="form__group form__group--selector required">
                  <select name="desired_departure_hour" class="form__selector">
                    <option value="none" disabled <?php echo e((empty($participant->desired_departure_hour)) ? 'selected' : ''); ?>><?php echo e(__('front.'.$lang.'.wantedhour')); ?></option>
                    <option value="1" <?php echo e(($participant->desired_departure_hour == 1) ? 'selected' : ''); ?>><?php echo e(__('front.'.$lang.'.morning')); ?></option>
                    <option value="2" <?php echo e(($participant->desired_departure_hour == 2) ? 'selected' : ''); ?>><?php echo e(__('front.'.$lang.'.afterlunch')); ?></option>
                    <option value="3" <?php echo e(($participant->desired_departure_hour == 3) ? 'selected' : ''); ?>><?php echo e(__('front.'.$lang.'.night')); ?></option>
                  </select>
                </div>
               <!-- <div class="form__group form__group--selector required">
                  <select name="pec_departure_airport" class="form__selector">
                      <option value="none" disabled selected>Aéroport de départ</option>
                    <?php $__currentLoopData = config('meDays.airports'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($item['id']); ?>" <?php echo e($item['id'] == $participant->departure_airport ? 'selected="selected"' : ''); ?>><?php echo e($item['name']); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div> -->
                 <div class="form__group required">
                   <input
                   class="form__input"
                   type="text"
                   alt="<?php echo e(__('front.'.$lang.'.aeroportdes')); ?>"
                   placeholder="<?php echo e(__('front.'.$lang.'.aeroportdes')); ?>"
                   name="pec_arrival_airport"
                   value="<?php echo e($participant->pec_arrival_airport); ?>"
                   id="aeroPort_dest"
                   />
                   <label class="form__label" for="aeroPort_dest"
                   ><?php echo e(__('front.'.$lang.'.aeroportdes')); ?></label
                   >
                  </div>
                  <div
                    class="form__group  form__group--right-content "
                  >
                    <button class="btn btn--left-arrow btn--secondary goback">
                      <span>
                      <?php echo e(__('front.'.$lang.'.previous')); ?>

                      </span>
                    </button>
                    <?php if($participant->has_hebergement == 2): ?>
                      <button data-pstep="content__step--pec" class="btn btn--right-arrow btn--primary dgotosejour">
                        <span>
                          <?php echo e(__('front.'.$lang.'.next')); ?>

                        </span>
                      </button>
                    <?php else: ?>
                      <?php if($participant->type_id == 2 || $participant->type_id == 3 && $lang == 'fr'): ?>
                        <button data-pstep="content__step--pec" class="btn btn--right-arrow btn--primary dgotoformation">
                          <span>
                            <?php echo e(__('front.'.$lang.'.next')); ?>

                          </span>
                        </button>
                      <?php else: ?>
                        <input data-pstep="content__step--pec" type="submit" class="btn btn--right-arrow btn--primary dsubmit" value="<?php echo e(__('front.'.$lang.'.next')); ?>" />
                      <?php endif; ?>
                    <?php endif; ?>
                  </div>
              <p class="inscription__tip">* <?php echo e(__('front.'.$lang.'.requiredfields')); ?></p>
            </div>
         
            <div class="info">
              <div class="info__content">
                <div class="info__tips">
                  <h2 class="title__secondary"><?php echo e(__('front.'.$lang.'.flightticket')); ?></h2>
                  <div class="info__desp">
                    <?php echo e(__('front.'.$lang.'.flightticketdesc')); ?>

                    <p>
                      <?php echo e(__('front.'.$lang.'.aeroportcasa')); ?>

                    </p>
                    <p>
                      <?php echo e(__('front.'.$lang.'.aeroportrabat')); ?>

                    </p>
                    <p>
                      <?php echo e(__('front.'.$lang.'.aeroporttanger')); ?>

                    </p>
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
                        <a href="http://www.medays.org" class="info__link">www.medays.org</a>
                  </p>
                </div>
              </div>
            </div>
</div><?php /**PATH C:\laragon\www\medyas\resources\views/front/flightstep.blade.php ENDPATH**/ ?>