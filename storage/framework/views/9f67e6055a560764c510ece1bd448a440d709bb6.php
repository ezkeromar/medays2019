<?php $__env->startSection('template_title'); ?>
    <?php echo trans('usersmanagement.showing-all-users'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_toolbar'); ?>
    <div class="btn-toolbar kt-margin-l-20">
        <a href="/users/create" class="btn btn-label-success btn-pill kt-add-participant">
            <i class="la la-user-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <table class="table table-bordered table-bordered table-hover table-responsive" id="" width="100%">
                <thead>
                    <tr>
                        <th > Avatar </th>
                        <th ><?php echo trans('usersmanagement.users-table.name'); ?></th>
                        <th ><?php echo trans('usersmanagement.users-table.email'); ?></th>
                        <th ><?php echo trans('usersmanagement.users-table.fname'); ?></th>
                        <th ><?php echo trans('usersmanagement.users-table.lname'); ?></th>
                        <th ><?php echo trans('usersmanagement.users-table.role'); ?></th>
                        <th > Permissions </th>
                        <th ><?php echo trans('usersmanagement.users-table.created'); ?></th>
                        <th ><?php echo trans('usersmanagement.users-table.updated'); ?></th>
                        <th ><?php echo trans('usersmanagement.users-table.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <img src="<?php echo $user->avatar_url; ?>" alt="<?php echo $user->name; ?>" height="64px"/>
                            </td>
                            <td><?php echo e($user->name); ?></td>
                            <td><a href="mailto:<?php echo e($user->email); ?>" title="email <?php echo e($user->email); ?>"><?php echo e($user->email); ?></a></td>
                            <td><?php echo e($user->first_name); ?></td>
                            <td><?php echo e($user->last_name); ?></td>
                            <td>
                                <?php $__currentLoopData = $user->getRoles(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div>
                                        <span class="kt-badge kt-badge--brand kt-badge--dot"></span>
                                        <span class="kt-font-bold kt-font-brand"><?php echo e($user_role->name); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td>
                                <?php $__currentLoopData = $user->getPermissions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div>
                                        <span class="kt-badge kt-badge--default kt-badge--dot"></span>
                                        <span class="kt-font-bold kt-font-default"><?php echo e($user_permission->name); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td><?php echo e($user->created_at); ?></td>
                            <td><?php echo e($user->updated_at); ?></td>
                            <td>
                                <div class="dropdown">
                                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                       data-toggle="dropdown">
                                        <i class="flaticon-more-1"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="<?php echo e(URL::to('users/' . $user->id)); ?>">
                                            <i class="la la-check-circle"></i> <?php echo trans('usersmanagement.buttons.show'); ?>

                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(URL::to('users/' . $user->id . '/edit')); ?>">
                                            <i class="la la-edit"></i> <?php echo trans('usersmanagement.buttons.edit'); ?>

                                        </a>
                                        <a class="dropdown-item" href="#" onclick="deleteConfirm(this,<?php echo e($user->id); ?>)">
                                            <i class="la la-trash"></i> <?php echo trans('usersmanagement.buttons.delete'); ?>

                                            <div style="display: none">
                                                <?php echo Form::open(array('url' => 'users/' . $user->id,'id' => 'delete_from'.$user->id ,'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')); ?>

                                                <?php echo Form::hidden('_method', 'DELETE'); ?>

                                                <?php echo Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user ?')); ?>

                                                <?php echo Form::close(); ?>

                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <?php echo e($users->links()); ?>

                    </td>
                </tr>
                </tfoot>
            </table>
            <!--end: Datatable -->
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>


    <script>
        function deleteConfirm(el,id) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous ne pourrez pas revenir en arrière!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimez-le!'
            }).then((result) => {
                if (result.value) {
                    $('#delete_from' + id).submit()
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\medyas\resources\views/usersmanagement/show-users.blade.php ENDPATH**/ ?>