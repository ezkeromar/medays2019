<?php $__env->startSection('template_title'); ?>
    <?php echo e('Profile Participant'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_toolbar'); ?>
    <div class="kt-subheader__group" id="kt_subheader_group_actions">
        <!-- <div class="btn-toolbar kt-margin-l-20">
            <button class="btn btn-label-success btn-bold btn-sm btn-icon-h" id="kt_sweetalert_demo_6">
                Valider
            </button>
            <button class="btn btn-label-danger btn-bold btn-sm btn-icon-h" id="kt_sweetalert_demo_8">
                Refuser
            </button>
        </div> -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!--Begin:: Portlet-->
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
        <!--Begin:: App Aside Mobile Toggle-->
        <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
            <i class="la la-close"></i>
        </button>
        <!--End:: App Aside Mobile Toggle-->

        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    <!--begin:: Widgets/Order Statistics-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Ajouter un participant
                                </h3>
                            </div>
                        </div>
                        <form method="POST" action="/add/participant" class="kt-form kt-form--label-right">
                            <?php echo csrf_field(); ?>

                            <input type='hidden' value="<?php echo e(app('request')->input('ref')); ?>" name="ref" />
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Type de participant :</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Type :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select class="form-control kt-selectpicker kt-types-form" name="type">
                                                <?php if(empty(app('request')->input('ref'))): ?>
                                                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <optgroup label="<?php echo e(($key == 1) ? 'PARTICIPANTS' : (($key == 2) ? 'PRESSE - SPONSORS' : 'ORGANISATION')); ?>">
                                                    <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($t->name != 'Conjoint' && $t->name != 'Délégation'): ?>
                                                    <option value="<?php echo e($t->id); ?>" <?php echo e(($t->id == 4 || $t->id == 5) ? 'data-niveau="true"': ""); ?> <?php echo e((old("type_id") == $t->id) ? "selected": ""); ?>><?php echo e($t->name); ?></option>
                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </optgroup>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($key == 1): ?>
                                                    <optgroup label="PARTICIPANTS">
                                                    <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($t->name == 'Conjoint' || $t->name == 'Délégation'): ?>
                                                    <option value="<?php echo e($t->id); ?>" <?php echo e(($t->id == 4 || $t->id == 5) ? 'data-niveau="true"': ""); ?> <?php echo e((old("type_id") == $t->id || $t->name == 'Délégation') ? "selected": ""); ?>><?php echo e($t->name); ?></option>
                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </optgroup>
                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                                    </select>
                                                </select>
                                            </div>
                                            <?php if ($errors->has('type')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('type'); ?>
                                                <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                        </div>
                                        <?php if(empty(app('request')->input('ref'))): ?>
                                        <div class="form-group row kt-niveau <?php echo e((old('type_id') != '4' && old('type_id') != '5') ? 'kt-hidden': ''); ?>">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Niveau :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select class="form-control kt-selectpicker" name="level">
                                                    <option value="">Choisir un niveau...</option>
                                                    <option value="1" <?php echo e((old("level") == "1") ? "selected": "selected"); ?>>Niveau 1</option>
                                                    <option value="2" <?php echo e((old("level") == "2") ? "selected": ""); ?>>Niveau 2</option>
                                                    <option value="3" <?php echo e((old("level") == "3") ? "selected": ""); ?>>Niveau 3</option>
                                                </select>
                                            </div>
                                            <?php if ($errors->has('level')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('level'); ?>
                                                <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                        </div>
                                        <?php endif; ?>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                        <div class="kt-section" style="width: 100%">
                                            <div class="kt-section__body">
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">Informations personnelles :</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Langue :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-radio-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="language" value="fr" <?php echo e((old("language") == "fr") ? "checked": ""); ?>> Français
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="language" value="en" <?php echo e((old("language") == "en") ? "checked": ""); ?>> Anglais
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <?php if ($errors->has('language')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('language'); ?>
                                                        <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Civilité :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-radio-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="civility" value="1" <?php echo e((old("civility") == "1") ? "checked": ""); ?>> Madame
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="civility" value="2" <?php echo e((old("civility") == "2") ? "checked": ""); ?>> Monsieur
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <?php if ($errors->has('civility')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('civility'); ?>
                                                        <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Prénom :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="first_name" id="" value='<?php echo e(old("first_name")); ?>'>
                                                    </div>
                                                    <?php if ($errors->has('first_name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('first_name'); ?>
                                                        <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Nom :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="last_name" id="" value='<?php echo e(old("last_name")); ?>'>
                                                    </div>
                                                    <?php if ($errors->has('last_name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('last_name'); ?>
                                                        <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Date de naissance :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type='date' class="form-control dateField" id="" name="birthday" value='<?php echo e(old("birthday")); ?>'
                                                        min="1901-01-01" max="2000-12-31"
                                                        >
                                                    </div>
                                                    <?php if ($errors->has('birthday')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('birthday'); ?>
                                                        <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Organisme :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="organization" id="" value='<?php echo e(old("organization")); ?>'>
                                                    </div>
                                                    <?php if ($errors->has('organization')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('organization'); ?>
                                                        <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Fonction :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="function" id="" value='<?php echo e(old("function")); ?>'>
                                                    </div>
                                                    <?php if ($errors->has('function')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('function'); ?>
                                                        <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Pays de nationalité :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <select class="form-control countrySelect" name="nationality" id="nationality">
                                                            <option value="">Choix du pays</option>
                                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if(!empty($country)): ?>
                                                                    <option value="<?php echo e($country->code2); ?>" <?php echo e(($country->code2 == old('nationality')) ? 'selected="selected"' : ''); ?>>
                                                                        <?php echo e($country->name_fr); ?>

                                                                    </option>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                    <?php if ($errors->has('nationality')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('nationality'); ?>
                                                        <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Type d'identité :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-radio-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="identity_type" value="2" <?php echo e((old("identity_type") == "2") ? "checked": ""); ?>> Passport
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="identity_type" value="1" <?php echo e((old("identity_type") == "1") ? "checked": ""); ?>> CIN
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <?php if ($errors->has('identity_type')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('identity_type'); ?>
                                                        <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Numero d'identité :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="num_identity" id="" value='<?php echo e(old("num_identity")); ?>'>
                                                    </div>
                                                    <?php if ($errors->has('num_identity')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('num_identity'); ?>
                                                        <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                        <div class="kt-section" style="width: 100%">
                                            <div class="kt-section__body">
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">Coordonnées professionnelles :</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Pays de résidence :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <select class="form-control countrySelect" name="country" id="country">
                                                            <option value="">Choix du pays</option>
                                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if(!empty($country)): ?>
                                                                    <option value="<?php echo e($country->code2); ?>" <?php echo e(($country->code2 == old('country')) ? 'selected="selected"' : ''); ?>>
                                                                        <?php echo e($country->name_fr); ?>

                                                                    </option>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                    <?php if ($errors->has('country')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('country'); ?>
                                                        <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Ville :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="city" id="" value='<?php echo e(old("city")); ?>'>
                                                    </div>
                                                    <?php if ($errors->has('city')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('city'); ?>
                                                        <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Email :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="mail" class="form-control" name="email" id="" value='<?php echo e(old("email")); ?>'>
                                                    </div>
                                                    <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                                                        <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Téléphone Professionel:</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="pro_phone" id="" value='<?php echo e(old("pro_phone")); ?>'>
                                                    </div>
                                                    <?php if ($errors->has('pro_phone')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('pro_phone'); ?>
                                                        <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Téléphone Mobile :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="mobile_phone" id="" value='<?php echo e(old("mobile_phone")); ?>'>
                                                    </div>
                                                    <?php if ($errors->has('mobile_phone')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('mobile_phone'); ?>
                                                        <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg" style="display: none"></div>
                                        <div class="kt-section" style="width: 100%; display: none">
                                            <div class="kt-section__body">
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">SERVICES :</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Restauration :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <span class="kt-switch">
															<label>
																<input type="checkbox" name="has_restoration" <?php echo e((old("has_restoration") == true) ? "checked": ""); ?>/>
																<span></span>
															</label>
														</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Hébérgement :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <span class="kt-switch">
															<label>
																<input type="checkbox" name="has_hebergement" <?php echo e((old("has_hebergement") == true) ? "checked": ""); ?>/>
																<span></span>
															</label>
														</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Transfert :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <span class="kt-switch">
															<label>
																<input type="checkbox" name="has_transfert" <?php echo e((old("has_transfert") == true) ? "checked": ""); ?>/>
																<span></span>
															</label>
														</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">PEC:</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <span class="kt-switch">
															<label>
																<input type="checkbox" name="has_pec" <?php echo e((old("has_pec") == true) ? "checked": ""); ?>/>
																<span></span>
															</label>
														</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">FORMATION:</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <span class="kt-switch">
															<label>
																<input type="checkbox" name="has_formation" <?php echo e((old("has_formation") == true) ? "checked": ""); ?>/>
																<span></span>
															</label>
														</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-3 col-xl-3">
                                        </div>
                                        <div class="col-lg-9 col-xl-9">
                                            <button type="submit" class="btn btn-brand btn-bold">Ajouter</button>&nbsp;
                                            <a href="<?php echo e(URL('/participants')); ?>" type="reset" class="btn btn-secondary kt-form-disable--cta">Annuler</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--end:: Widgets/Order Statistics-->
                </div>
            </div>
        </div>
        <!--End:: App Content-->
    </div>
    <!--End:: Portlet-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/scripts.custom.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\medyas\resources\views/participants/add.blade.php ENDPATH**/ ?>