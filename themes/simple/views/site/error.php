<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = 'Error ' . $code;
?>
<div class="alert alert-danger">
    <h4><?=CHtml::encode($message)?></h4>
    <br>
    <?php
    if (YII_DEBUG) {
        echo
            'At ' . $file . ': ' . $line .
            '<pre>' . $trace . '</pre>';
    }
    ?>
</div>
