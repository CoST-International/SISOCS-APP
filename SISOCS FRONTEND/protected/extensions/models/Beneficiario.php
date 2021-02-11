<?php

/**
 * This is the model class for table "{{beneficiario}}".
 *
 * The followings are the available columns in table '{{beneficiario}}':
 * @property string $idbeneficiarios
 * @property string $depto
 * @property string $muni
 *
 * The followings are the available model relations:
 * @property Proyecto[] $csProyectos
 */
class Beneficiario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{beneficiario}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idbeneficiarios', 'required'),
			array('idbeneficiarios', 'length', 'max'=>10),
			array('depto, muni', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idbeneficiarios, depto, muni', 'safe', 'on'=>'search'),
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
			'csProyectos' => array(self::MANY_MANY, 'Proyecto', '{{proyecto_beneficiario}}(idbeneficiario, idproyecto)'),
                    //'csmuni' => array(self::HAS_MANY, 'Municipio', '{{municipio_beneficiario}}(muni, id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idbeneficiarios' => 'Código beneficiarios',
			'depto' => 'Departamento',
			'muni' => 'Municipio',
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

		$criteria->compare('idbeneficiarios',$this->idbeneficiarios,true);
		$criteria->compare('depto',$this->depto,true);
		$criteria->compare('muni',$this->muni,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Beneficiario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function listaDepartamentos()
        {
            $dat= Departamento::model()->findAll();
             $list = CHtml::listData($dat,'codigoDepto','departamento');
            return $list ;  
        }
         public function listaBeneficiariosDep($dep)
        {
           /************************************************************/
            $dat =Yii::app()->db->createCommand()
                ->select('d.idbeneficiarios,d.depto,d.muni,concat(f.departamento,"-",e.municipio) as info')
                ->from('cs_beneficiario d')
                ->join('cs_departamento f', 'd.depto=f.codigoDepto')
                ->join('cs_municipio e', 'd.muni=e.id and e.depto=f.codigoDepto')
                ->where('d.depto=:dep',array(':dep'=>$dep))
                ->queryAll();
            $list = CHtml::listData($dat,'idbeneficiarios','info');
            /************************************************************/
            return $list ;  
        }
        
}
