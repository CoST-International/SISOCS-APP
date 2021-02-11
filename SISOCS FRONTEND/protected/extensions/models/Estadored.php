<?php

/**
 * This is the model class for table "{{estadored}}".
 *
 * The followings are the available columns in table '{{estadored}}':
 * @property string $Idestadored
 * @property string $descripcion_estado_red
 *
 * The followings are the available model relations:
 * @property Proyecto[] $proyectos
 */
class Estadored extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{estadored}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Idestadored', 'required'),
			array('Idestadored', 'length', 'max'=>2),
			array('descripcion_estado_red', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Idestadored, descripcion_estado_red', 'safe', 'on'=>'search'),
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
			'proyectos' => array(self::HAS_MANY, 'Proyecto', 'idEstadoRed'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Idestadored' => 'Código estado de la red',
			'descripcion_estado_red' => 'Estado del red vial',
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

		$criteria->compare('Idestadored',$this->Idestadored,true);
		$criteria->compare('descripcion_estado_red',$this->descripcion_estado_red,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Estadored the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
