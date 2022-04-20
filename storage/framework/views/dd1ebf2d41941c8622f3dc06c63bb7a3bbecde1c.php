<?php echo $__env->make('nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            
            .center {
                justify-content: center;
                padding-top: 300px;
                margin: auto;
                width: 40%;
                color: navy;
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class=center>
            <h1>Welcome to Student Teacher Portal</h1>
        </div>
    </body>
</html>
<?php
// font-family: 'Raleway', sans-serif;
?>