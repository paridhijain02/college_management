
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Create Assignment</title>
    <style>
        #white
        {
            border: 2px solid white;
            color: white;
        }
    </style>
  </head>
  <body>
  <form class="row g-3" action="<?php echo e(url('/')); ?>/create_assignment" method="post">
   <!--<form class="row g-3" action="<?php echo e(url('/')); ?>/customers" method="post">
    <form class="row g-3" action="<?php echo e(url('/')); ?>/costumers" method="post">-->
        <?php echo e(csrf_field()); ?>

    <!--    <pre>
            <?php 
                print_r($errors->all());
             ?>
        </pre>
    -->
        <h2 class="text-center text-primary">Create an assignment <?php echo e(session('username')); ?></h2>
        <h1></h1>
        <div class="col-md-6">
            <label  class="form-label">Assignment</label>
            <textarea name="assignment" class="form-control" rows="10" cols="30" value="<?php echo e(old('assignment')); ?>"></textarea>
            <span class="text-danger">
            <?php 
                foreach ($errors->get('assignment') as $message) 
                {
                    echo $message;
                }
             ?>
            </span>
        </div>

        <?php $__currentLoopData = $you; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6">
        <input list="course" name="course" value="<?php echo e($i->course); ?>" id="white">
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
        
</form>
<br>
<a href="<?php echo e(url('/tprofilee')); ?>"> 
            <button class="btn btn-primary">Back</button>    
        </a>  
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>