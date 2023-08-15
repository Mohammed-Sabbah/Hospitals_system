<?php $__env->startSection('title' , 'Doctors'); ?>

<?php $__env->startSection('content'); ?>

<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title mt-2">Doctors</h3>
        <a href="<?php echo e(route('doctors.create')); ?>" class="btn btn-success float-right"><i class="fas fa-plus"></i></a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>name</th>
              <th>email</th>
              <th>phone</th>
              <th>Image</th>
              <th>descrption</th>
              <th>created at</th>
              <th>actions</th>

            </tr>
          </thead>
          <tbody>


            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td> <?php echo e($doctor->id); ?> </td>
                <td> <?php echo e($doctor->name); ?> </td>
                <td> <?php echo e($doctor->email); ?> </td>
                <td> <?php echo e($doctor->phone); ?> </td>
                <td> <img src="<?php echo e(Storage::url('doctors/'.$doctor->cover)); ?>" alt="doctor image" width="53" height="53"> </td>
                <td> <?php echo e($doctor->descrption); ?> </td>
                <td> <?php echo e($doctor->created_at); ?> </td>
                <td>

                    <div class="btn-group">
                        <a href="<?php echo e(route('doctors.edit' , $doctor->id )); ?>" class="btn btn-info"><i class="fas fa-edit" style="width: 14px"></i></a>
                        <button onclick="deleteItem('/admin/doctors/' , this ,<?php echo e($doctor->id); ?>)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    function deleteItem(url , ref , id){
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

            axios.delete(url+id)
            .then(function(response){
                showMessage(response.data);
                ref.closest('tr').remove();
            }).catch(function(error){
                showMessage(error.response.data);
            })
        }
        })
    }

    function showMessage(data){
        Swal.fire({
                icon: data.icon,
                title: data.message,
                showConfirmButton: false,
                timer: 1500
                })
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web\BackEnd\Laravel\Revesion-hospital\resources\views/admin/doctors/index.blade.php ENDPATH**/ ?>