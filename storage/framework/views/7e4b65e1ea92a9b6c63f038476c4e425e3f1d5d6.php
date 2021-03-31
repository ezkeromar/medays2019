<?php $__env->startSection('template_header_title'); ?>
    Listing Participants
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_title'); ?>
    <div class="kt-subheader__group" id="kt_subheader_search">
        <span class="kt-subheader__desc" id="kt_subheader_total">
            <span class="kt-widget4__number kt-font-primary">Total : <?php echo e($participants->total()); ?></span>
        </span>
    </div>
    <div class="kt-subheader__group kt-hidden" id="kt_subheader_group_actions">
        <div class="kt-subheader__desc"><span id="kt_subheader_group_selected_rows"></span> Selected:</div>
        <div class="btn-toolbar kt-margin-l-20">
            <button data-action="Valider" data-url="/participant/multiple/1/#id#" class="btn btn-label-success btn-bold btn-sm btn-icon-h actionmultiple">
                <i class="la la-check-circle"></i> Valider
            </button>
            <button  data-action="Refuser" data-url="/participant/multiple/2/#id#" class="btn btn-label-danger btn-bold btn-sm btn-icon-h actionmultiple">
                <i class="la la-minus-circle"></i> Refuser
            </button>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_toolbar'); ?>
    <div class="kt-margin-l-20 kt-participants--filter" id="kt_subheader_search_form">
        <div class="kt-input-icon kt-input-icon--right kt-subheader__search">
            <input type="text" class="form-control" placeholder="Recherche..." id="generalSearch" value="<?php echo e(app('request')->input('query')); ?>">
        </div>
    </div>
    <div class="btn-toolbar kt-margin-l-20 kt-participants--filter">
        <div class="kt-form__group kt-form__group--inline">
            <div class="kt-form__control">
                <select id='typeFilter' class="form-control kt-select2" id="kt_select2_10" name="param">
                <option value="">Tous les types</option>
                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count($type) > 0): ?>
                        <optgroup label="<?php echo e(($key == 1) ? 'PARTICIPANTS' : (($key == 2) ? 'PRESSE - SPONSORS' : 'ORGANISATION')); ?>">
                            <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($t->id); ?>" <?php echo e((app('request')->input('type') == $t->id) ? 'selected' : ''); ?>><?php echo e($t->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </optgroup>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    </div>
    <div class="btn-toolbar kt-margin-l-20 kt-participants--filter">
        <div class="kt-form__group kt-form__group--inline">
            <div class="kt-form__control"> 
                <select id='statusFilter' class="form-control kt-select2" id="kt_select2_9" name="status">
                    <option value="">Tous les statuts</option>
                    <optgroup label="PARTICIPATION">
                        <option value="1" <?php echo e((app('request')->input('status') == 1) ? 'selected' : ''); ?>>En attente</option>
                        <option value="2" <?php echo e((app('request')->input('status') == 2) ? 'selected' : ''); ?>>Invitation envoyée</option>
                        <option value="3" <?php echo e((app('request')->input('status') == 3) ? 'selected' : ''); ?>>Validée</option>
                        <option value="4" <?php echo e((app('request')->input('status') == 4) ? 'selected' : ''); ?>>Refusée</option>
                        <?php if (Auth::check() && Auth::user()->hasRole('admin', true)): ?>
                          <option value="5" <?php echo e((app('request')->input('status') == 5) ? 'selected' : ''); ?>>Supprimé</option>
                        <?php endif; ?>
                    </optgroup>
                    <optgroup label="TRANSFERT">
                        <option value="6" <?php echo e((app('request')->input('status') == 6) ? 'selected' : ''); ?>>Demande transport</option>
                        <option value="7" <?php echo e((app('request')->input('status') == 7) ? 'selected' : ''); ?>>Attente informations transfert</option>
                        <option value="13" <?php echo e((app('request')->input('status') == 13) ? 'selected' : ''); ?>>Attente de validation</option>
                    </optgroup>
                    <optgroup label="BADGE">
                        <option value="8" <?php echo e((app('request')->input('status') == 8) ? 'selected' : ''); ?>>Badge en cours d’édition</option>
                        <option value="9" <?php echo e((app('request')->input('status') == 9) ? 'selected' : ''); ?>>Badge édité</option>
                        <option value="10" <?php echo e((app('request')->input('status') == 10) ? 'selected' : ''); ?>>Badge livré</option>
                    </optgroup>
                </select>
            </div>
        </div>
    </div>
    <div class="btn-toolbar kt-margin-l-20">
        <a href="/add/participant" class="btn btn-label-success btn-pill kt-add-participant">
            <i class="la la-user-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <!--begin: Datatable -->
            <table class="kt-datatable" id="html_table" width="100%">
                <thead>
                    <tr>
                        <th title="Field #0">ID</th>
                        <th title="Field #1">Informations personnelles</th>
                        <th title="Field #2">Type</th>
                        <th title="Field #3">Pays</th>
                        <th title="Field #4">Date d'inscription</th>
                        <th title="Field #6">Fonction</th>
                        <th title="Field #7">Statut</th>
                        <th title="Field #9">Motivation</th>
                        <th>Level</th>
                        <th title="Field #10">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($participant->id); ?></td>
                        <td>
                            <div class="kt-user-card-v2">
                                <div class="kt-user-card-v2__details">
                                    <span class="kt-user-card-v2__desc"><?php echo e($participant->access_code); ?> <span style="margin:0 5px">|</span> WebCode : <?php echo e($participant->webcode); ?></span>
                                    <a class="kt-user-card-v2__name" href="<?php echo e(url('/participant/'.$participant->id)); ?>"><?php echo e($participant->first_name); ?> <?php echo e($participant->last_name); ?></a>
                                    <span class="kt-user-card-v2__desc"><?php echo e($participant->organization); ?></span>
                                </div>
                            </div>
                        </td>
                        <td align="right"><?php echo e($participant->type_id); ?></td>
                        <td><?php echo e($participant->theCountry ? $participant->theCountry->name_fr : '-'); ?></td>
                        <td><?php echo e($participant->inscriptionDate ? Carbon\Carbon::parse($participant->inscriptionDate)->format('d/m/Y H:i') : '-'); ?></td>
                        <td><?php echo e($participant->function); ?></td>
                        <td><?php echo e($participant->status); ?></td>
                        <td><?php echo e($participant->motivation); ?></td>
                        <td><?php echo e($participant->level); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="dataTablePagination">
                <?php echo $participants->appends(request()->all())->links(); ?>

            </div>
            <!--end: Datatable -->
        </div>
    </div>
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
                            <select class="form-control kt-selectpicker UpTypePop">
                                <option value="" selected></option>
                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(count($type) > 0): ?>
                                        <optgroup label="<?php echo e(($key == 1) ? 'PARTICIPANTS' : (($key == 2) ? 'PRESSE - SPONSORS' : 'ORGANISATION')); ?>">
                                            <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($t->id); ?>" <?php echo e((app('request')->input('type') == $t->id) ? 'selected' : ''); ?>><?php echo e($t->name); ?></option>
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
                                            <option value="<?php echo e($t->id); ?>" <?php echo e((app('request')->input('type') == $t->id) ? 'selected' : ''); ?>><?php echo e($t->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </optgroup>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row kt-niveau kt-hidden"  id="type-level">
                        <label class="col-xl-3 col-lg-3 col-form-label">Niveau :</label>
                        <div class="col-lg-9">
                            <div class="">
                                <select class="form-control kt-selectpicker" name="level" id="level-select">
                                    <option value="">Choisir un niveau...</option>
                                    <option value="1">Niveau 1</option>
                                    <option value="2">Niveau 2</option>
                                    <option value="3">Niveau 3</option>
                                </select>
                            </div>
                        </div>
                    <input type="hidden" value="" id="UpPopParticipantId" />
                    <input type="hidden" value="" id="UpPopParticipantLevel" />
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
    <script src="<?php echo e(asset('assets/js/demo1/pages/crud/metronic-datatable/base/html-table.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/js/demo1/pages/crud/forms/widgets/select2.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/js/demo1/pages/components/extended/sweetalert2.js')); ?>" type="text/javascript"></script>
    <script>
        $('#html_table').on('kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated', function (e) {
				var checkedNodes = $('.kt-datatable__row--active'); // get selected records
				var count = checkedNodes.length; // selected records count
				console.log('count')
				console.log(count)
				$('#kt_subheader_group_selected_rows').html(count);

				if (count > 0) {
					$('#kt_subheader_search, .kt-participants--filter').addClass('kt-hidden');
					$('#kt_subheader_group_actions').removeClass('kt-hidden');
				} else {
					$('#kt_subheader_search, .kt-participants--filter').removeClass('kt-hidden');
					$('#kt_subheader_group_actions').addClass('kt-hidden');
				}
			});


        function FilterDataTable () {
            var query = ($('#generalSearch').val() != undefined) ? $('#generalSearch').val() : '';
            var type = ($('#typeFilter option:selected').val() != undefined) ? $('#typeFilter option:selected').val() : '';
            var status = ($('#statusFilter option:selected').val() != undefined) ? $('#statusFilter option:selected').val() : '';
            window.location.href = 'participants?query='+query+'&type='+type+'&status='+status;
        }

        $('body').on('change', '#statusFilter', function () {
            FilterDataTable();
        })

        $('body').on('change', '#typeFilter', function () {
            FilterDataTable();
        })

        $('body').on('keypress', '#generalSearch', function () {
            var keycode = (event.keyCode) ? event.keyCode : event.which;
            if (keycode == '13') {
                FilterDataTable();
            }
        })

        $('body').on('click', '.showUpPop', function () {

            $('#UpPopParticipantId').val($(this).data('id'))
            $('#UpPopParticipantLevel').val($(this).data('level'))

            document.getElementById('level-select').value = $(this).data('level')

            document.getElementsByClassName('UpTypePop')[0].value = $(this).data('type')

            document.getElementsByClassName('UpTypePop')[0].setAttribute('disabled',true)

           /* $('#UpPopParticipantId').val($(this).data('id'))
            var typename = 'Aucun upgrade disponible'
            if(1 == $(this).data('type')) {
                typename = 'Standard'
            }
            if(2 == $(this).data('type')) {
                typename = 'Premium sans hébergement'
            }
            if(7 == $(this).data('type')) {
                typename = 'Presse'
            }
            $('.UpTypePop option:selected').attr('value', $(this).data('type'))
            $('.UpTypePop option:selected').text(typename)
            var nexttypename = '<option value="aucun">Aucun upgrade disponible</option>'
            if($(this).data('type') == 1) {
                nexttypename = '<option value="2">Premium sans hébergement</option> <option value="3">Premium avec hébergement</option>'
            }
            if($(this).data('type') == 2) {
                nexttypename = '<option value="3">Premium avec hébergement</option>'
            }
            if($(this).data('type') == 7){
                nexttypename = '<option value="8">Partenaire média</option>'
            }
            $('.UpNextTypePop').html(nexttypename)*/
        })

        $('body').on('click', '.DataTableVUrlNPOP', function () {
            window.location.href = $(this).data('url');
        })

        $('body').on('click', '.actionmultiple', function() {
            Swal.fire({
                title: $(this).data('action'),
                text: "Voulez vous vraiment exécuter cette action",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Valider'
            }).then((result) => {
                var ids = ''
                $.each($('table .kt-checkbox>input:checked'), function(){            
                    ids += $(this).val()+','
                });
                window.location.href = $(this).data('url').replace('#id#', ids);
            })
        })

        $('body').on('click', '.DataTableVUrl', function () {
            Swal.fire({
                title: $(this).data('action'),
                text: "Voulez vous vraiment exécuter cette action",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Valider'
            }).then((result) => {
                if (result.value) {
                    if($(this).data('url') == 'upgrade') {
                        var nextLevel = ($('#nextLevel').val() != 'aucun') ? $('#nextLevel').val() : ''
                        var participantId = $('#UpPopParticipantId').val()
                        let levelSelect = document.getElementById('level-select')
                        window.location.href = '/participant/' + participantId + '/7/' + nextLevel + (levelSelect.value ? '?level=' + levelSelect.value : "")
                    } else {
                        window.location.href = $(this).data('url');
                    }
                }
            })
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\medyas\resources\views/participants/show.blade.php ENDPATH**/ ?>