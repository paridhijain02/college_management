
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Student profile</title>
    <style>
            .center {
                justify-content: center;
                padding-top: 5px;
                margin: auto;
                width: 40%;
                color: navy;
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            }
        </style>
  </head>
<body>
        <?php $__currentLoopData = $you; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
                $yourname=$i->name;
             ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="center">
    <!--
    <h1>Hello Student,  <?php echo e(session('username')); ?></h1>
        -->
    <h1>Hello Student,  
            <?php $__currentLoopData = $c; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($i->username==session('username')): ?>
                 <?php echo e($i->name); ?>

            <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </h1>
    </div>

        <?php $__currentLoopData = $you; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
                $yourcourse=$i->course;
             ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <h2>Course students</h2>
<table class="table">
        <!--<pre>
        <?php echo e(print_r($c)); ?>

        </pre>    -->
      <thead>
              <tr>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Course</th>
              </tr>
          </thead>
          <tbody>
              <?php $__currentLoopData = $c; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($i->course==$yourcourse): ?> 
              <tr>
                  <td><?php echo e($i->name); ?></td>
                  <td><?php echo e($i->username); ?></td>
                  <td><?php echo e($i->course); ?></td>
              </tr>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
      </table>

      <h2>Course Assignments</h2>
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
              <?php $__currentLoopData = $a; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($i->course==$yourcourse): ?> 
                <tr>
                    <td><?php echo e($i->username); ?></td>
                    <td><?php echo e($i->assignment); ?></td>
                    <td><?php echo e($i->course); ?></td>  
                    <td>   
                        <a href="<?php echo e(url('/sprofilee/assignment_write/')); ?>/<?php echo e($i->id); ?>"> 
                            <button class="btn btn-primary">Solve</button>    
                        </a>  
                    </td>
              </tr>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
      </table>
      
      <h2>Course teachers</h2>
      <table class="table">
      <thead>
              <tr>
                <th>Teacher's name</th>
                <th>Teacher's username</th>  
                <th>Course</th>
              </tr>
          </thead>
          <tbody>
              <?php $__currentLoopData = $t; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($i->course==$yourcourse): ?> 
                <tr>
                    <td><?php echo e($i->name); ?></td>
                    <td><?php echo e($i->username); ?></td>
                    <td><?php echo e($i->course); ?></td>  
              </tr>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
      </table>
 
     

      <a href="<?php echo e(url('/slogout')); ?>"> 
            <button class="btn btn-primary">Logout</button>    
        </a>  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>