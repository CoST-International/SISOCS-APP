<?php

/**
 * This is the model class for table "{{finance}}".
 *
 * The followings are the available columns in table '{{finance}}':
 * @property integer $id
 * @property integer $idContratacion
 * @property string $title
 * @property string $description
 * @property integer $financingParty_id
 * @property string $financingParty_name
 * @property string $financeCategory
 * @property double $amount
 * @property string $currency
 * @property string $startDate
 * @property string $endDate
 * @property string $interestRate_base
 * @property integer $repaymentFrequency
 */
class Finance extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{finance}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, financingParty_id, financingParty_name, financeCategory, amount, currency', 'required'),
			array('idContratacion, financingParty_id, repaymentFrequency', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('title, financingParty_name, financeCategory, interestRate_base', 'length', 'max'=>255),
			array('currency', 'length', 'max'=>3),
			array('description, startDate, endDate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idContratacion, title, description, financingParty_id, financingParty_name, financeCategory, amount, currency, startDate, endDate, interestRate_base, repaymentFrequency', 'safe', 'on'=>'search'),
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
			'title' => 'Título',
			'description' => 'Description',
			'financingParty_id' => 'Financing Party',
			'financingParty_name' => 'Financing Party Name',
			'financeCategory' => 'Finance Category',
			'amount' => 'Amount',
			'currency' => 'Currency',
			'startDate' => 'Start Date',
			'endDate' => 'End Date',
			'interestRate_base' => 'Tasa de Interés',
			//'interestRate_margin' => 'Interest Rate Margin',
			//'interestRate_fixed' => 'Interest Rate Fixed',
			//'stepInRights' => 'Step In Rights',
			//'exchangeRateGuarantee' => 'Exchange Rate Guarantee',
			'repaymentFrequency' => 'Frecuencia de Pagos Préstamo',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('financingParty_id',$this->financingParty_id);
		$criteria->compare('financingParty_name',$this->financingParty_name,true);
		$criteria->compare('financeCategory',$this->financeCategory,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('startDate',$this->startDate,true);
		$criteria->compare('endDate',$this->endDate,true);
		$criteria->compare('interestRate_base',$this->interestRate_base,true);
		$criteria->compare('repaymentFrequency',$this->repaymentFrequency);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Finance the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
