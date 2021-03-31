<div class="content__step content__step--transfert">
              <div class="inscription">
                  <h1 class="inscription__title title__primary">
                      <?php echo e(__('front.'.$lang.'.transfer')); ?>

                  </h1>
    
                      <h2 class="title__secondary"><?php echo e(__('front.'.$lang.'.arriveflight')); ?></h2>
                      <div class="form__group required">

                        <input
                          class="form__input datepicker"
                          type="text"
                          alt="<?php echo e(__('front.'.$lang.'.arrivaldate')); ?>"
                          id="dateArrivee"
                          placeholder="<?php echo e(__('front.'.$lang.'.arrivaldateff')); ?> "
                          name="transfer_arrival_date"
                          value="<?php echo e(!empty($participant->transfer_arrival_date) ? $participant->transfer_arrival_date : ''); ?>"
                        />
                        <label class="form__label" for="dateArrivee"
                          ><?php echo e(__('front.'.$lang.'.arrivaldate')); ?></label
                        >
                      </div> 
                      <div class="form__group required">

                        <input
                          class="form__input timepicker"
                          type="text"
                          
                          alt="<?php echo e(__('front.'.$lang.'.arrivingtime')); ?>"
                          name="transfer_arrival_time"
                          id="heureArrivee"
                          placeholder="<?php echo e(__('front.'.$lang.'.arrivingtime')); ?> (hh:mm)"
                          value="<?php echo e(!empty($participant->transfer_arrival_time) ? $participant->transfer_arrival_time : ''); ?>"

                        />
                        <label class="form__label" for="heureArrivee"
                          ><?php echo e(__('front.'.$lang.'.arrivingtime')); ?></label
                        >
                      </div>

                      <div class="form__group required">
                          <input
                            class="form__input"
                            type="text"
                            alt="<?php echo e(__('front.'.$lang.'.flightnumber')); ?>"
                            placeholder="<?php echo e(__('front.'.$lang.'.flightnumber')); ?>"
                            id="numvol"
                            name="arrival_flight_number"
                            value="<?php echo e(!empty($participant->arrival_flight_number) ? $participant->arrival_flight_number : ''); ?>"
                          />
                          <label class="form__label" for="numvol"
                            ><?php echo e(__('front.'.$lang.'.flightnumber')); ?></label
                          >
                        </div>
                        <div class="form__group required">
                            <input
                              class="form__input"
                              type="text"
                              alt="<?php echo e(__('front.'.$lang.'.aeriennecompagny')); ?>"
                              placeholder="<?php echo e(__('front.'.$lang.'.aeriennecompagny')); ?>"
                              id="compArienne"
                              name="arrival_airline_company"
                              value="<?php echo e(!empty($participant->arrival_airline_company) ? $participant->arrival_airline_company : ''); ?>"
                            />
                            <label class="form__label" for="compArienne"
                              ><?php echo e(__('front.'.$lang.'.aeriennecompagny')); ?></label
                            >
                          </div>
                    <div class="form__group required">
                      <input
                        class="form__input"
                        type="text"
                        alt="<?php echo e(__('front.'.$lang.'.aeroportprev')); ?>"
                        placeholder="<?php echo e(__('front.'.$lang.'.aeroportprev')); ?>"
                        id="aeroPort_prov"
                        name="arrival_airport"
                        value="<?php echo e($participant->arrival_airport); ?>"
                      />
                      <label class="form__label" for="aeroPort_prov"
                        ><?php echo e(__('front.'.$lang.'.aeroportprev')); ?></label
                      >
                    </div>
    
                    <div class="form__group form__group--selector required">
                      <select name="arrival_recovery_point" class="form__selector">
                        <option value="none" disabled selected
                          ><?php echo e(__('front.'.$lang.'.airportofarrival')); ?></option
                        >
                          <?php $__currentLoopData = config('meDays.airports'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if($item['id']!=4): ?>
                              <option value="<?php echo e($item['id']); ?>" <?php echo e($item['id'] == $participant->arrival_recovery_point ? 'selected="selected"' : ''); ?>><?php echo e($item['name']); ?></option>
                              <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                    <h2 class="title__secondary"><?php echo e(__('front.'.$lang.'.voldepart')); ?></h2> 
                    <div class="form__group required">

                      <input
                        class="form__input datepicker"
                        type="text"
                        alt="<?php echo e(__('front.'.$lang.'.arrivaldate')); ?>"
                        
                        id="dateDepart_transfert"
                        placeholder="<?php echo e(__('front.'.$lang.'.arrivaldatef')); ?> "
                        name="transfer_departure_date"
                        value="<?php echo e(!empty($participant->transfer_departure_date) ? $participant->transfer_departure_date : ''); ?>"
                      />
                      <label class="form__label" for="dateDepart_transfert"
                        ><?php echo e(__('front.'.$lang.'.arrivaldate')); ?></label
                      >
                    </div> 
                    <div class="form__group required">

                      <input
                        class="form__input timepicker"
                        type="text"
                        
                        alt="<?php echo e(__('front.'.$lang.'.departuretime')); ?>"
                        name="transfer_departure_time"
                        id="heureDepart_transfert"
                        placeholder="<?php echo e(__('front.'.$lang.'.departuretime')); ?> (hh:mm)"
                        value="<?php echo e(!empty($participant->transfer_departure_time) ? $participant->transfer_departure_time : ''); ?>"
                        
                      />
                      <label class="form__label" for="heureDepart_transfert"
                        ><?php echo e(__('front.'.$lang.'.departuretime')); ?></label
                      >
                    </div>
                    <div class="form__group required">
                        <input
                          class="form__input"
                          type="text"
                          alt="<?php echo e(__('front.'.$lang.'.flightnumber')); ?>"
                          placeholder="<?php echo e(__('front.'.$lang.'.flightnumber')); ?>"
                          id="numvol"
                          name="departure_flight_number"
                          value="<?php echo e(!empty($participant->departure_flight_number) ? $participant->departure_flight_number : ''); ?>"
                        />
                        <label class="form__label" for="numvol"
                          ><?php echo e(__('front.'.$lang.'.flightnumber')); ?></label
                        >
                      </div>
                      <div class="form__group required">
                          <input
                            class="form__input"
                            type="text"
                            alt="<?php echo e(__('front.'.$lang.'.aeriennecompagny')); ?>"
                            placeholder="<?php echo e(__('front.'.$lang.'.aeriennecompagny')); ?>"
                            id="compArienne"
                            name="departure_airline_company"
                            value="<?php echo e(!empty($participant->departure_airline_company) ? $participant->departure_airline_company : ''); ?>"
                          />
                          <label class="form__label" for="compArienne"
                            ><?php echo e(__('front.'.$lang.'.aeriennecompagny')); ?></label
                          >
                        </div>
                    <div class="form__group form__group--selector required">
                      <select name="departure_deposit_point" class="form__selector">
                          <option value="none" disabled selected><?php echo e(__('front.'.$lang.'.departaerport')); ?></option>
                          <?php $__currentLoopData = config('meDays.airports'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($item['id']!=4): ?>
                              <option value="<?php echo e($item['id']); ?>" <?php echo e($item['id'] == $participant->departure_deposit_point ? 'selected="selected"' : ''); ?>><?php echo e($item['name']); ?></option>
                            <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                     <div class="form__group required">
                       <input
                       class="form__input"
                       type="text"
                       alt="<?php echo e(__('front.'.$lang.'.aeroportdes')); ?>"
                       placeholder="<?php echo e(__('front.'.$lang.'.aeroportdes')); ?>"
                       name="departure_airport"
                       value="<?php echo e($participant->departure_airport); ?>"
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
                          <button data-pstep="content__step--transfert" class="btn btn--right-arrow btn--primary dgotosejour">
                            <span>
                              <?php echo e(__('front.'.$lang.'.next')); ?>

                            </span>
                          </button>
                        <?php else: ?>
                          <?php if($participant->type_id == 2 || $participant->type_id == 3 && $lang == 'fr'): ?>
                          <button data-pstep="content__step--transfert" class="btn btn--right-arrow btn--primary dgotoformation">
                            <span>
                              <?php echo e(__('front.'.$lang.'.next')); ?>

                            </span>
                          </button>
                          <?php else: ?>
                          <input data-pstep="content__step--transfert" type="submit" class="btn btn--right-arrow btn--primary dsubmit" value="<?php echo e(__('front.'.$lang.'.next')); ?>" />
                          <?php endif; ?>
                        <?php endif; ?>
                      </div>
                  <p class="inscription__tip">* <?php echo e(__('front.'.$lang.'.requiredfields')); ?></p>
                </div>
             
                <div class="info">
                  <div class="info__content">
                    <div class="info__tips">
                      <h2 class="title__secondary"><?php echo e(__('front.'.$lang.'.transfer')); ?></h2>
                      <div class="info__desp">
                        <?php echo e(__('front.'.$lang.'.transferdesc')); ?>

                       
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

          </div><?php /**PATH C:\laragon\www\medyas\resources\views/front/transferstep.blade.php ENDPATH**/ ?>