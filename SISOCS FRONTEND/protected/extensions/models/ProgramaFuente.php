<?php

/**
 * This is the model class for table "{{programa_fuente}}".
 *
 * The followings are the available columns in table '{{programa_fuente}}':
 * @property string $programa
 * @property string $fuente
 * @property double $monto
 * @property string $moneda
 * @property string $tasacambio
 * @property string $fecha
 * @property integer $id
 */
class ProgramaFuente extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{programa_fuente}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPrograma','required'),
			array('idPrograma', 'length', 'max'=>20),
			array('idFuente','required'),
			array('idFuente', 'length', 'max'=>200),
			array('monto','required'),
			array('monto', 'length', 'max'=>27),
			array('tasa_cambio','required'),
			array('idMoneda, tasa_cambio', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idPrograma, idFuente, monto, idMoneda, tasa_cambio', 'safe', 'on'=>'search'),
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
			'idPrograma' => 'Programa',
			'idFuente' => 'Fuente',
			'monto' => 'Monto',
			'idMoneda' => 'Moneda',
			'tasa_cambio' => 'Tasacambio',
			//'fecha' => 'Fecha',
			//'id' => 'ID',
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

		$criteria->compare('idPrograma',$this->programa,true);
		$criteria->compare('idFuente',$this->fuente,true);
		$criteria->compare('monto',$this->monto,true);
		$criteria->compare('idMoneda',$this->moneda,true);
		$criteria->compare('tasa_cambio',$this->tasacambio,true);
		//$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('id',$this->id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProgramaFuente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function primaryKey()
        {
            return array('idPrograma','idFuente');
            // For composite primary key, return an array like the following
            // return array('pk1', 'pk2');
            }
         public function listaProgramas()
        {
            $dat= Programa::model()->findAll();
            $list = CHtml::listData($dat,'idPrograma', 'programa');
            return $list ;
        }
         public function listaFuentes()
        {
            $dat=  Fuentesfinan::model()->findAll();
            $list = CHtml::listData($dat,'idfuente','fuente');
            return $list ;  
        }
          public function listaMoneda()
        {
            $dat= Monedas::model()->findAll();
            $list = CHtml::listData($dat,'idMoneda', 'moneda');
            return $list ;
        }
}
