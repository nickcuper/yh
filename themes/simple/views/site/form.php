<?php
/* @var $this WebController */
/* @var $model CommentUpdate */


$formId = 'config-form';
$ajax = [
    'type' => 'POST',
    'url' => $this->createUrl('user/updateStatsConfig', ['id' => $model->userId]),
    'update' => '#' . $formId,
];

$form = $this->beginWidget('ActiveForm', ['id' => $formId]);
/* @var $form ActiveForm */

echo
    BsHtml::errorSummary($model) .
    $form->businessControlGroup($model, 'businessId') .
    $form->dropDownListControlGroup($model, 'timeframe', $model->timeframeEnum->valueLabels, array('maxlength'=>7)) .
    $form->dropDownListControlGroup($model, 'period', $model->periodEnum->valueLabels, array('maxlength'=>8)) .
    BsHtml::submitButton('<i class="fa fa-plus"></i> Save Stats Config', ['ajax' => $ajax, 'color' => 'primary']);

$this->endWidget();
