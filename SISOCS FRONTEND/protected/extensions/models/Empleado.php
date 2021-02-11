<?php

/**
 * This is the model class for table "{{empleado}}".
 *
 * The followings are the available columns in table '{{empleado}}':
 * @property integer $idempleado
 * @property string $nombre
 * @property string $foto
 * @property string $correo
 * @property string $archivo
 */
class Empleado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{empleado}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idempleado', 'required'),
			array('idempleado', 'numerical', 'integerOnly'=>true),
			array('nombre, foto', 'length', 'max'=>65),
			array('correo', 'length', 'max'=>45),
			array('archivo', 'length', 'max'=>75),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idempleado, nombre, foto, correo, archivo', 'safe', 'on'=>'search'),
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
			'idempleado' => 'Codigo
',
			'nombre' => 'Nombre',
			'foto' => 'Foto',
			'correo' => 'correo',
			'archivo' => 'Adjuntar',
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

		$criteria->compare('idempleado',$this->idempleado);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('foto',$this->foto,true);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('archivo',$this->archivo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Empleado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
