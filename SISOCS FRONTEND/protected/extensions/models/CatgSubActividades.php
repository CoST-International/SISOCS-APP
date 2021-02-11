<?php

/**
 * This is the model class for table "{{catg_sub_actividades}}".
 *
 * The followings are the available columns in table '{{catg_sub_actividades}}':
 * @property string $id
 * @property integer $idEjecucion
 * @property string $descripcion
 * @property string $precio
 * @property string $fecha_registro
 * @property string $user_registro
 * @property string $estado
 * @property string $eliminada
 */
class CatgSubActividades extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{catg_sub_actividades}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idEjecucion, descripcion, fecha_registro, estado', 'required'),
			array('idEjecucion', 'numerical', 'integerOnly'=>true),
			array('descripcion', 'length', 'max'=>500),
			array('precio, fecha_registro', 'length', 'max'=>10),
			array('user_registro', 'length', 'max'=>16),
			array('estado', 'length', 'max'=>50),
			array('eliminada', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idEjecucion, descripcion, precio, fecha_registro, user_registro, estado, eliminada', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'idEjecucion' => 'Id Ejecucion',
			'descripcion' => 'Descripcion',
			'precio' => 'Precio',
			'fecha_registro' => 'Fecha Registro',
			'user_registro' => 'User Registro',
			'estado' => 'Estado',
			'eliminada' => 'Eliminada',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('idEjecucion',$this->idEjecucion);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('precio',$this->precio,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('user_registro',$this->user_registro,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('eliminada',$this->eliminada,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CatgSubActividades the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function listaCatgTipoActividades()
        {
            $dat= CatgTipoActividades::model()->findAll();
            $list = CHtml::listData($dat,'codigo', 'descripcion');
            return $list ;
        }
	public function listaEstados(){
		$dat= Estado::model()->findAll();
            $list = CHtml::listData($dat,'estado', 'estado');
            return $list ;
	}
}
