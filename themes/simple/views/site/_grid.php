<?php
/**
 * @var $model Currencies
 */

$this->widget('bootstrap.widgets.TbGridView', [
    'dataProvider' => $model->search(),
    'id'           => 'quotes-grid',
    'type'         => TbHtml::GRID_TYPE_STRIPED,
    'filter'       => $model,
    'template'     => "{items}{pager}",
    'columns'      => [
        [
            'name' => 'name',
        ],
        [
            'name' => 'price',
        ],
        [
            'name' => 'symbol',
        ],
        [
            'name' => 'change',
        ],
        [
            'name' => 'chg_percent',
            'header' => 'CP',
        ],

    ],
]);