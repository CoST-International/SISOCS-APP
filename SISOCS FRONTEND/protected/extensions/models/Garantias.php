<?php

/**
 * This is the model class for table "{{catg_tipo_garantias}}".
 *
 * The followings are the available columns in table '{{catg_tipo_garantias}}':
 * @property integer $codigo
 * @property string $descripcion
 * @property string $abreviatura
 * @property string $estado
 * @property string $fecha_registro
 * @property string $user_registro
 */
class Garantias extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Garantias the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{catg_tipo_garantias}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion, fecha_registro', 'required'),
			array('descripcion', 'length', 'max'=>50),
			array('abreviatura', 'length', 'max'=>15),
			array('estado', 'length', 'max'=>1),
			array('user_registro', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('codigo, descripcion, abreviatura, estado, fecha_registro, user_registro', 'safe', 'on'=>'search'),
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
			'codigo' => 'Id Garantía',
			'descripcion' => 'Descripción',
			'abreviatura' => 'Abreviatura',
			'estado' => 'Estado',
			'fecha_registro' => 'Fecha Registro',
			'user_registro' => 'Usuario Registro',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('codigo',$this->codigo);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('abreviatura',$this->abreviatura,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('user_registro',$this->user_registro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}