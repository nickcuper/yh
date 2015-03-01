<?php

class FrontendController extends Controller
{
    /**
     * Ajax responce.
     *
     * @var array
     */
    protected $_responce = [
        'success' => true,
        'message' => 'Sync quotes completed!'
    ];

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return [];
	}

    public function sidebarItems()
    {
        return [
            [
                'label' => '<i class="fa fa-home"></i> Home',
                'url' => '/',
            ],
            [
                'label' => '<i class="fa fa-list-alt"></i> Quotes',
                'url' => ['site/quotes'],
            ],
        ];
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {

            if (Yii::app()->request->isAjaxRequest) {
                $this->_responce['message'] = $error['message'];

                echo CJSON::encode($this->_responce);
                Yii::app()->end();
            }

            $this->render('error', $error);
        }
    }
}
