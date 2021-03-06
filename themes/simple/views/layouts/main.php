<?php

/* @var $this Controller */

Yii::app()->clientScript
    ->registerPackage('simple');

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?=$this->pageTitle?> | <?=Yii::app()->name?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container-narrow">

            <?php
                $this->renderPartial('//layouts/parts/sidebar');
            ?>

            <!-- Main content -->

                <?php $this->renderPartial('//layouts/parts/alerts'); ?>
                <?=$content?>
            <!-- /.content -->

        </div><!-- ./container-narrow -->
    </body>
</html>