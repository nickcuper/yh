<?php

/**
 * This is the model class for table "currencies".
 *
 * The followings are the available columns in table 'currencies':
 *
 * @property integer $id
 * @property string $name
 * @property string $price
 * @property string $symbol
 * @property integer $ts
 * @property integer $type
 * @property string $utctime
 * @property integer $volume
 * @property string $classname
 * @property string $change
 * @property string $chg_percent
 * @property string $created_at
 * @property string $updated_at
 */
class Currencies extends CActiveRecord
{
	/**
	 * Type of Quotes
	 */
	const TYPE_UNDEFINED = 0;
	const TYPE_CURRENCY = 1;

	/**
	 * Classname
	 */
	const CN_UNDEFINED = 0;
	const CN_QUOTE = 1;

	/**
	 * List of type quotes.
	 *
	 * @var array $typeList
	 */
	private $typeList = [
		'currency' => self::TYPE_CURRENCY,
	];

	/**
	 * List of classname.
	 *
	 * @var array $cnList
	 */
	private $cnList = [
		'quote' => self::CN_QUOTE,
	];

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'currencies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.CP
		return [
			['name, price, symbol, ts, type, classname', 'required'],
			['ts, type, volume', 'numerical', 'integerOnly' => true],
			['name', 'length', 'max' => 32],
			['price, change, chg_percent', 'length', 'max' => 32],
			['symbol', 'length', 'max' => 32],
			['classname', 'length', 'max' => 64],
			['utctime, updated_at', 'safe'],
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			[
				'id, name, price, symbol, ts, type, utctime, volume, classname, created_at, updated_at, change, chg_percent',
				'safe',
				'on' => 'search'
			],
		];
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return [
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id'         => 'ID',
			'name'       => 'Name',
			'price'      => 'Price',
			'symbol'     => 'Symbol',
			'ts'         => 'Ts',
			'type'       => 'Type',
			'utctime'    => 'Utctime',
			'volume'     => 'Volume',
			'classname'  => 'Classname',
			'change'  	 => 'Change',
			'chg_percent'=> 'Change Percent',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('price', $this->price, true);
		$criteria->compare('symbol', $this->symbol, true);
		$criteria->compare('ts', $this->ts);
		$criteria->compare('type', $this->type);
		$criteria->compare('utctime', $this->utctime, true);
		$criteria->compare('volume', $this->volume);
		$criteria->compare('classname', $this->classname, true);
		$criteria->compare('change', $this->change, true);
		$criteria->compare('chg_percent', $this->chg_percent, true);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('updated_at', $this->updated_at, true);

		return new CActiveDataProvider(self::model()->cache(2000, null, 2), [
			'criteria' => $criteria,
		]);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return Currencies the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave()
	{
		// Not using behavior because we're using this string after saving
		// and we need date in string, not CDbExpression('NOW()')
		if ($this->isNewRecord && $this->hasAttribute('created_at'))
			$this->created_at = date('Y-m-d H:i:s');

		return true;
	}

	private function setStringParams()
	{
		// Set type
		$this->type = mb_strtolower($this->type);
		$this->type = isset($this->typeList[$this->type])
			? $this->typeList[$this->type]
			: self::TYPE_UNDEFINED;

		// Set classname
		$this->classname = mb_strtolower($this->classname);
		$this->classname = isset($this->cnList[$this->classname])
			? $this->cnList[$this->classname]
			: self::CN_UNDEFINED;
	}

	/**
	 * @return mixed
	 */
	public function getType()
	{
		return array_search($this->type, $this->typeList);
	}

	/**
	 * @return mixed
	 */
	public function getClassname()
	{
		return array_search($this->classname, $this->cnList);
	}

	/**
	 * @param array $quotes
	 *
	 * @return bool
	 */
	public static function doSave(array $quotes = [])
	{
		if (!sizeof($quotes)) return false;

		foreach ($quotes as $quote) {

			$model = new self();
			$model->attributes = $quote;
			$model->setStringParams();

			if (!$model->save()) {
				Yii::log(CJSON::encode($model->getErrors()),'quotesSave');
			}
		}

		// Clear cache.
		Yii::app()->cache->flush();

		return true;
	}
}
