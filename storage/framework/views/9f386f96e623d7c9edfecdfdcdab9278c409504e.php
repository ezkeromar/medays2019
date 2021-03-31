<?php $__env->startSection('template_title'); ?>
    <?php echo e('Profile Participant'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_toolbar'); ?>
    <div class="kt-subheader__group" id="kt_subheader_group_actions">
        <div class="btn-toolbar kt-margin-l-20">

            <?php if( (in_array($participant->type_id,[2,4,8,6,3,9]))): ?>
                <button data-url="/participant/<?php echo e($participant->id); ?>/15" data-action="Envoyer invidation"
                        class=" DataTableVUrl btn btn-label-brand btn-bold btn-sm btn-icon-h" id="UpdateUnblockBlock">
                    <i class="la la-edit"></i> Envoyer invitation
                </button>
            <?php endif; ?>

            <button data-url="/participant/<?php echo e($participant->id); ?>/1" data-action="Valider" class="DataTableVUrl btn btn-label-success btn-bold btn-sm btn-icon-h" id="kt_sweetalert_demo_6">
                <i class="la la-check-circle"></i> Valider
            </button>
            <button data-url="/participant/<?php echo e($participant->id); ?>/2" data-action="Refuser" class="DataTableVUrl btn btn-label-danger btn-bold btn-sm btn-icon-h" id="kt_sweetalert_demo_8">
                <i class="la la-minus-circle"></i> Refuser
            </button>

            <?php if(auth()->user()->hasRole('admin') || auth()->user()->hasPermission('upgrade')): ?>
                <button class="btn btn-label-primary btn-bold btn-sm btn-icon-h" data-toggle="modal" data-target="#kt_modal_6">
                    <i class="la la-thumbs-o-up"></i> Upgrader
                </button>
            <?php endif; ?>
            <button data-url="/participant/<?php echo e($participant->id); ?>/4" data-action="Livrer le Badge" class="DataTableVUrl btn btn-label-info btn-bold btn-sm btn-icon-h" id="kt_sweetalert_demo_8">
                <i class="la la-credit-card"></i> Livrer le Badge
            </button>
            <button class="btn btn-label-brand btn-bold btn-sm btn-icon-h" id="UpdateUnblockBlock">
                <i class="la la-edit"></i> Modifier
            </button>
            <button data-url="/participant/<?php echo e($participant->id); ?>/6" data-action="Désactiver" class="DataTableVUrl btn btn-label-danger btn-bold btn-sm btn-icon-h" id="kt_sweetalert_demo_8">
                    <i class="la la-close"></i> Désactiver
            </button>
            <?php if(auth()->user()->hasRole('admin') || auth()->user()->hasPermission('delete')): ?>
                <button data-url="/participant/<?php echo e($participant->id); ?>/99" data-action="Supprimer" class="DataTableVUrl btn btn-label-danger btn-bold btn-sm btn-icon-h" id="kt_sweetalert_demo_8">
                    <i class="la la-trash"></i> Supprimer
                </button>
            <?php endif; ?>
        </div>
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

        <?php echo $__env->make('partials.participants.side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    <!--begin:: Widgets/Order Statistics-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Fiche participant
                                </h3>
                            </div>
                            <!-- <div class="kt-portlet__head-toolbar">
                                <button class="btn btn-label-primary btn-sm btn-icon-h kt-form--enable">
                                    Modifier
                                </button>
                            </div> -->
                        </div>
                        <form method="POST" action="/participant/<?php echo e($participant->id); ?>/update" class="kt-form kt-form--label-right">
                            <?php echo csrf_field(); ?>

                            <input type='hidden' value="<?php echo e($participant->id); ?>" id="partcipantIdField" />
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div id="UpdateUnblockBlockSection" class="updateBlockDiv"></div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Langue :</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="kt-radio-inline">
                                                    <label class="kt-radio">
                                                        <input type="radio" name="language" value="fr" <?php echo e(($participant->language == "fr") ? "checked": ""); ?>> Français
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-radio">
                                                        <input type="radio" name="language" value="en" <?php echo e(($participant->language == "en") ? "checked": ""); ?>> Anglais
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
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Civilité :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-radio-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="civility" value="1" <?php echo e(($participant->civility == "1") ? "checked": ""); ?>> Madame
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="civility" value="2" <?php echo e(($participant->civility == "2") ? "checked": ""); ?>> Monsieur
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
                                                        <input type="text" class="form-control" name="first_name" id="" value='<?php echo e($participant->first_name); ?>'>
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
                                                        <input type="text" class="form-control" name="last_name" id="" value='<?php echo e($participant->last_name); ?>'>
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
                                                        <input type="date" class="form-control dateField" name="birthday" id="" value='<?php echo e($participant->birthday); ?>' min="1901-01-01" max="2000-12-31"> 
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
                                                        <input type="text" class="form-control" name="organization" id="" value='<?php echo e($participant->organization); ?>'>
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
                                                        <input type="text" class="form-control" name="function" id="" value='<?php echo e($participant->function); ?>'>
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
                                                        <select class="form-control countrySelect" name="nationality">
                                                            <option value="">Choix du pays</option>
                                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if(!empty($country)): ?>
                                                                    <option value="<?php echo e($country->code2); ?>" <?php echo e(($country->code2 == $participant->nationality) ? 'selected' : ''); ?>>
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
                                                                <input type="radio" name="identity_type" value="2" <?php echo e(($participant->identity_type == "2") ? "checked": ""); ?>> Passport
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="identity_type" value="1" <?php echo e(($participant->identity_type == "1") ? "checked": ""); ?>> CIN
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
                                                        <input type="text" class="form-control" name="num_identity" id="" value='<?php echo e($participant->num_identity); ?>'>
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
                                        <?php if($participant->type_id == 7): ?>
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-section__body">
                                                    <div class="row">
                                                        <label class="col-xl-3"></label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <h3 class="kt-section__title kt-section__title-sm">Press :</h3>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-group-last row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Carte :</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <?php if(!empty($participant->press_cart)): ?>
                                                                <a class='kt-widget4__number kt-font-info' style="z-index: 1000000 !important; position: absolute;" href="<?php echo e($participant->press_cart); ?>" target="_blank">Clicker pour voir la carte</a>
                                                            <?php endif; ?>
                                                            <div class="custom-file" style="margin-top: 22px !important;">
                                                                <input type="file" name="press_cart" class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile" style="text-align: left;">Choisir un fichier (PDF, JPG, JPEG, PNG) | max 6mo</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg">
                                            </div>
                                        <?php endif; ?>
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
                                                        <select class="form-control countrySelect" name="country">
                                                            <option value="">Choix du pays</option>
                                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if(!empty($country)): ?>
                                                                    <option value="<?php echo e($country->code2); ?>" <?php echo e(($country->code2 == $participant->country) ? 'selected="selected"' : ''); ?>>
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
                                                        <input type="text" class="form-control" name="city" id="" value='<?php echo e($participant->city); ?>'>
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
                                                        <input type="mail" class="form-control" name="email" id="" value='<?php echo e($participant->email); ?>'>
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
                                                        <input type="text" class="form-control" name="pro_phone" id="" value='<?php echo e($participant->pro_phone); ?>'>
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
                                                        <input type="text" class="form-control" name="mobile_phone" id="" value='<?php echo e($participant->mobile_phone); ?>'>
                                                    </div>
                                                    <?php if ($errors->has('mobile_phone')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('mobile_phone'); ?>
                                                        <div class="alert alert-danger formError"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Motivation :</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <textarea class="form-control" name="motivation" id="" rows="<?php echo e(strlen($participant->motivation)/50); ?>"><?php echo e($participant->motivation); ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                        <div class="kt-section" style="width: 100%">
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
																<input type="checkbox" name="has_restoration" <?php echo e(($participant->has_restoration == 2) ? "checked": ""); ?>/>
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
																<input type="checkbox" name="has_hebergement" <?php echo e(($participant->has_hebergement == 2) ? "checked": ""); ?>/>
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
																<input type="checkbox" name="has_transfert" <?php echo e(($participant->has_transfert == 2) ? "checked": ""); ?>/>
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
																<input type="checkbox" name="has_pec" <?php echo e(($participant->has_pec == 2) ? "checked": ""); ?>/>
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
																<input type="checkbox" name="has_formation" <?php echo e(($participant->has_formation == 2) ? "checked": ""); ?>/>
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
                                        <div id='actionsBtNS' class="col-lg-9 col-xl-9 hideActions">
                                            <button type="submit" class="btn btn-brand btn-bold">Enregistrer</button>&nbsp;
                                            <a href="<?php echo e(URL('/participant/'.$participant->id)); ?>" type="reset" class="btn btn-secondary kt-form-disable--cta">Annuler</a>
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

    <div class="modal fade" id="kt_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upgrader ce participant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Type actuel :</label>
                        <div class="col-lg-9">
                            <select class="form-control kt-selectpicker" readonly="readonly" disabled>
                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(count($type) > 0): ?>
                                        <optgroup label="<?php echo e(($key == 1) ? 'PARTICIPANTS' : (($key == 2) ? 'PRESSE - SPONSORS' : 'ORGANISATION')); ?>">
                                            <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($t->id); ?>" <?php echo e(($participant->type_id == $t->id) ? 'selected' : ''); ?>><?php echo e($t->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </optgroup>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-bottom: 0.3rem;">
                        <label class="col-lg-3 col-form-label">Upgrader vers :</label>
                        <div class="col-lg-9">
                        <select id="nextLevel" class="form-control kt-selectpicker" onchange="changeType()">
                            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(count($type) > 0): ?>
                                    <optgroup label="<?php echo e(($key == 1) ? 'PARTICIPANTS' : (($key == 2) ? 'PRESSE - SPONSORS' : 'ORGANISATION')); ?>">
                                        <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($t->id); ?>" <?php echo e(($participant->type_id == $t->id) ? 'selected' : ''); ?>><?php echo e($t->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </optgroup>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row kt-niveau  <?php echo e($participant->type_id == "4" ? "" : "kt-hidden"); ?>"  id="type-level">
                        <label class="col-xl-3 col-lg-3 col-form-label">Niveau :</label>
                        <div class="col-lg-9">
                        <div class="">
                            <select class="form-control kt-selectpicker" name="level" id="level-select">
                                <option value="">Choisir un niveau...</option>
                                <option value="1" <?php echo e(($participant->level == "1") ? "selected": ""); ?>>Niveau 1</option>
                                <option value="2" <?php echo e(($participant->level == "2") ? "selected": ""); ?>>Niveau 2</option>
                                <option value="3" <?php echo e(($participant->level == "3") ? "selected": ""); ?>>Niveau 3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" data-action="Upgrader" data-url="upgrade" class="btn btn-primary DataTableVUrl">Upgrader</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/scripts.custom.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/js/demo1/pages/components/extended/sweetalert2.js')); ?>" type="text/javascript"></script>
    <script>
        $('body').on('click', '.DataTableVUrl', function () {
            Swal.fire({
                title: $(this).data('action'),
                text: "Voulez vous vraiment exécuter cette action",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui'
            }).then((result) => {
                if (result.value) {
                    if($(this).data('url') == 'upgrade') {
                        var nextLevel = ($('#nextLevel').val() != 'aucun') ? $('#nextLevel').val() : ''
                        var participantId = $('#partcipantIdField').val()
                        let levelSelect = document.getElementById('level-select')
                        window.location.href = '/participant/' + participantId + '/7/' + nextLevel + (levelSelect.value ? '?level=' + levelSelect.value : "")
                    } else {
                        window.location.href = $(this).data('url');
                    }
                }
            })
        })
        $('body').on('click', '#UpdateUnblockBlock', function () {
            $('#UpdateUnblockBlockSection').removeClass('updateBlockDiv') 
            $('#actionsBtNS').removeClass('hideActions')
        })

        function changeType($event) {
            let nextLevel = document.getElementById('nextLevel')
            let typeLevel = document.getElementById('type-level')
            if (nextLevel.value == '4') {
                typeLevel.classList.remove('kt-hidden')
            } else {
                typeLevel.classList.add('kt-hidden')
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\medyas\resources\views/participants/profile.blade.php ENDPATH**/ ?>