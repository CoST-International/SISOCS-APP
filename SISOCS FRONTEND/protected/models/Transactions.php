<?php

/**
 * This is the model class for table "{{transactions}}".
 *
 * The followings are the available columns in table '{{transactions}}':
 * @property integer $id
 * @property integer $idInicioEjecucion
 * @property string $date
 * @property string $source
 * @property integer $payer_id
 * @property string $payer_name
 * @property integer $payee_id
 * @property string $payee_name
 * @property double $amount
 * @property string $currency
 * @property integer $relatedImplementationMilestone
 *
 * The followings are the available model relations:
 * @property InicioEjecucion $idInicioEjecucion0
 * @property ImplementationMilestone $relatedImplementationMilestone0
 */
class Transactions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{transactions}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idInicioEjecucion, date, source, payer_id, payee_id, amount, currency', 'required'),
			array('idInicioEjecucion, payer_id, payee_id, relatedImplementationMilestone', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('source, payer_name, payee_name', 'length', 'max'=>255),
			array('currency', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idInicioEjecucion, date, source, payer_id, payer_name, payee_id, payee_name, amount, currency, relatedImplementationMilestone', 'safe', 'on'=>'search'),
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
			'idInicioEjecucion0' => array(self::BELONGS_TO, 'InicioEjecucion', 'idInicioEjecucion'),
			'relatedImplementationMilestone0' => array(self::BELONGS_TO, 'ImplementationMilestone', 'relatedImplementationMilestone'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idInicioEjecucion' => 'Id Implementacion',
			'date' => 'Fecha',
			'source' => 'Origen',
			'payer_id' => 'Pagador Id',
			'payer_name' => 'Nombre de Pagador',
			'payee_id' => 'Beneficiario Id',
			'payee_name' => 'Nombre del Beneficiario',
			'amount' => 'Monto',
			'currency' => 'Moneda',
			'relatedImplementationMilestone' => 'Hito relacionado',
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
		$criteria->compare('idInicioEjecucion',$this->idInicioEjecucion);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('payer_id',$this->payer_id);
		$criteria->compare('payer_name',$this->payer_name,true);
		$criteria->compare('payee_id',$this->payee_id);
		$criteria->compare('payee_name',$this->payee_name,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('relatedImplementationMilestone',$this->relatedImplementationMilestone);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Transactions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
