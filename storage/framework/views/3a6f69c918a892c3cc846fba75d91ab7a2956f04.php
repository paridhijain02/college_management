<?php echo $__env->make('nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!doctype html>
<html lang="en">
  <head>
    <title>Students</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <div class="container">
        <form action="" class="col-3">
            <div class="form-group">
              <label for="">Search</label>
              <input type="search" name="search" id="" class="form-control" placeholder="" value="<?php echo e($search); ?>">
            </div>
            <button class="btn btn-primary">Search</button>
            <a href="<?php echo e(url('/sview')); ?>">
                <button class='btn btn-primary' type="button">Reset</button>
            </a>
        </form>
        <table class="table">
        <!--<pre>
        <?php echo e(print_r($c)); ?>

        </pre>    -->
      <thead>
              <tr>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Course</th>
                  <th>Gender</th>
              </tr>
          </thead>
          <tbody>
              <?php $__currentLoopData = $c; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                  <td><?php echo e($i->name); ?></td>
                  <td><?php echo e($i->username); ?></td>
                  <td><?php echo e($i->course); ?></td>
                  <td>
                        <?php if($i->gender=="F"): ?>
                            Female
                        <?php elseif($i->gender=="M"): ?>
                            Male                   
                        <?php else: ?>
                            Others 
                        <?php endif; ?>
                  </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
      </table>
      <div class="row">
          <?php echo e($c->links()); ?>

      </div>
  </div>
  </body>
</html>