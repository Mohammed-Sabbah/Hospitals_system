<?php $__env->startSection('title' , 'Hospitals'); ?>

<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title mt-2">Hospitals</h3>
        <a href="<?php echo e(route('hospital.create')); ?>" class="btn btn-success float-right"><i class="fas fa-plus"></i></a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

        <?php if(session()->has('message')): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                <h6><?php echo e(session()->get('message')); ?></h6>
            </div>
        <?php endif; ?>


        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>name</th>
              <th>location</th>
              <th>Activation</th>
              <th>Image</th>
              <th>info</th>
              <th>created at</th>
              <th>updated at</th>
              <th>actions</th>

            </tr>
          </thead>
          <tbody>


            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hospital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td> <?php echo e($hospital->id); ?> </td>
                <td> <?php echo e($hospital->name); ?> </td>
                <td> <?php echo e($hospital->location); ?> </td>
                <td> <span class="badge <?php echo e($hospital->is_active ? 'bg-success' : 'bg-danger'); ?>">
                    <?php echo e($hospital->active_status); ?></span> </td>
                <td> <img src="<?php echo e(Storage::url('hospitals/'.$hospital->cover)); ?>" alt="hospital image" width="53" height="53"> </td>
                <td> <?php echo e($hospital->info); ?> </td>
                <td> <?php echo e($hospital->created_at); ?> </td>
                <td> <?php echo e($hospital->updated_at); ?> </td>
                <td>
                    <form action="<?php echo e(route('hospital.destroy' , $hospital->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('delete'); ?>
                        <div class="btn-group">
                            <a href="<?php echo e(route('hospital.edit' , $hospital->id )); ?>" class="btn btn-info"><i class="fas fa-edit" style="width: 14px"></i></a>
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </div>
                    </form>
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

<?php echo $__env->make('admin.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web\BackEnd\Laravel\Revesion-hospital\resources\views/admin/hospitals/index.blade.php ENDPATH**/ ?>