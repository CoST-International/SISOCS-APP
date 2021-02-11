<?php

/**
 * This is the model class for table "{{kpi}}".
 *
 * The followings are the available columns in table '{{kpi}}':
 * @property integer $id
 * @property integer $idInicioEjecucion
 * @property string $tittle
 * @property string $description
 *
 * The followings are the available model relations:
 * @property InicioEjecucion $idInicioEjecucion0
 * @property KpiObservations[] $kpiObservations
 */
class Kpi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{kpi}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idInicioEjecucion, tittle, description', 'required'),
			array('idInicioEjecucion', 'numerical', 'integerOnly'=>true),
			array('tittle, description', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idInicioEjecucion, tittle, description', 'safe', 'on'=>'search'),
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
			'kpiObservations' => array(self::HAS_MANY, 'KpiObservations', 'kpi_id'),
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
			'tittle' => 'Titulo',
			'description' => 'Descripcion',
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
		$criteria->compare('tittle',$this->tittle,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kpi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
