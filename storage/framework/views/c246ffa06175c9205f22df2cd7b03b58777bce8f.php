<?php echo $__env->make('nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>signup</title>
  </head>
  <body>
  <form class="row g-3" action="<?php echo e(url('/')); ?>/signups" method="post">
   <!--<form class="row g-3" action="<?php echo e(url('/')); ?>/customers" method="post">
    <form class="row g-3" action="<?php echo e(url('/')); ?>/costumers" method="post">-->
        <?php echo e(csrf_field()); ?>

    <!--    <pre>
            <?php 
                print_r($errors->all());
             ?>
        </pre>
    -->
        <h2 class="text-center text-primary">Registration Page</h2>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Name</label>
            <input type="" name="name" class="form-control" id="" value="<?php echo e(old('name')); ?>"><!--<?php echo e(old('name')); ?>-->
            <span class="text-danger">
            <?php 
                foreach ($errors->get('name') as $message) 
                {
                    echo $message;
                }
             ?>
            </span>
        </div>

        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="" name="email" class="form-control" id="" value="<?php echo e(old('email')); ?>">
            <span class="text-danger">
                
            <?php $__currentLoopData = $errors->get('email'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                {
                    <?php echo e($message); ?>

                }
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </span>
        </div>

        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Gender</label>
            <input type="" name="gender" class="form-control" id="" value="<?php echo e(old('gender')); ?>">
            <span class="text-danger">
            <?php 
                foreach ($errors->get('gender') as $message) 
                {
                    echo $message;
                }
             ?>
            </span>
        </div>

        <div class="col-12">
            <label for="inputAddress" class="form-label">Address</label>
            <input type="text" name="address" class="form-control" id="" value="<?php echo e(old('address')); ?>">
            <span class="text-danger">
                <?php 
                foreach ($errors->get('address') as $message) 
                {
                    echo $message;
                }
                 ?>
            </span>
        </div>

        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">DOB</label>
            <input type="" name="dob" class="form-control" id="" value="<?php echo e(old('dob')); ?>">
            <span class="text-danger">
            <?php 
                foreach ($errors->get('dob') as $message) 
                {
                    echo $message;
                }
                 ?>
            </span>
        </div>

        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="">
            <span class="text-danger">
                <?php 
                foreach ($errors->get('password') as $message) 
                {
                    echo $message;
                }
                 ?>
            </span>
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="">
            <span class="text-danger">
                <?php 
                foreach ($errors->get('password_confirmation') as $message) 
                {
                    echo $message;
                }
                 ?>
            </span>
        </div>
        
        
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
</form>
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