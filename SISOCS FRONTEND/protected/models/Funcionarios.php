<?php

/**
 * This is the model class for table "{{funcionarios}}".
 *
 * The followings are the available columns in table '{{funcionarios}}':
 * @property integer $idFuncionario
 * @property integer $idEnte
 * @property string $nombre
 * @property string $puesto
 * @property string $telefono
 * @property string $correo
 * @property integer $idUnidad
 */
class Funcionarios extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{funcionarios}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('idFuncionario', 'required'),
			array('idFuncionario, idEnte, idUnidad', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>85),
			array('puesto', 'length', 'max'=>45),
			array('telefono', 'length', 'max'=>20),
			array('correo', 'length', 'max'=>40),
			array('nombre','unique', 'message'=>'Este funcionario ya existe, por favor ingresar uno nuevo.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idFuncionario, idEnte, nombre, puesto, telefono, correo, idUnidad', 'safe', 'on'=>'search'),
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
		'idUnidad0' => array(self::BELONGS_TO, 'EntesUnidad', 'idUnidad')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idFuncionario' => 'Idfuncionario',
			'idEnte' => 'Ente Institucional',
			'nombre' => 'Nombre del funcionario',
			'puesto' => 'Puesto',
			'telefono' => 'Teléfono',
			'correo' => 'Correo electrónico',
			'idUnidad' => 'Id Unidad',
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

		$criteria->compare('idFuncionario',$this->idFuncionario);
		$criteria->compare('idEnte',$this->idEnte);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('puesto',$this->puesto,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('idUnidad',$this->idUnidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Funcionarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	         public function listaEntes()
        {
            $dat= Entes::model()->findAll();
            $list = CHtml::listData($dat,'idEnte', 'descripcion');
            return $list ;
        }

	public function listaUnidades()
	{
		$dat= EntesUnidad::model()->findAll();
		$list = CHtml::listData($dat,'idUnidad', 'nombre');
		return $list ;
	}
}
