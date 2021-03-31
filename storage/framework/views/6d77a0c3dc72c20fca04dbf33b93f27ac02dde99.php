<div class="content__step content__step--formation">
            <div class="inscription">
              <h1 class="title__primary">
                FORMATIONS CERTIFIANTES PAYANTE MEDAYS 2019
              </h1>
              <p class="inscription__tipone" style="margin-bottom: 20px; font-size: 13px;">* La participation aux MEDays est totalement gratuite. Si vous n’êtes pas intéressé par la formation, prière d’appuyer sur le bouton “Suivant” pour finaliser votre inscription.</p>
                <h2 class="title__secondary">
                SOUHAITEZ-VOUS PARTICIPER À L’UNE DES FORMATIONS PROPOSÉES LORS DES MEDAYS 2019 ?
                </h2>
                <p class="form__radio-label">Au-delà de votre participation au Forum, il vous est possible de vous inscrire à l&#39;une des formations certifiantes suivantes proposées par l&#39;Institut Amadeus en partenariat avec le département Sciences Po de l&#39;Université Internationale de Rabat :</p>
                <div class="form__group" style="padding-top: 35px;">
                  <div class="form__radio-group">
                    <input
                      class="form__radio-input"
                      type="radio"
                      name="formation_name"
                      id="formationone"
                      value="1"
                    />
                    <label class="form__radio-label" for="formationone">
                      <span class="form__radio-button"></span>
                      Intelligence économique. -- <b>9 900 Dhs HT</b></label
                    >
                  </div>

                  <div class="form__radio-group">
                    <input
                      class="form__radio-input"
                      type="radio"
                      name="formation_name"
                      id="formationtow"
                      value="2"
                    />
                    <label class="form__radio-label" for="formationtow">
                      <span class="form__radio-button"></span>
                      ZLECA : quels mécanismes et quelles opportunités pour les
                      entreprises marocaines ? -- <b>9 900 Dhs HT</b></label
                    >
                  </div>
                </div>
                <div class="form__group form__group--right-content">
                  <button class="btn btn--left-arrow btn--secondary goback">
                    <span>
                      precedent
                    </span>
                  </button>
                  <!-- <button class="btn btn--right-arrow btn--primary">
                    <span>
                      suivant
                    </span>
                  </button> -->
                  <input type="submit" class="btn btn--right-arrow btn--primary" value="<?php echo e(__('front.'.$lang.'.next')); ?>" />
                </div>
            </div>
            <div class="info">
              <div class="info__content">
                <div class="info__tips">
                  <h2 class="title__secondary">formations medays 2019</h2>
                  <p class="info__desp" style="padding-top:40px;">
                    Souhaitez-vous participer à l’une des formations proposées
                    lors des MEDAYS 2019?
                    <br />

                    <a target="_blank" href="http://www.medays.org/fr/formation/"  class="info__link"> Plus de détails +</a>
                  </p>
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
                    <a target="_blank" href="http://www.medays.org" class="info__link">www.medays.org</a>
                  </p>
                </div>
              </div>
            </div>
    </div><?php /**PATH C:\laragon\www\medyas\resources\views/front/formationstep.blade.php ENDPATH**/ ?>