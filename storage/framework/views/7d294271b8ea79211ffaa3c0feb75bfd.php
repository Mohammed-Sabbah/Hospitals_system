<?php $__env->startSection('title', 'Edit permission'); ?>

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


        <form action="<?php echo e(route('permissions.update', $permission->id)); ?>" method="POST" enctype="multipart/form-data">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="card-body">

                <div class="form-group" data-select2-id="68">
                    <label>Select guard_name</label>
                    <select class="form-control select2bs4 select2-hidden-accessible" name="guard_name" id="hospital_id"
                        style="width: 100%;" data-select2-id="16" tabindex="-1" aria-hidden="true">

                        <option value="admin">Admin</option>
                        <option value="web">Web</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Enter Name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                        placeholder="Enter Name" value="<?php echo e($permission->name); ?>">
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
    $('.select2bs4').select2({
        majors: true,
        theme: 'bootstrap4'
    })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web\BackEnd\Laravel\Revesion-hospital\resources\views/admin/permissions/edit.blade.php ENDPATH**/ ?>