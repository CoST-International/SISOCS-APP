<?php

/**
 * This is the model class for table "{{prequalification}}".
 *
 * The followings are the available columns in table '{{prequalification}}':
 * @property integer $id
 * @property integer $idProyecto
 * @property string $startDate
 * @property string $endDate
 * @property integer $durationInDays
 * @property string $enquiryPeriod_startDate
 * @property string $enquiryPeriod_endDate
 * @property string $qualificationPeriod_startDate
 * @property string $qualificationPeriod_endDate
 * @property integer $eligibilityCriteria
 *
 * The followings are the available model relations:
 * @property Proyecto $idProyecto0
 */
class Prequalification extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{prequalification}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProyecto, startDate, endDate, durationInDays, enquiryPeriod_startDate, enquiryPeriod_endDate, qualificationPeriod_startDate, qualificationPeriod_endDate, eligibilityCriteria', 'required'),
			array('idProyecto, durationInDays, eligibilityCriteria', 'numerical', 'integerOnly'=>true),
			array('startDate', 'type', 'type' => 'date', 'message' => '{attribute}: no es una fecha!', 'dateFormat' => 'yyyy/mm/dd'),
			array('endDate', 'type', 'type' => 'date', 'message' => '{attribute}: no es una fecha!', 'dateFormat' => 'yyyy/mm/dd'),
			array('enquiryPeriod_startDate', 'type', 'type' => 'date', 'message' => '{attribute}: no es una fecha!', 'dateFormat' => 'yyyy/mm/dd'),
			array('enquiryPeriod_endDate', 'type', 'type' => 'date', 'message' => '{attribute}: no es una fecha!', 'dateFormat' => 'yyyy/mm/dd'),
			array('qualificationPeriod_startDate', 'type', 'type' => 'date', 'message' => '{attribute}: no es una fecha!', 'dateFormat' => 'yyyy/mm/dd'),
			array('qualificationPeriod_endDate', 'type', 'type' => 'date', 'message' => '{attribute}: no es una fecha!', 'dateFormat' => 'yyyy/mm/dd'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idProyecto, startDate, endDate, durationInDays, enquiryPeriod_startDate, enquiryPeriod_endDate, qualificationPeriod_startDate, qualificationPeriod_endDate, eligibilityCriteria', 'safe', 'on'=>'search'),
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
			'startDate' => 'Fecha Inicial',
			'endDate' => 'Fecha Final',
			'durationInDays' => 'Duración en Días',
			'enquiryPeriod_startDate' => 'Fecha de Inicio del Período de Consulta',
			'enquiryPeriod_endDate' => 'Fecha de Finalización del Período de Consulta',
			'qualificationPeriod_startDate' => 'Fecha de Inicio del Período de Calificación',
			'qualificationPeriod_endDate' => 'Fecha de Finalización del Período de Calificación',
			'eligibilityCriteria' => 'Criterio de Elegibilidad',
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
		$criteria->compare('startDate',$this->startDate,true);
		$criteria->compare('endDate',$this->endDate,true);
		$criteria->compare('durationInDays',$this->durationInDays);
		$criteria->compare('enquiryPeriod_startDate',$this->enquiryPeriod_startDate,true);
		$criteria->compare('enquiryPeriod_endDate',$this->enquiryPeriod_endDate,true);
		$criteria->compare('qualificationPeriod_startDate',$this->qualificationPeriod_startDate,true);
		$criteria->compare('qualificationPeriod_endDate',$this->qualificationPeriod_endDate,true);
		$criteria->compare('eligibilityCriteria',$this->eligibilityCriteria);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Prequalification the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
