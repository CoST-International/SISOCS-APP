<?php

/**
 * This is the model class for table "{{forecast_observations}}".
 *
 * The followings are the available columns in table '{{forecast_observations}}':
 * @property integer $id
 * @property integer $forecast_id
 * @property string $obs_notes
 * @property double $obs_amount
 * @property string $obs_currency
 *
 * The followings are the available model relations:
 * @property Forecast $forecast
 */
class ForecastObservations extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{forecast_observations}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('forecast_id, obs_notes, obs_amount, obs_currency', 'required'),
			array('forecast_id', 'numerical', 'integerOnly'=>true),
			array('obs_amount', 'numerical'),
			array('obs_notes', 'length', 'max'=>255),
			array('obs_currency', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, forecast_id, obs_notes, obs_amount, obs_currency', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'forecast' => array(self::BELONGS_TO, 'Forecast', 'forecast_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'forecast_id' => 'Previsión o Pronóstico',
			'obs_notes' => 'Notas',
			'obs_amount' => 'Monto',
			'obs_currency' => 'Moneda',
		);
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('forecast_id',$this->forecast_id);
		$criteria->compare('obs_notes',$this->obs_notes,true);
		$criteria->compare('obs_amount',$this->obs_amount);
		$criteria->compare('obs_currency',$this->obs_currency,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ForecastObservations the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
