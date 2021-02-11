<?php

/**
 * This is the model class for table "{{gov_support_guarantee}}".
 *
 * The followings are the available columns in table '{{gov_support_guarantee}}':
 * @property integer $id
 * @property integer $idContratacion
 * @property string $financeCategory
 * @property string $title
 * @property string $startDate
 * @property string $endDate
 * @property integer $durationInDays
 * @property double $amount
 * @property string $currency
 *
 * The followings are the available model relations:
 * @property Contratacion $idContratacion0
 */
class GovSupportGuarantee extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{gov_support_guarantee}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idContratacion, financeCategory, title, startDate, endDate, durationInDays, amount, currency', 'required'),
			array('idContratacion, durationInDays', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('financeCategory, title', 'length', 'max'=>255),
			array('currency', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idContratacion, financeCategory, title, startDate, endDate, durationInDays, amount, currency', 'safe', 'on'=>'search'),
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
			'idContratacion0' => array(self::BELONGS_TO, 'Contratacion', 'idContratacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idContratacion' => 'Id Contratacion',
			'financeCategory' => 'Categoria de Financiacion',
			'title' => 'Titulo',
			'startDate' => 'Fecha de Inicio',
			'endDate' => 'Fecha Final',
			'durationInDays' => 'Duracion en Dias',
			'amount' => 'Monto',
			'currency' => 'Moneda',
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
		$criteria->compare('idContratacion',$this->idContratacion);
		$criteria->compare('financeCategory',$this->financeCategory,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('startDate',$this->startDate,true);
		$criteria->compare('endDate',$this->endDate,true);
		$criteria->compare('durationInDays',$this->durationInDays);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('currency',$this->currency,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GovSupportGuarantee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
