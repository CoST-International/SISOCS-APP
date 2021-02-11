<?php

/**
 * This is the model class for table "{{oferente}}".
 *
 * The followings are the available columns in table '{{oferente}}':
 * @property string $idoferentes
 * @property string $nombre_oferente
 *
 * The followings are the available model relations:
 * @property Calificacion[] $csCalificacions
 */
class Oferente extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Oferente the static model class
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
		return '{{oferente}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idoferentes', 'required'),
			array('idoferentes', 'length', 'max'=>10),
			array('nombre_oferente', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idoferentes, nombre_oferente', 'safe', 'on'=>'search'),
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
			'csCalificacions' => array(self::MANY_MANY, 'Calificacion', '{{calificacion_oferente}}(idoferente, idcalificacion)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idoferentes' => 'Id Oferentes',
			'nombre_oferente' => 'Nombre Oferente',
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

		$criteria->compare('idoferentes',$this->idoferentes,true);
		$criteria->compare('nombre_oferente',$this->nombre_oferente,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}