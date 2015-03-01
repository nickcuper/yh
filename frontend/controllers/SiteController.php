<?php

class SiteController extends FrontendController
{

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 *
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array_merge([
			[
				'allow',
				'actions' => ['index, quotes, sync'],
				'users' => ['*']
			],
		], parent::accessRules());
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array_merge([
			'ajaxOnly + sync',
		], parent::accessRules());

	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * Render view with list of quotes.
	 */
	public function actionQuotes()
	{
		$model = new Currencies('search');
		$model->unsetAttributes(); // clear any default values

		if (isset($_GET['Currencies']))
			$model->attributes=$_GET['Currencies'];

		$this->render('quotes',[
			'provider' => $model
		]);
	}

	/**
	 * Sync data
	 * only Ajax request.
	 */
	public function actionSync()
	{
		if (!Currencies::doSave(Yii::app()->quotes->call())) {
			$this->_responce['message'] = Yii::t('quotes', 'Quotes not sync');
		}

		echo CJSON::encode($this->_responce);
		Yii::app()->end();
	}
}