<?php

/**
 * This is the model class for table "vProyectoFuenteFinanciamiento".
 *
 * The followings are the available columns in table 'vProyectoFuenteFinanciamiento':
 * @property string $fuente
 * @property double $monto
 * @property string $moneda
 * @property double $tasa_cambio
 * @property integer $idProyecto
 */
class VProyectoFuenteFinanciamiento extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vProyectoFuenteFinanciamiento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('monto, moneda, tasa_cambio, idProyecto', 'required'),
			array('idProyecto', 'numerical', 'integerOnly'=>true),
			array('monto, tasa_cambio', 'numerical'),
			array('fuente', 'length', 'max'=>100),
			array('moneda', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fuente, monto, moneda, tasa_cambio, idProyecto', 'safe', 'on'=>'search'),
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
			'fuente' => 'Fuente',
			'monto' => 'Monto',
			'moneda' => 'Moneda',
			'tasa_cambio' => 'Tasa Cambio',
			'idProyecto' => 'Id Proyecto',
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

		$criteria->compare('fuente',$this->fuente,true);
		$criteria->compare('monto',$this->monto);
		$criteria->compare('moneda',$this->moneda,true);
		$criteria->compare('tasa_cambio',$this->tasa_cambio);
		$criteria->compare('idProyecto',$this->idProyecto);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VProyectoFuenteFinanciamiento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
