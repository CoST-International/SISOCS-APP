<?php

/**
 * This is the model class for table "{{entes_unidad}}".
 *
 * The followings are the available columns in table '{{entes_unidad}}':
 * @property integer $idUnidad
 * @property string $nombre
 * @property integer $idEnte
 *
 * The followings are the available model relations:
 * @property Entes $idEnte0
 */
class EntesUnidad extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{entes_unidad}}';
	}
	//public function primaryKey() {
            //return array('idUnidad');
			//return 'id';
        //}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('idEnte', 'required'),
			array('idEnte', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>85),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idUnidad, nombre, idEnte', 'safe', 'on'=>'search'),
			
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
			'idEnte0' => array(self::BELONGS_TO, 'Entes', 'idEnte'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idUnidad' => 'Id Unidad',
			'nombre' => 'Nombre',
			'idEnte' => 'Ente Responsable',
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

		$criteria->compare('idUnidad',$this->idUnidad);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('idEnte',$this->idEnte);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EntesUnidad the static model class
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
}
