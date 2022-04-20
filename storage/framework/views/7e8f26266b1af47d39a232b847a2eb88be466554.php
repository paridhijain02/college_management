
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>My assignments</title>
  </head>
<body>
<table class="table">
      <thead>
              <tr>
                  <th>Teacher's name</th>
                  <th>Assignment</th>
                  <th>Course</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
          <?php $__currentLoopData = $you; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
                $aaa=$i->username;
             ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

       

              <?php $__currentLoopData = $c; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($i->username==$aaa): ?> 
                <tr>
                    <td><?php echo e($i->username); ?></td>
                    <td><?php echo e($i->assignment); ?></td>
                    <td><?php echo e($i->course); ?></td>  
                    <td>
                      <a href="<?php echo e(url('/assignments_delete/')); ?>/<?php echo e($i->id); ?>"> 
                          <button class="btn btn-danger">Delete</button>    
                      </a>  
                    </td>
              </tr>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
      </table>
      


 
     

      <a href="<?php echo e(url('/tprofilee')); ?>"> 
            <button class="btn btn-primary">Back</button>    
        </a>  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>