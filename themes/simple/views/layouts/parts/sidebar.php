<div class="masthead">
    <?php
        /* @var $this Controller */

        $this->widget('bootstrap.widgets.TbNav', [
            'type'        => TbHtml::NAV_TYPE_PILLS,
            'encodeLabel' => false,
            'items'       => $this->sidebarItems(),
            'htmlOptions' => [
                'class' => 'pull-right',
            ],
        ]);
    ?>
    <h3 class="muted"><?= Yii::app()->name ?></h3>
    <hr>
</div>

