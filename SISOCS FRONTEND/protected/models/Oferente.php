<?php

/**
 * This is the model class for table "{{oferente}}".
 *
 * The followings are the available columns in table '{{oferente}}':
 * @property integer $idOferente
 * @property string $nombre_oferente
 *
 * The followings are the available model relations:
 * @property Calificacion[] $csCalificacions
 */
class Oferente extends CActiveRecord
{
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
			//array('idOferente', 'required'),
			array('idOferente', 'numerical', 'integerOnly'=>true),
			array('nombre_oferente', 'length', 'max'=>100),
			array('nombre_oferente','unique', 'message'=>'Este oferente ya existe, por favor ingresar uno nuevo.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idOferente, nombre_oferente', 'safe', 'on'=>'search'),
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
			'csCalificacions' => array(self::MANY_MANY, 'Calificacion', '{{calificacion_oferente}}(idOferente, idcalificacion)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idOferente' => 'Código oferentes',
			'nombre_oferente' => 'Nombre oferente',
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

		$criteria->compare('idOferente',$this->idOferente);
		$criteria->compare('nombre_oferente',$this->nombre_oferente,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Oferente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
