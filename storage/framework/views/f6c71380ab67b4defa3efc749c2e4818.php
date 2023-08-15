<?php $__env->startSection('title', 'Edit Admin'); ?>

<?php $__env->startSection('content'); ?>

    <div class="col-12">

        <?php if($errors->any()): ?>

            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Errors!</h5>

                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        <?php endif; ?>


        <form action="<?php echo e(route('admins.update', $admin->id)); ?>" method="POST" enctype="multipart/form-data">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="card-body">

                <div class="form-group" data-select2-id="28">
                    <label>Select Role</label>
                    <select class="select2 select2-hidden-accessible" name="roles[]" multiple=""
                        data-placeholder="Select a State" style="width: 100%;" data-select2-id="6" tabindex="-1"
                        aria-hidden="true">

                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->id); ?>"

                                <?php if($admin->hasRole($role)): ?>
                                    selected
                                <?php endif; ?>
                                ><?php echo e($role->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Enter Name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                        placeholder="Enter Name" value="<?php echo e($admin->name); ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" name="email" id="exampleInputPassword1"
                        placeholder="Email" value="<?php echo e($admin->email); ?>">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        //Initialize Select2 Elements
        $('.select2').select2({
            majors: true,
            tokenSeparators: [',', ' '],
            theme: 'bootstrap4'
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web\BackEnd\Laravel\Revesion-hospital\resources\views/admin/admins/edit.blade.php ENDPATH**/ ?>