<?php

/**
 * This is the model class for table "{{funcionarios}}".
 *
 * The followings are the available columns in table '{{funcionarios}}':
 * @property string $idfuncionario
 * @property string $idEnte
 * @property string $nombre
 * @property string $puesto
 * @property string $telefono
 * @property string $correo
 *
 * The followings are the available model relations:
 * @property Calificacion[] $calificacions
 * @property Entes $idEnte0
 * @property Programa[] $programas
 * @property Proyecto[] $proyectos
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
			array('idEnte', 'required'),
			array('idEnte', 'length', 'max'=>10),
			array('nombre', 'length', 'max'=>85),
			array('puesto', 'length', 'max'=>45),
			array('telefono', 'length', 'max'=>20),
			array('correo', 'length', 'max'=>40),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idfuncionario, idEnte, nombre, puesto, telefono, correo', 'safe', 'on'=>'search'),
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
			'calificacions' => array(self::HAS_MANY, 'Calificacion', 'idFuncionario'),
			'idEnte0' => array(self::BELONGS_TO, 'Entes', 'idEnte'),
			'programas' => array(self::HAS_MANY, 'Programa', 'idFuncionario'),
			'proyectos' => array(self::HAS_MANY, 'Proyecto', 'idFuncionario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idfuncionario' => 'Idfuncionario',
			'idEnte' => 'Ente Institucional',
			'nombre' => 'Nombre del funcionario',
			'puesto' => 'Puesto',
			'telefono' => 'Teléfono',
			'correo' => 'Correo electrónico',
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

		$criteria->compare('idfuncionario',$this->idfuncionario,true);
		$criteria->compare('idEnte',$this->idEnte,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('puesto',$this->puesto,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('correo',$this->correo,true);

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
            $list = CHtml::listData($dat,'idente', 'descripcion');
            return $list ;
        }

}
