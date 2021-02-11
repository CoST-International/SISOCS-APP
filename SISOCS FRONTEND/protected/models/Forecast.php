<?php

/**
 * This is the model class for table "{{forecast}}".
 *
 * The followings are the available columns in table '{{forecast}}':
 * @property integer $id
 * @property integer $idProyecto
 * @property string $title
 * @property string $unidad
 * @property double $medida
 *
 * The followings are the available model relations:
 * @property Proyecto $idProyecto0
 * @property ForecastObservations[] $forecastObservations
 */
class Forecast extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{forecast}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProyecto, title', 'required'),
			array('idProyecto', 'numerical', 'integerOnly'=>true),
			array('medida', 'numerical'),
			array('title, unidad', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idProyecto, title, unidad, medida', 'safe', 'on'=>'search'),
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
			'forecastObservations' => array(self::HAS_MANY, 'ForecastObservations', 'forecast_id'),
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
			'title' => 'Título',
			'unidad' => 'Unidad',
			'medida' => 'Medida',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('unidad',$this->unidad,true);
		$criteria->compare('medida',$this->medida);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Forecast the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
