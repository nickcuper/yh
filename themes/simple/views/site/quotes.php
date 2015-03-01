<?php
/* @var $this SiteController */

$this->pageTitle = 'Quotes';

echo TbHtml::ajaxButton('Sync quotes',
                        Yii::app()->createUrl('site/sync'),
                        [
                            'beforeSend' => 'function() {
                                                $("#sync .modal-body").html("Please wait...");
                                                $("#sync .modal-footer .btn").hide();
                                                $("#sync").modal("show");
                                        }',
                            'complete' => 'function(data) {
                                                var result = "";
                                                var message = "Something happened";
                                                if (data) {
                                                    result = jQuery.parseJSON(data.responseText);
                                                    message = result.message;
                                                }

                                                $.fn.yiiGridView.update("quotes-grid");
                                                $("#sync .modal-body").html(message);
                                                $("#sync .modal-footer .btn").show();
                                                $("#sync").modal("show");
                                        }',
                        ],
                        ['class'=>'btn-info']
).'<hr>';

$this->renderPartial('_grid', ['model' => $provider]);

$this->widget('bootstrap.widgets.TbModal', array(
    'id' => 'sync',
    'header' => 'Sync result',
    'content' => '...',
    'footer' => array(
        TbHtml::button('Close', array('data-dismiss' => 'modal')),
    ),
));