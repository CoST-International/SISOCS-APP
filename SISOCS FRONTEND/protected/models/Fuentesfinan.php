<?php

/**
 * This is the model class for table "{{fuentesfinan}}".
 *
 * The followings are the available columns in table '{{fuentesfinan}}':
 * @property string $fuente
 * @property string $idfuente
 *
 * The followings are the available model relations:
 * @property Programa[] $csProgramas
 * @property Proyecto[] $proyectos
 */
class Fuentesfinan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{fuentesfinan}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fuente', 'length', 'max'=>100),
			array('fuente','unique', 'message'=>'Esta fuente de financiamiento ya existe, por favor ingresar uno nuevo.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fuente, idfuente', 'safe', 'on'=>'search'),
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
			'csProgramas' => array(self::MANY_MANY, 'Programa', '{{programa_fuente}}(idFuente, idPrograma)'),
			'proyectos' => array(self::HAS_MANY, 'Proyecto', 'idfuente'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fuente' => 'Fuente de Financiamiento',
			'idfuente' => 'Id Fuente',
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
		$criteria->compare('idfuente',$this->idfuente,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function listaFuentesFinan($idProyecto) {
	$dat 	= Fuentesfinan::model()->findAll(/*"SELECT ff.fuente, pf.monto, m.moneda, pf.tasa_cambio FROM cs_fuentesfinan ff JOIN cs_proyecto_fuente pf ON pf.idFuente=ff.idfuente JOIN cs_monedas m ON m.idMoneda=pf.idMoneda WHERE pf.idProyecto=".$idProyecto*/array("order"=>"idfuente asc"));
			$list = CHtml::listData($dat, 'idfuente', 'fuente');
			return $list;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Fuentesfinan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
