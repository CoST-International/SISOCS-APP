<?php

/**
 * This is the model class for table "{{estadosgestcontra}}".
 *
 * The followings are the available columns in table '{{estadosgestcontra}}':
 * @property integer $codigo
 * @property string $estado
 * @property string $descripcion
 * @property string $fecha_registro
 * @property string $user_registro
 */
class Estadosgestcontra extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{estadosgestcontra}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('estado, descripcion, fecha_registro', 'required'),
			array('estado', 'length', 'max'=>1),
			array('descripcion', 'length', 'max'=>50),
			array('user_registro', 'length', 'max'=>16),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('codigo, estado, descripcion, fecha_registro, user_registro', 'safe', 'on'=>'search'),
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
			'codigo' => 'Código',
			'estado' => 'Estado Identificador',
			'descripcion' => 'Estatus de Contrato / Modificación',
			'fecha_registro' => 'Fecha Registro',
			'user_registro' => 'Usuario Registro',
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

		$criteria->compare('codigo',$this->codigo);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('user_registro',$this->user_registro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Estadosgestcontra the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
