<?php

/**
 * This is the model class for table "{{final_ejecucion_imagenes}}".
 *
 * The followings are the available columns in table '{{final_ejecucion_imagenes}}':
 * @property integer $idImagen
 * @property integer $idFinalizacion
 * @property string $nombre_imagen
 * @property string $nombre_fisico
 * @property string $ubicacion_imagen
 * @property string $estado
 * @property integer $usuario_creacion
 * @property string $fecha_creacion
 *
 * The followings are the available model relations:
 * @property FinalEjecucion $idFinalizacion0
 */
class FinalEjecucionImagenes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{final_ejecucion_imagenes}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idFinalizacion, nombre_imagen, nombre_fisico, ubicacion_imagen, estado, usuario_creacion, fecha_creacion', 'required'),
			array('idFinalizacion, usuario_creacion', 'numerical', 'integerOnly'=>true),
			array('nombre_imagen, nombre_fisico', 'length', 'max'=>200),
			array('ubicacion_imagen', 'length', 'max'=>3000),
			array('estado', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idImagen, idFinalizacion, nombre_imagen, nombre_fisico, ubicacion_imagen, estado, usuario_creacion, fecha_creacion', 'safe', 'on'=>'search'),
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
			'idFinalizacion0' => array(self::BELONGS_TO, 'FinalEjecucion', 'idFinalizacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idImagen' => 'Id Imagen',
			'idFinalizacion' => 'Id Finalizacion',
			'nombre_imagen' => 'Nombre Imagen',
			'nombre_fisico' => 'Nombre Fisico',
			'ubicacion_imagen' => 'Ubicacion Imagen',
			'estado' => 'Estado',
			'usuario_creacion' => 'Usuario Creacion',
			'fecha_creacion' => 'Fecha Creacion',
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

		$criteria->compare('idImagen',$this->idImagen);
		$criteria->compare('idFinalizacion',$this->idFinalizacion);
		$criteria->compare('nombre_imagen',$this->nombre_imagen,true);
		$criteria->compare('nombre_fisico',$this->nombre_fisico,true);
		$criteria->compare('ubicacion_imagen',$this->ubicacion_imagen,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('usuario_creacion',$this->usuario_creacion);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FinalEjecucionImagenes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
