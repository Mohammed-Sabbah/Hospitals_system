<?php $__env->startSection('title', 'Role Permissions'); ?>

<?php $__env->startSection('content'); ?>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mt-2">Role permissions</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>name</th>
                            <th>guard</th>
                            <th>Assigned</th>

                        </tr>
                    </thead>
                    <tbody>


                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td> <?php echo e($permission->id); ?> </td>
                                <td> <?php echo e($permission->name); ?> </td>
                                <td> <?php echo e($permission->guard_name); ?> </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <form method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input class="custom-control-input" type="checkbox"
                                                id="permission_<?php echo e($permission->id); ?>" value="option1"

                                                <?php if($permission->assign): ?>
                                                    checked
                                                <?php endif; ?>

                                                >

                                            <label for="permission_<?php echo e($permission->id); ?>" class="custom-control-label"
                                                onclick="assign(<?php echo e($role->id); ?> , <?php echo e($permission->id); ?>)">Assign</label>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script>
        function assign(role_id, permission_id) {
            let data = new FormData();
            data.append('role_id', role_id);
            data.append('permission_id', permission_id);

            axios.post('/admin/permissions/role', data)
                .then(function(response) {
                    toastr.success(response.data.message);
                    console.log(response.data);
                }).catch(function(error) {
                    toastr.error(error.response.data.message);
                    console.log(error.response.data.message);
                })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web\BackEnd\Laravel\Revesion-hospital\resources\views/admin/roles/role-permissions.blade.php ENDPATH**/ ?>