<?php

/**
 * This is the model class for table "{{budgetBreakdown}}".
 *
 * The followings are the available columns in table '{{budgetBreakdown}}':
 * @property integer $id
 * @property integer $idProyecto
 * @property string $description
 * @property integer $sourceParty_id
 * @property string $sourceParty_name
 * @property double $amount
 * @property string $currency
 * @property string $startDate
 * @property string $endDate
 *
 * The followings are the available model relations:
 * @property Proyecto $idProyecto0
 * @property Parties $sourceParty
 */
class BudgetBreakdown extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{budgetBreakdown}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProyecto, description, sourceParty_id, amount, currency, startDate, endDate', 'required'),
			array('idProyecto, sourceParty_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('description, sourceParty_name', 'length', 'max'=>255),
			array('currency', 'length', 'max'=>3),
			array('startDate', 'type', 'type' => 'date', 'message' => '{attribute}: no es una fecha!', 'dateFormat' => 'yyyy/mm/dd'),
			array('endDate', 'type', 'type' => 'date', 'message' => '{attribute}: no es una fecha!', 'dateFormat' => 'yyyy/mm/dd'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idProyecto, description, sourceParty_id, sourceParty_name, amount, currency, startDate, endDate', 'safe', 'on'=>'search'),
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
			'idProyecto0' => array(self::BELONGS_TO, 'Proyecto', 'idProyecto'),
			'sourceParty' => array(self::BELONGS_TO, 'Parties', 'sourceParty_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idProyecto' => 'Id Proyecto',
			'description' => 'Descripción',
			'sourceParty_id' => 'Origen de Fondos',
			'sourceParty_name' => 'Nombre de Fuente de Origen',
			'amount' => 'Cantidad',
			'currency' => 'Moneda',
			'startDate' => 'Fecha de Inicio',
			'endDate' => 'Fecha Final',
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
		$criteria->compare('idProyecto',$this->idProyecto);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('sourceParty_id',$this->sourceParty_id);
		$criteria->compare('sourceParty_name',$this->sourceParty_name,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('startDate',$this->startDate,true);
		$criteria->compare('endDate',$this->endDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BudgetBreakdown the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function listaParties() {
			$dat 	= Parties::model()->findAll(array("order"=>"id asc"));
			$list = CHtml::listData($dat, 'id', 'legalName');
			return $list;
	}


}
