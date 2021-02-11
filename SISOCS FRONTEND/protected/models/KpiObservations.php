<?php

/**
 * This is the model class for table "{{kpi_observations}}".
 *
 * The followings are the available columns in table '{{kpi_observations}}':
 * @property integer $id
 * @property integer $kpi_id
 * @property string $tittle
 * @property string $description
 * @property double $amount
 * @property string $currency
 * @property string $measure
 * @property integer $relatedImplementationMilestone_id
 * @property string $relatedImplementationMilestone_title
 * @property string $startDate
 * @property string $endDate
 *
 * The followings are the available model relations:
 * @property Kpi $kpi
 * @property ImplementationMilestone $relatedImplementationMilestone
 */
class KpiObservations extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{kpi_observations}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kpi_id, tittle, description, amount, currency, measure', 'required'),
			array('kpi_id, relatedImplementationMilestone_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('tittle, description, measure, relatedImplementationMilestone_title', 'length', 'max'=>255),
			array('currency', 'length', 'max'=>3),
			array('startDate, endDate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kpi_id, tittle, description, amount, currency, measure, relatedImplementationMilestone_id, relatedImplementationMilestone_title, startDate, endDate', 'safe', 'on'=>'search'),
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
			'kpi' => array(self::BELONGS_TO, 'Kpi', 'kpi_id'),
			'relatedImplementationMilestone' => array(self::BELONGS_TO, 'ImplementationMilestone', 'relatedImplementationMilestone_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kpi_id' => 'Kpi',
			'tittle' => 'Titulo',
			'description' => 'Descripcion',
			'amount' => 'Monto',
			'currency' => 'Moneda',
			'measure' => 'Medida',
			'relatedImplementationMilestone_id' => 'Id Relacion de Implementación de Entrega',
			'relatedImplementationMilestone_title' => 'Titulo Relacion de Implementación de Entrega',
			'startDate' => 'Fecha de Inicio',
			'endDate' => 'Fecha de Finalización',
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
		$criteria->compare('kpi_id',$this->kpi_id);
		$criteria->compare('tittle',$this->tittle,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('measure',$this->measure,true);
		$criteria->compare('relatedImplementationMilestone_id',$this->relatedImplementationMilestone_id);
		$criteria->compare('relatedImplementationMilestone_title',$this->relatedImplementationMilestone_title,true);
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
	 * @return KpiObservations the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function listarKPI(){
		//$modelDocumentType = new Kpi();
		$dat 	= Kpi::model()->findAll(array("order"=>"id asc"));
		$list = CHtml::listData($dat, 'id', 'tittle');
		return $list;
	}
	public function listarImplementationMilestone(){
		//$modelDocumentType = new Kpi();
		$dat 	= ImplementationMilestone::model()->findAll(array("order"=>"id asc"));
		$list = CHtml::listData($dat, 'id', 'title');
		return $list;
	}
}
