<?php

/**
 * This is the model class for table "{{desembolsos_montos}}".
 *
 * The followings are the available columns in table '{{desembolsos_montos}}':
 * @property integer $idDesembolso
 * @property integer $idInicioEjecucion
 * @property integer $desembolso
 * @property string $monto
 * @property string $descripcion
 * @property string $fecha_desembolso
 * @property string $estado
 * @property integer $usuario_creacion
 * @property string $fecha_creacion
 * @property integer $usuario_publicacion
 * @property string $fecha_publicacion
 */
class DesembolsosMontos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{desembolsos_montos}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idInicioEjecucion, descripcion, fecha_desembolso, fecha_creacion', 'required'),
			array('idInicioEjecucion, desembolso, usuario_creacion, usuario_publicacion', 'numerical', 'integerOnly'=>true),
			array('monto', 'length', 'max'=>16),
			array('descripcion', 'length', 'max'=>150),
			array('fecha_desembolso', 'length', 'max'=>20),
			array('estado', 'length', 'max'=>25),
			//array('fecha_publicacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idDesembolso, idInicioEjecucion, desembolso, monto, descripcion, fecha_desembolso, estado, usuario_creacion, fecha_creacion, usuario_publicacion, fecha_publicacion', 'safe', 'on'=>'search'),
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
			'idDesembolso' => 'Id Desembolso',
			'idInicioEjecucion' => 'Número de Ejecución',
			'desembolso' => 'Número de desembolso',
			'monto' => 'Monto del desembolso',
			'descripcion' => 'Descripcion',
			'fecha_desembolso' => 'Fecha del desembolso',
			'estado' => 'Estado',
			'usuario_creacion' => 'Usuario de Creación',
			'fecha_creacion' => 'Fecha de Creación',
			'usuario_publicacion' => 'Usuario de modificación',
			'fecha_publicacion' => 'Fecha de modificación',
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

		$criteria->compare('idDesembolso',$this->idDesembolso);
		$criteria->compare('idInicioEjecucion',$this->idInicioEjecucion);
		$criteria->compare('desembolso',$this->desembolso);
		$criteria->compare('monto',$this->monto,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('fecha_desembolso',$this->fecha_desembolso,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('usuario_creacion',$this->usuario_creacion);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('usuario_publicacion',$this->usuario_publicacion);
		$criteria->compare('fecha_publicacion',$this->fecha_publicacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DesembolsosMontos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
