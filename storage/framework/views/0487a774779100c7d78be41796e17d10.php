<?php $__env->startSection('title', 'Admins'); ?>

<?php $__env->startSection('content'); ?>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mt-2">admins</h3>
                <a href="<?php echo e(route('admins.create')); ?>" class="btn btn-success float-right"><i class="fas fa-plus"></i></a>
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
                            <th>Email</th>
                            <th>created at</th>
                            <th>updated at</th>
                            <th>actions</th>

                        </tr>
                    </thead>
                    <tbody>


                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td> <?php echo e($admin->id); ?> </td>
                                <td> <?php echo e($admin->name); ?> </td>
                                <td> <?php echo e($admin->email); ?> </td>
                                <td> <?php echo e($admin->created_at); ?> </td>
                                <td> <?php echo e($admin->updated_at); ?> </td>
                                <td>

                                    <div class="btn-group">
                                        <a href="<?php echo e(route('admins.edit', $admin->id)); ?>" class="btn btn-info"><i
                                                class="fas fa-edit" style="width: 14px"></i></a>
                                        <button onclick="deleteItem('/admin/admins/' , this ,<?php echo e($admin->id); ?>)"
                                            class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
        function deleteItem(url, ref, id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    axios.delete(url + id)
                        .then(function(response) {
                            showMessage(response.data);
                            ref.closest('tr').remove();
                        }).catch(function(error) {
                            showMessage(error.response.data);
                        })
                }
            })
        }

        function showMessage(data) {
            Swal.fire({
                icon: data.icon,
                title: data.message,
                showConfirmButton: false,
                timer: 1500
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web\BackEnd\Laravel\Revesion-hospital\resources\views/admin/admins/index.blade.php ENDPATH**/ ?>