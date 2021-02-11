<?php

/**
 * This is the model class for table "{{gestioncontratos}}".
 *
 * The followings are the available columns in table '{{gestioncontratos}}':
 * @property integer $codigo
 * @property string $cod_contrato
 * @property integer $cod_contacto_01
 * @property integer $cod_contacto_02
 * @property integer $cod_contacto_03
 * @property integer $tipo_garant_01
 * @property integer $tipo_garant_02
 * @property integer $tipo_garant_03
 * @property string $monto_garant_01
 * @property string $monto_garant_02
 * @property string $monto_garant_03
 * @property string $estado_garant_01
 * @property string $estado_garant_02
 * @property string $estado_garant_03
 * @property string $fecha_venc_01
 * @property string $fecha_venc_02
 * @property string $fecha_venc_03
 * @property string $geo_latitud
 * @property string $geo_longitud
 * @property string $fecha_inicio
 * @property string $desc_problemas
 * @property string $desc_temas
 * @property string $fecha_registro
 * @property string $user_registro
 */
class Gestioncontratos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Gestioncontratos the static model class
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
		return '{{gestioncontratos}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_contrato, cod_contacto_01, cod_contacto_02, cod_contacto_03, tipo_garant_01, tipo_garant_02, tipo_garant_03, estado_garant_01, estado_garant_02, estado_garant_03, fecha_registro', 'required'),
			array('cod_contacto_01, cod_contacto_02, cod_contacto_03, tipo_garant_01, tipo_garant_02, tipo_garant_03', 'numerical', 'integerOnly'=>true),
			array('cod_contrato', 'length', 'max'=>25),
			array('monto_garant_01, monto_garant_02, monto_garant_03, geo_latitud, geo_longitud', 'length', 'max'=>10),
			array('estado_garant_01, estado_garant_02, estado_garant_03', 'length', 'max'=>1),
			array('desc_problemas, desc_temas', 'length', 'max'=>200),
			array('user_registro', 'length', 'max'=>16),
			array('fecha_venc_01, fecha_venc_02, fecha_venc_03, fecha_inicio', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('codigo, cod_contrato, cod_contacto_01, cod_contacto_02, cod_contacto_03, tipo_garant_01, tipo_garant_02, tipo_garant_03, monto_garant_01, monto_garant_02, monto_garant_03, estado_garant_01, estado_garant_02, estado_garant_03, fecha_venc_01, fecha_venc_02, fecha_venc_03, geo_latitud, geo_longitud, fecha_inicio, desc_problemas, desc_temas, fecha_registro, user_registro', 'safe', 'on'=>'search'),
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
			'codigo' => 'Codigo',
			'cod_contrato' => 'Cod Contrato',
			'cod_contacto_01' => 'Cod Contacto 01',
			'cod_contacto_02' => 'Cod Contacto 02',
			'cod_contacto_03' => 'Cod Contacto 03',
			'tipo_garant_01' => 'Tipo Garant 01',
			'tipo_garant_02' => 'Tipo Garant 02',
			'tipo_garant_03' => 'Tipo Garant 03',
			'monto_garant_01' => 'Monto Garant 01',
			'monto_garant_02' => 'Monto Garant 02',
			'monto_garant_03' => 'Monto Garant 03',
			'estado_garant_01' => 'Estado Garant 01',
			'estado_garant_02' => 'Estado Garant 02',
			'estado_garant_03' => 'Estado Garant 03',
			'fecha_venc_01' => 'Fecha Venc 01',
			'fecha_venc_02' => 'Fecha Venc 02',
			'fecha_venc_03' => 'Fecha Venc 03',
			'geo_latitud' => 'Geo Latitud',
			'geo_longitud' => 'Geo Longitud',
			'fecha_inicio' => 'Fecha Inicio',
			'desc_problemas' => 'Desc Problemas',
			'desc_temas' => 'Desc Temas',
			'fecha_registro' => 'Fecha Registro',
			'user_registro' => 'User Registro',
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
		$criteria->compare('cod_contrato',$this->cod_contrato,true);
		$criteria->compare('cod_contacto_01',$this->cod_contacto_01);
		$criteria->compare('cod_contacto_02',$this->cod_contacto_02);
		$criteria->compare('cod_contacto_03',$this->cod_contacto_03);
		$criteria->compare('tipo_garant_01',$this->tipo_garant_01);
		$criteria->compare('tipo_garant_02',$this->tipo_garant_02);
		$criteria->compare('tipo_garant_03',$this->tipo_garant_03);
		$criteria->compare('monto_garant_01',$this->monto_garant_01,true);
		$criteria->compare('monto_garant_02',$this->monto_garant_02,true);
		$criteria->compare('monto_garant_03',$this->monto_garant_03,true);
		$criteria->compare('estado_garant_01',$this->estado_garant_01,true);
		$criteria->compare('estado_garant_02',$this->estado_garant_02,true);
		$criteria->compare('estado_garant_03',$this->estado_garant_03,true);
		$criteria->compare('fecha_venc_01',$this->fecha_venc_01,true);
		$criteria->compare('fecha_venc_02',$this->fecha_venc_02,true);
		$criteria->compare('fecha_venc_03',$this->fecha_venc_03,true);
		$criteria->compare('geo_latitud',$this->geo_latitud,true);
		$criteria->compare('geo_longitud',$this->geo_longitud,true);
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('desc_problemas',$this->desc_problemas,true);
		$criteria->compare('desc_temas',$this->desc_temas,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('user_registro',$this->user_registro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}