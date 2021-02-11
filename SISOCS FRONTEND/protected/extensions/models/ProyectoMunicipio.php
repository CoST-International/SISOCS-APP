<?php

/**
 * This is the model class for table "{{proyecto_municipio}}".
 *
 * The followings are the available columns in table '{{proyecto_municipio}}':
 * @property integer $idProyecto
 * @property string $idMunicipio
 * @property string $idDepartamento
 * @property string $beneficio
 *
 * The followings are the available model relations:
 * @property Proyecto $idProyecto0
 * @property Proyecto $idMunicipio0
 */
class ProyectoMunicipio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{proyecto_municipio}}';
	}

	public function primaryKey()
	{
		return array('idProyecto', 'idMunicipio', 'idDepartamento');
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProyecto, idMunicipio, idDepartamento', 'required'),
			array('idProyecto', 'numerical', 'integerOnly'=>true),
			array('idMunicipio', 'length', 'max'=>3),
			array('idDepartamento', 'length', 'max'=>2),
			array('beneficio', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idProyecto, idMunicipio, idDepartamento, beneficio', 'safe', 'on'=>'search'),
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
			'idProyecto0' => array(self::BELONGS_TO, 'Proyecto', 'idProyecto'),
			'idMunicipio0' => array(self::BELONGS_TO, 'Municipio', 'idMunicipio, idDepartamento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idProyecto' => 'Proyecto',
			'idMunicipio' => 'Departamento',
			'idDepartamento' => 'Municipio',
			'beneficio' => 'Beneficio',
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

		$criteria->compare('idProyecto',$this->idProyecto);
		$criteria->compare('idMunicipio',$this->idMunicipio,true);
		$criteria->compare('idDepartamento',$this->idDepartamento,true);
		$criteria->compare('beneficio',$this->beneficio,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProyectoMunicipio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function listaDepartamentos() 
	{
		$dat= Departamento::model()->findAll();
		$list = CHtml::listData($dat,'idDepartamento', 'departamento');
		return $list ;
	}	
}
